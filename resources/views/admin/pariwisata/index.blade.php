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
                                <li class="breadcrumb-item active">Pariwisata</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Pariwisata</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Tombol Tambah -->
            <div class="mb-3 d-flex justify-content-end">
                <a href="{{ route('pariwisata.create') }}" class="btn btn-success btn-sm px-4">Tambah</a>
            </div>

            <!-- Tabel Data Kabupaten -->
            <div class="card">
                <div class="card-body">
                    <table id="pariwisataTable" class="table table-bordered dt-responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Pariwisata</th>
                                <th>Kabupaten</th>
                                <th width="50px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data akan dimuat di sini menggunakan DataTables -->
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
        var table = $('#pariwisataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('pariwisata.getData') }}',  // Mengambil data dari server
            columns: [
                { data: 'foto', name: 'foto', orderable: false, searchable: false },
                { data: 'nm_pariwisata', name: 'nm_pariwisata' },
                { data: 'nama_kabupaten', name: 'nama_kabupaten' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });

        // Hapus data dengan AJAX
        $('#pariwisataTable').on('click', '.delete-btn', function() {
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
                        url: '{{ url('pariwisata') }}/' + id,
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}',  // Pastikan untuk mengirim token CSRF
                        },
                        success: function(response) {
                            table.ajax.reload(); // Reload DataTable setelah penghapusan
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
