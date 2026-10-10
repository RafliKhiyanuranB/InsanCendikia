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
                                <li class="breadcrumb-item"><a href="{{ route('kos.index') }}">Kos</a></li>
                                <li class="breadcrumb-item active">Tambah Kos</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Tambah Kos</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form id="kosForm" method="POST" action="{{ route('kos.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="foto_kos">Foto</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="file" class="form-control" id="foto" name="foto_kos" accept="image/*" required>
                                    <small class="form-text text-muted"><i class="fa fa-compress text-success me-1"></i>Auto photo compress aktif (otomatis dioptimalkan saat upload).</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group mt-3">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="nm_kos">Nama Kos</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" id="nm_kos" name="nm_kos" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group" style="margin-bottom: 8%">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="deskripsi_kos">Deskripsi</label>
                                </div>
                                <div class="col-md-10">
                                    <div id="description-editor"></div>
                                    <textarea name="deskripsi_kos" id="deskripsi_kos" style="display: none;"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="tipe_kos">Tipe</label>
                                </div>
                                <div class="col-md-10">
                                    <select name="tipe_kos" id="tipe_kos" class="form-select" required>
                                        <option value="">Pilih Tipe</option>
                                        <option value="Putra">Putra</option>
                                        <option value="Putri">Putri</option>
                                        <option value="Campur">Campur</option>
                                    </select>
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

        var table = $('#kosTable').DataTable({
            processing: true,
            serverSide: true,
            scrollX: true,
            ajax: '{{ route('kos.getData') }}',  // Mengambil data dari server
            columns: [
                { data: 'foto', name: 'foto' },
                { data: 'nm_kos', name: 'nm_kos' },
                { data: 'description', name: 'description' },
                { data: 'tipe', name: 'tipe' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
        // Sync Quill content to the textarea before form submit
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