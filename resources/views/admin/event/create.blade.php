@extends('index')

@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('event.index') }}">Event</a></li>
                                <li class="breadcrumb-item active">Tambah Event</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Tambah Data Event</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form id="eventForm" method="POST" action="{{ route('event.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Form Tambah Event</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group row mb-3">
                                    <label class="col-md-2 col-form-label" for="foto">Foto Event</label>
                                    <div class="col-md-10">
                                        <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto" required>
                                        @error('foto')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-3">
                                    <label class="col-md-2 col-form-label" for="nm_event">Nama Event</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control @error('nm_event') is-invalid @enderror" id="nm_event" name="nm_event" value="{{ old('nm_event') }}" required>
                                        @error('nm_event')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label class="col-md-2 col-form-label" for="tanggal">Tanggal Event</label>
                                    <div class="col-md-10">
                                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
                                        @error('tanggal')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label class="col-md-2 col-form-label" for="waktu">Waktu Event</label>
                                    <div class="col-md-10">
                                        <input type="time" class="form-control @error('waktu') is-invalid @enderror" id="waktu" name="waktu" value="{{ old('waktu') }}" required>
                                        @error('waktu')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label class="col-md-2 col-form-label" for="lokasi">Lokasi Event</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control @error('lokasi') is-invalid @enderror" id="lokasi" name="lokasi" value="{{ old('lokasi') }}" required>
                                        @error('lokasi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label" for="description">Deskripsi</label>
                                    <div class="col-md-10">
                                        <div id="description-editor" style="height: 300px;"></div>
                                        <textarea name="description" id="description" style="display: none;">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mt-4">
                                    <div class="col-md-12 text-end">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <a href="{{ route('event.index') }}" class="btn btn-secondary">Kembali</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
        var quill = new Quill('#description-editor', {
            theme: 'snow',
            placeholder: 'Tulis deskripsi event disini...'
        });

        // Set existing content
        quill.root.innerHTML = $('#description').val();

        $('#eventForm').on('submit', function(e) {
            e.preventDefault();
            $('#description').val(quill.root.innerHTML);
            var formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log('Success:', response);
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message,
                        confirmButtonText: 'OK',
                        willClose: () => {
                            window.location.href = '{{ route('event.index') }}';
                        }
                    });
                },
                error: function(xhr) {
                    console.log('Error:', xhr.responseJSON);
                    let errors = xhr.responseJSON.errors;
                    let errorMessage = '';
                    
                    for (let key in errors) {
                        errorMessage += errors[key][0] + '\n';
                    }
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan',
                        text: errorMessage || 'Gagal menyimpan data, silakan coba lagi!',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    });
</script>