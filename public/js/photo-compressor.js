/**
 * Auto Photo Compressor & Live Preview Helper
 * Automatically compresses uploaded photos client-side before submission
 * while maintaining excellent visual clarity.
 */
(function() {
    'use strict';

    function formatBytes(bytes, decimals = 1) {
        if (!bytes || bytes === 0) return '0 B';
        const k = 1024;
        const dm = decimals < 0 ? 0 : decimals;
        const sizes = ['B', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
    }

    function compressImageFile(file, maxWidth = 1600, maxHeight = 1600, quality = 0.82) {
        return new Promise((resolve, reject) => {
            if (!file || !file.type.startsWith('image/')) {
                resolve({ file: file, originalSize: file ? file.size : 0, compressedSize: file ? file.size : 0, isCompressed: false });
                return;
            }

            // If it's a GIF or SVG, don't re-compress on canvas to preserve animation/vectors
            if (file.type === 'image/gif' || file.type === 'image/svg+xml') {
                resolve({ file: file, originalSize: file.size, compressedSize: file.size, isCompressed: false });
                return;
            }

            const originalSize = file.size;
            const reader = new FileReader();

            reader.onload = function(e) {
                const img = new Image();
                img.onload = function() {
                    let width = img.width;
                    let height = img.height;

                    // Calculate aspect ratio
                    const ratio = Math.min(maxWidth / width, maxHeight / height);
                    if (ratio < 1) {
                        width = Math.round(width * ratio);
                        height = Math.round(height * ratio);
                    }

                    const canvas = document.createElement('canvas');
                    canvas.width = width;
                    canvas.height = height;

                    const ctx = canvas.getContext('2d');
                    ctx.imageSmoothingEnabled = true;
                    ctx.imageSmoothingQuality = 'high';
                    ctx.drawImage(img, 0, 0, width, height);

                    // Determine output type (default to image/jpeg for optimum compression)
                    let outputType = 'image/jpeg';
                    let outputExt = '.jpg';
                    if (file.type === 'image/png') {
                        // Check if file is small PNG; otherwise convert to JPEG for massive photo savings
                        outputType = 'image/jpeg';
                        outputExt = '.jpg';
                    }

                    canvas.toBlob(function(blob) {
                        if (!blob) {
                            resolve({ file: file, originalSize: originalSize, compressedSize: originalSize, isCompressed: false });
                            return;
                        }

                        // If compressed is somehow larger than original, keep original
                        if (blob.size >= originalSize) {
                            resolve({ file: file, originalSize: originalSize, compressedSize: originalSize, isCompressed: false });
                            return;
                        }

                        const baseName = file.name.substring(0, file.name.lastIndexOf('.')) || file.name;
                        const compressedFileName = baseName + outputExt;
                        const compressedFile = new File([blob], compressedFileName, {
                            type: outputType,
                            lastModified: Date.now()
                        });

                        resolve({
                            file: compressedFile,
                            blob: blob,
                            previewUrl: canvas.toDataURL(outputType, quality),
                            originalSize: originalSize,
                            compressedSize: compressedFile.size,
                            isCompressed: true
                        });
                    }, outputType, quality);
                };

                img.onerror = function() {
                    resolve({ file: file, originalSize: originalSize, compressedSize: originalSize, isCompressed: false });
                };

                img.src = e.target.result;
            };

            reader.onerror = function() {
                resolve({ file: file, originalSize: originalSize, compressedSize: originalSize, isCompressed: false });
            };

            reader.readAsDataURL(file);
        });
    }

    function setupPhotoCompressor(inputElement) {
        if (!inputElement || inputElement._hasCompressor) return;
        inputElement._hasCompressor = true;

        // Container for compression preview
        let previewBox = document.createElement('div');
        previewBox.className = 'photo-compress-preview-box mt-2';
        previewBox.style.display = 'none';
        inputElement.parentNode.appendChild(previewBox);

        inputElement.addEventListener('change', async function() {
            const files = inputElement.files;
            if (!files || files.length === 0) {
                previewBox.style.display = 'none';
                previewBox.innerHTML = '';
                return;
            }

            const rawFile = files[0];
            if (!rawFile.type.startsWith('image/')) {
                previewBox.style.display = 'none';
                return;
            }

            // Show compressing indicator
            previewBox.style.display = 'block';
            previewBox.innerHTML = `
                <div class="d-flex align-items-center p-2 rounded" style="background: #eef2f6; border: 1px dashed #2ca87f;">
                    <div class="spinner-border spinner-border-sm text-success me-2" role="status"></div>
                    <span class="text-muted small">Mengompres foto otomatis...</span>
                </div>
            `;

            try {
                const result = await compressImageFile(rawFile);

                if (result.isCompressed) {
                    // Update input.files with compressed file using DataTransfer
                    if (window.DataTransfer) {
                        const dataTransfer = new DataTransfer();
                        dataTransfer.items.add(result.file);
                        inputElement.files = dataTransfer.files;
                    }

                    const savingsPct = Math.round((1 - (result.compressedSize / result.originalSize)) * 100);
                    
                    previewBox.innerHTML = `
                        <div class="card p-2 border-success bg-light mt-2 shadow-sm" style="max-width: 480px; border-radius: 8px;">
                            <div class="d-flex align-items-center">
                                <img src="${result.previewUrl}" alt="Preview" class="rounded me-3 border" style="width: 70px; height: 70px; object-fit: cover;">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center gap-1 mb-1">
                                        <span class="badge bg-success"><i class="fa fa-compress me-1"></i>Auto Compressed</span>
                                        <span class="badge bg-primary">Hemat ${savingsPct}%</span>
                                    </div>
                                    <div class="small text-muted">
                                        Ukuran Asli: <strong class="text-danger">${formatBytes(result.originalSize)}</strong>
                                        <i class="fa fa-arrow-right mx-1 text-muted"></i>
                                        Terkompres: <strong class="text-success">${formatBytes(result.compressedSize)}</strong>
                                    </div>
                                    <div class="text-success small fw-semibold mt-1">
                                        <i class="fa fa-check-circle me-1"></i>Foto siap diupload dengan ukuran optimal
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                } else {
                    // Image already optimal
                    const objectUrl = URL.createObjectURL(rawFile);
                    previewBox.innerHTML = `
                        <div class="card p-2 border-secondary bg-light mt-2" style="max-width: 400px; border-radius: 8px;">
                            <div class="d-flex align-items-center">
                                <img src="${objectUrl}" alt="Preview" class="rounded me-3 border" style="width: 60px; height: 60px; object-fit: cover;">
                                <div>
                                    <span class="badge bg-info mb-1">Ukuran Optimal</span>
                                    <div class="small text-muted">Ukuran: <strong>${formatBytes(rawFile.size)}</strong></div>
                                </div>
                            </div>
                        </div>
                    `;
                }
            } catch (err) {
                console.warn('Gagal kompres foto di browser, backend akan mengompres otomatis:', err);
                previewBox.style.display = 'none';
            }
        });
    }

    // Auto-discover inputs on DOM ready
    function init() {
        const fileInputs = document.querySelectorAll('input[type="file"][name="foto"], input[type="file"][name="foto_kos"], input[type="file"].auto-compress');
        fileInputs.forEach(setupPhotoCompressor);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    // Export globally in case views want to trigger manually
    window.setupPhotoCompressor = setupPhotoCompressor;
    window.compressImageFile = compressImageFile;
})();
