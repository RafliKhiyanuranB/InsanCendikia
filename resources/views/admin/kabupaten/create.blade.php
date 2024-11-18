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
                                <li class="breadcrumb-item"><a href="{{ route('kabupaten.index') }}">Kabupaten</a></li>
                                <li class="breadcrumb-item active">Tambah Kabupaten</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Tambah Kabupaten</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form id="kabupatenForm">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama_kabupaten">Nama Kabupaten</label>
                            <input type="text" class="form-control" id="nama_kabupaten" name="nama_kabupaten" required>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary btn-sm px-4" id="saveKabupatenButton">Simpan</button>
                <a href="{{ route('kabupaten.index') }}" class="btn btn-secondary btn-sm px-4">Kembali</a>
            </form>
        </div>
    </div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Simpan data Create
        $('#saveKabupatenButton').click(function() {
            var data = $('#kabupatenForm').serialize();
            
            $.ajax({
                url: '{{ route('kabupaten.store') }}',
                method: 'POST',
                data: data,
                success: function(response) {
                    // Menggunakan SweetAlert2 untuk notifikasi sukses
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message,
                        confirmButtonText: 'OK',
                        willClose: () => {
                            window.location.href = '{{ route('kabupaten.index') }}';
                        }
                    });
                },
                error: function(response) {
                    // Menggunakan SweetAlert2 untuk notifikasi error
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
