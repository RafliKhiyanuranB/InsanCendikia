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
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="foto">Foto Kos</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="file" class="form-control" id="foto" name="foto">
                                    <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah foto kos.</small>
                                    @if($kos->foto)
                                        <img src="{{ asset('storage/'.$kos->foto) }}" alt="Foto Kos" class="mt-2" style="max-width: 200px">
                                    @endif
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
                                    <label for="alamat">Alamat Kos</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" value="{{ old('alamat', $kos->alamat) }}" required>
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="harga">Harga Sewa</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ old('harga', $kos->harga) }}" required>
                                    @error('harga')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
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
                                    <textarea name="description" id="description" style="display: none;">{{ old('description', $kos->description) }}</textarea>
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group mt-3">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="kategori_id">Kategori</label>
                                </div>
                                <div class="col-md-10">
                                    <select name="kategori_id" id="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror" required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach($kategoris as $kategori)
                                            <option value="{{ $kategori->id }}" {{ old('kategori_id', $kos->kategori_id) == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                    @error('kategori_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="status">Status</label>
                                </div>
                                <div class="col-md-10">
                                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                                        <option value="tersedia" {{ old('status', $kos->status) == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                        <option value="tidak_tersedia" {{ old('status', $kos->status) == 'tidak_tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
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
        quill.root.innerHTML = $('#description').val();

        $('#kosForm').on('submit', function(e) {
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