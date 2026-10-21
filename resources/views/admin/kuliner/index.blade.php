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
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                                <li class="breadcrumb-item active">Kuliner</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Data Kuliner</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Tombol Tambah -->
            <div class="mb-3 d-flex justify-content-end">
                <a href="{{ route('kuliner.create') }}" class="btn btn-success btn-sm px-4">
                    <i class="fas fa-plus"></i> Tambah Kuliner
                </a>
            </div>

            <!-- Tabel Data Kuliner -->
            <div class="card">
                <div class="card-body">
                    <table id="kulinerTable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Nama Kuliner</th>
                                <th>Deskripsi</th>
                                <th width="120px">Action</th>
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
        var table = $('#kulinerTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('kuliner.getData') }}',
            columns: [
                { 
                    data: 'foto', 
                    name: 'foto',
                    orderable: false,
                    searchable: false,
                    render: function(data) {
                        return data;
                    }
                },
                { data: 'nm_kuliner', name: 'nm_kuliner' },
                { 
                    data: 'description', 
                    name: 'description',
                    render: function(data) {
                        return data;
                    }
                },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });

        // Hapus data dengan AJAX
        $('#kulinerTable').on('click', '.delete-btn', function() {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ url('kuliner') }}/' + id,
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            table.ajax.reload();
                            Swal.fire(
                                'Terhapus!',
                                'Data kuliner berhasil dihapus.',
                                'success'
                            );
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Error!',
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
