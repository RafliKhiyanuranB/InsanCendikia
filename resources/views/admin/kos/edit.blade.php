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
                                <li class="breadcrumb-item"><a href="{{ route('kos.index') }}">Kos</a></li>
                                <li class="breadcrumb-item active">Edit Kos</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Edit Data Kos</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form id="kosForm" method="POST" action="{{ route('kos.update', $kos->id) }}" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="foto">Foto Kos</label>
                                </div>
                                <div class="col-md-10">
                                    @if($kos->foto_kos)
                                        <img src="{{ asset('storage/'.$kos->foto_kos) }}" alt="Foto Kos" class="mt-2 img-thumbnail" style="max-width: 100px">
                                    @endif
                                    <input type="file" class="form-control" id="foto" name="foto_kos" accept="image/*">
                                    <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah foto kos. <span class="text-success"><i class="fa fa-compress me-1"></i>Auto photo compress aktif</span></small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group mt-3">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="nm_kos">Nama Kos</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" class="form-control @error('nm_kos') is-invalid @enderror" id="nm_kos" name="nm_kos" value="{{ old('nm_kos', $kos->nm_kos) }}" required>
                                    @error('nm_kos')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group mt-3">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="tipe_kos">Tipe Kos</label>
                                </div>
                                <div class="col-md-10">
                                    <select name="tipe_kos" id="tipe_kos" class="form-select" required>
                                        <option value="">Pilih Tipe</option>
                                        <option value="Putra" {{ $kos->tipe_kos == 'Putra' ? 'selected' : '' }}>Putra</option>
                                        <option value="Putri" {{ $kos->tipe_kos == 'Putri' ? 'selected' : '' }}>Putri</option>
                                        <option value="Campur" {{ $kos->tipe_kos == 'Campur' ? 'selected' : '' }}>Campur</option>
                                    </select>
                                    @error('tipe_kos')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-3" style="margin-bottom: 8%">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="deskripsi_kos">Deskripsi</label>
                                </div>
                                <div class="col-md-10">
                                    <div id="description-editor"></div>
                                    <textarea name="deskripsi_kos" id="deskripsi_kos" style="display: none;">{{ old('deskripsi_kos', $kos->deskripsi_kos) }}</textarea>
                                    @error('deskripsi_kos')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
                <button type="submit" class="btn btn-primary btn-sm px-4">Simpan</button>
                <a href="{{ route('kos.index') }}" class="btn btn-secondary btn-sm px-4">Kembali</a>
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
            placeholder: 'Tulis deskripsi kos disini...'
        });

        // Set existing content
        quill.root.innerHTML = $('#deskripsi_kos').val();

        $('#kosForm').on('submit', function(e) {
            e.preventDefault();
            $('#deskripsi_kos').val(quill.root.innerHTML);
            var formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
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
                            window.location.href = '{{ route('kos.index') }}';
                        }
                    });
                },
                error: function(xhr) {
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
