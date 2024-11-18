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
                                <li class="breadcrumb-item"><a href="{{ route('pariwisata.index') }}">Pariwisata</a></li>
                                <li class="breadcrumb-item active">Tambah Pariwisata</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Tambah Pariwisata</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form id="pariwisataForm">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="foto">Foto</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="file" class="form-control" id="foto" name="foto" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group mt-3">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="nm_pariwisata">Nama Pariwisata</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" id="nm_pariwisata" name="nm_pariwisata" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group" style="margin-bottom: 8%">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="description">Deskripsi</label>
                                </div>
                                <div class="col-md-10">
                                    <div id="description-editor"></div>
                                    <textarea name="description" id="description" style="display: none;"></textarea>
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
                                            <option value="{{ $kabupaten->id }}">{{ $kabupaten->nama_kabupaten }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
                <button type="button" class="btn btn-primary btn-sm px-4" id="savePariwisataButton">Simpan</button>
                <a href="{{ route('pariwisata.index') }}" class="btn btn-secondary btn-sm px-4">Kembali</a>
            </form>
        </div>
    </div>
@endsection

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize Quill
        var quill = new Quill('#description-editor', {
            theme: 'snow'
        });

        // Sync Quill content to the textarea before form submit
        $('#savePariwisataButton').click(function() {
            $('#description').val(quill.root.innerHTML);
            var formData = new FormData($('#pariwisataForm')[0]);
            formData.append('description', $('#description').val());

            $.ajax({
                url: '{{ route('pariwisata.store') }}',
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
                            window.location.href = '{{ route('pariwisata.index') }}';
                        }
                    });
                },
                error: function(response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan',
                        text: 'Gagal menyimpan data, silakan coba lagi!',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    });
</script>