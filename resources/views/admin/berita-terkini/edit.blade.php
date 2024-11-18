@extends('index')

@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('berita.index') }}">Berita Terkini</a></li>
                                <li class="breadcrumb-item active">Edit Berita Terkini</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Edit Berita Terkini</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Edit -->
            <form id="pariwisataForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="foto">Foto</label>
                                </div>
                                <div class="col-md-10">
                                    @if($berita->foto)
                                        <img src="{{ asset('storage/' . $berita->foto) }}" alt="Foto Berita" class="mb-2 img-thumbnail" width="100">
                                    @endif
                                    <input type="file" class="form-control" id="foto" name="foto">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group mt-3">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="nm_berita">Judul Berita</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" id="nm_berita" name="nm_berita" value="{{ old('nm_berita', $berita->nm_berita) }}" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group" style="margin-bottom: 8%">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="description">Deskripsi</label>
                                </div>
                                <div class="col-md-10">
                                    <div id="description-editor">{!! old('description', $berita->description) !!}</div>
                                    <textarea name="description" id="description" style="display: none;">{{ old('description', $berita->description) }}</textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group mt-3">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="kabupaten_id">Kabupaten</label>
                                </div>
                                <div class="col-md-10">
                                    <select name="kabupaten_id" id="kabupaten_id" class="form-select">
                                        <option value="">Select Kabupaten</option>
                                        @foreach($kabupatens as $kabupaten)
                                            <option value="{{ $kabupaten->id }}" {{ $kabupaten->id == $berita->kabupaten_id ? 'selected' : '' }}>
                                                {{ $kabupaten->nama_kabupaten }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
                <button type="button" class="btn btn-primary btn-sm px-4" id="updateBeritaButton">Update</button>
                <a href="{{ route('berita.index') }}" class="btn btn-secondary btn-sm px-4">Kembali</a>
            </form>
        </div>
    </div>
@endsection

<!-- Link to Quill CSS and JS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize Quill Editor with current description
        var quill = new Quill('#description-editor', {
            theme: 'snow'
        });

        // Sync Quill content to textarea before form submit
        $('#updateBeritaButton').click(function() {
            $('#description').val(quill.root.innerHTML); // Assign the content to hidden textarea
            var formData = new FormData($('#pariwisataForm')[0]);
            formData.append('description', $('#description').val()); // Append description to formData

            $.ajax({
                url: '{{ route('berita.update', $berita->id) }}', // Route to update berita
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message,
                        confirmButtonText: 'OK',
                        willClose: () => {
                            window.location.href = '{{ route('berita.index') }}'; // Redirect after success
                        }
                    });
                },
                error: function(response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan',
                        text: 'Gagal memperbarui data, silakan coba lagi!',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    });
</script>
