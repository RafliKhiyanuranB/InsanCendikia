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
                                <li class="breadcrumb-item"><a href="{{ route('kuliner.index') }}">Kuliner</a></li>
                                <li class="breadcrumb-item active">Edit Kuliner</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Edit Kuliner</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form id="kulinerForm" method="POST" action="{{ route('kuliner.update', $kuliner->id) }}" enctype="multipart/form-data">
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
                                    @if ($kuliner->foto)
                                        <img src="{{ asset('storage/' . $kuliner->foto) }}" alt="Foto Kuliner" class="mt-2 img-thumbnail" width="100">
                                    @endif
                                    <input type="file" class="form-control" id="foto" name="foto">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group mt-3">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="nm_kuliner">Nama Kuliner</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" id="nm_kuliner" name="nm_kuliner" value="{{ old('nm_kuliner', $kuliner->nm_kuliner) }}" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group" style="margin-bottom: 8%">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="description">Deskripsi</label>
                                </div>
                                <div class="col-md-10">
                                    <div id="description-editor">{!! old('description', $kuliner->description) !!}</div>
                                    <textarea name="description" id="description" style="display: none;">{{ old('description', $kuliner->description) }}</textarea>
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
                                            <option value="{{ $kabupaten->id }}" {{ old('kabupaten_id', $kuliner->kabupaten_id) == $kabupaten->id ? 'selected' : '' }}>
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
                <a href="{{ route('kuliner.index') }}" class="btn btn-secondary btn-sm px-4">Kembali</a>
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

        $('#kulinerForm').submit(function(e) {
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
                        title: 'Kuliner Berhasil Diperbarui!',
                        text: response.message,
                        confirmButtonText: 'OK',
                        willClose: () => {
                            window.location.href = '{{ route('kuliner.index') }}';
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
