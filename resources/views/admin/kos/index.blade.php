@extends('index')
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"   
    crossorigin="anonymous">
</head>
@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active">Kos</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Kos</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Tombol Tambah -->
            <div class="mb-3 d-flex justify-content-end">
                <a href="{{ route('kos.create') }}" class="btn btn-success btn-sm px-4">Tambah</a>
            </div>

            <!-- Tabel Data Kos -->
            <div class="card">
                <div class="card-body">
                    <table id="kosTable" class="table table-bordered dt-responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Nama Kos</th>
                                <th>Deskripsi</th>
                                <th>Tipe</th>
                                <th width="50px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kos as $k)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/' . $k->foto_kos) }}" width="100">
                                </td>
                                <td>{{ $k->nm_kos }}</td>
                                <td>{{ Str::limit(strip_tags($k->deskripsi_kos), 80, '...') }}</td>
                                <td>{{ $k->tipe_kos }}</td>
                                <td>
                                    <a href="{{ route('kos.edit', $k->id) }}" class="btn btn-sm btn-warning px-4">Edit</a>
                                    <button type="button" class="btn btn-sm btn-danger delete-btn px-4" data-id="{{ $k->id }}">Hapus</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Inisialisasi DataTable
        var table = $('#kosTable').DataTable();

        // Hapus data dengan AJAX
        $('#kosTable').on('click', '.delete-btn', function() {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ url('kos') }}/' + id,
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            location.reload();
                            Swal.fire(
                                'Dihapus!',
                                response.message,
                                'success'
                            );
                        },
                        error: function() {
                            Swal.fire(
                                'Gagal!',
                                'Terjadi kesalahan saat menghapus data.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });
</script>
