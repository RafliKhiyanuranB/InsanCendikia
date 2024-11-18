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
                                <li class="breadcrumb-item active">Edit Pariwisata</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Edit Pariwisata</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form id="pariwisataForm" method="POST" action="{{ route('pariwisata.update', $pariwisata->id) }}" enctype="multipart/form-data">
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
                                    @if ($pariwisata->foto)
                                        <img src="{{ asset('storage/' . $pariwisata->foto) }}" alt="Foto Pariwisata" class="mt-2 img-thumbnail" width="100">
                                    @endif
                                    <input type="file" class="form-control" id="foto" name="foto">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group mt-3">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="nm_pariwisata">Nama Pariwisata</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" id="nm_pariwisata" name="nm_pariwisata" value="{{ old('nm_pariwisata', $pariwisata->nm_pariwisata) }}" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group" style="margin-bottom: 8%">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="description">Deskripsi</label>
                                </div>
                                <div class="col-md-10">
                                    <div id="description-editor">{!! old('description', $pariwisata->description) !!}</div>
                                    <textarea name="description" id="description" style="display: none;">{{ old('description', $pariwisata->description) }}</textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group mt-3">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="kabupaten_id">Kabupaten</label>
                                </div>
                                <div class="col-md-10">
                                    <select name="kabupaten_id" id="kabupaten_id" class="form-select" required>
                                        <option value="">Select Kabupaten</option>
                                        @foreach($kabupatens as $kabupaten)
                                            <option value="{{ $kabupaten->id }}" {{ old('kabupaten_id', $pariwisata->kabupaten_id) == $kabupaten->id ? 'selected' : '' }}>
                                                {{ $kabupaten->nama_kabupaten }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
                <button type="submit" class="btn btn-primary btn-sm px-4">Simpan</button>
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
        var quill = new Quill('#description-editor', {
            theme: 'snow'
        });

        $('#pariwisataForm').submit(function(e) {
            e.preventDefault();
            $('#description').val(quill.root.innerHTML);

            var formData = new FormData($(this)[0]);

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false, 
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Pariwisata Berhasil Diperbarui!',
                        text: response.message,
                        confirmButtonText: 'OK',
                        willClose: () => {
                            window.location.href = '{{ route('pariwisata.index') }}';
                        }
                    });
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.responseJSON ? xhr.responseJSON.message : 'Terjadi kesalahan, coba lagi!';
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: errorMessage,
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    });
</script>

