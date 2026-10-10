<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageCompressorService
{
    /**
     * Compress and store an uploaded image.
     *
     * @param UploadedFile $file The uploaded file instance
     * @param string $directory Target directory on the storage disk (e.g. 'uploads/event')
     * @param string $disk Storage disk name (default: 'public')
     * @param int $maxWidth Maximum width in pixels (default: 1280)
     * @param int $maxHeight Maximum height in pixels (default: 1280)
     * @param int $quality Compression quality for JPEG/WebP (0-100, default: 75)
     * @return string Stored relative path
     */
    public static function compressAndStore(
        UploadedFile $file,
        string $directory,
        string $disk = 'public',
        int $maxWidth = 1280,
        int $maxHeight = 1280,
        int $quality = 75
    ): string {
        // Fallback to default Laravel store if GD extension is not available or file is invalid
        if (!extension_loaded('gd') || !$file->isValid()) {
            return $file->store($directory, $disk);
        }

        $realPath = $file->getRealPath();
        $imageInfo = @getimagesize($realPath);

        if (!$imageInfo) {
            return $file->store($directory, $disk);
        }

        $mime = $imageInfo['mime'] ?? '';
        $source = null;

        try {
            switch ($mime) {
                case 'image/jpeg':
                case 'image/jpg':
                    $source = @imagecreatefromjpeg($realPath);
                    break;
                case 'image/png':
                    $source = @imagecreatefrompng($realPath);
                    break;
                case 'image/webp':
                    if (function_exists('imagecreatefromwebp')) {
                        $source = @imagecreatefromwebp($realPath);
                    }
                    break;
                case 'image/gif':
                    $source = @imagecreatefromgif($realPath);
                    break;
                default:
                    break;
            }

            if (!$source) {
                return $file->store($directory, $disk);
            }

            // Correct EXIF orientation for JPEG (common in smartphone photos)
            if (function_exists('exif_read_data') && ($mime === 'image/jpeg' || $mime === 'image/jpg')) {
                $exif = @exif_read_data($realPath);
                if (!empty($exif['Orientation'])) {
                    switch ($exif['Orientation']) {
                        case 3:
                            $rotated = @imagerotate($source, 180, 0);
                            if ($rotated) {
                                imagedestroy($source);
                                $source = $rotated;
                            }
                            break;
                        case 6:
                            $rotated = @imagerotate($source, -90, 0);
                            if ($rotated) {
                                imagedestroy($source);
                                $source = $rotated;
                            }
                            break;
                        case 8:
                            $rotated = @imagerotate($source, 90, 0);
                            if ($rotated) {
                                imagedestroy($source);
                                $source = $rotated;
                            }
                            break;
                    }
                }
            }

            $origWidth = imagesx($source);
            $origHeight = imagesy($source);

            // Compute dimensions maintaining aspect ratio
            $ratio = min($maxWidth / $origWidth, $maxHeight / $origHeight);
            if ($ratio >= 1) {
                $targetWidth = $origWidth;
                $targetHeight = $origHeight;
            } else {
                $targetWidth = (int) max(1, round($origWidth * $ratio));
                $targetHeight = (int) max(1, round($origHeight * $ratio));
            }

            $target = imagecreatetruecolor($targetWidth, $targetHeight);

            // Preserve alpha channel for PNG and WebP
            if ($mime === 'image/png' || $mime === 'image/webp') {
                imagealphablending($target, false);
                imagesavealpha($target, true);
                $transparent = imagecolorallocatealpha($target, 255, 255, 255, 127);
                imagefilledrectangle($target, 0, 0, $targetWidth, $targetHeight, $transparent);
            }

            imagecopyresampled(
                $target,
                $source,
                0, 0, 0, 0,
                $targetWidth,
                $targetHeight,
                $origWidth,
                $origHeight
            );

            ob_start();
            $ext = 'jpg';
            if ($mime === 'image/png') {
                // PNG compression level (0-9, 7 is optimal balance between speed & compression)
                imagepng($target, null, 7);
                $ext = 'png';
            } elseif ($mime === 'image/webp' && function_exists('imagewebp')) {
                imagewebp($target, null, $quality);
                $ext = 'webp';
            } else {
                imagejpeg($target, null, $quality);
                $ext = 'jpg';
            }
            $contents = ob_get_clean();

            imagedestroy($source);
            imagedestroy($target);

            if ($contents === false || strlen($contents) === 0) {
                return $file->store($directory, $disk);
            }

            $filename = Str::random(40) . '.' . $ext;
            $relativePath = trim($directory, '/') . '/' . $filename;

            Storage::disk($disk)->put($relativePath, $contents);

            return $relativePath;
        } catch (\Throwable $e) {
            if ($source && is_resource($source)) {
                imagedestroy($source);
            }
            return $file->store($directory, $disk);
        }
    }
}
