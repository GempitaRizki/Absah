@extends('seller.layout')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- Tambahkan link CSS dan script JS dari Bootstrap dan FileInput -->
        <!-- ... -->

        <style type="text/css">
            /* Tambahkan gaya kustom Anda di sini */
            /* ... */
        </style>
    </head>

    <body>
        {!! csrf_field() !!}
        <div class="form-group">
            <div class="file-loading">
                <div class="file-box">
                    <label for="file-1" class="text-center">Logo</label>
                    <input id="file-1" type="file" name="file" multiple class="file"
                        data-overwrite-initial="false" data-min-file-count="2">
                </div>
                <!-- Tambahkan file-box lain sesuai dengan kebutuhan -->
            </div>
        </div>

        <div class="form-group{{ $errors->has('terms') ? ' has-error' : '' }}">
            <div class="text-right">
                <input type="checkbox" class="form-check-input" name="terms" value="1" id="termsCheckbox" />
                <label class="form-check-label" for="termsCheckbox">
                    <a href="#" data-toggle="modal" data-target="#termsModal">Saya Mengerti dan Setuju</a>
                </label>
            </div>
        
            <div class="col-md-4">
                @if ($errors->has('terms'))
                    <span class="help-block">
                        <strong>{{ $errors->first('terms') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <!-- Modal Terms -->
        <div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="termsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="termsModalLabel">Syarat dan Ketentuan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Isi dari Syarat dan Ketentuan di sini -->
                        <!-- ... -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tambahkan link JS untuk jQuery, Bootstrap, dan FileInput di sini -->
        <!-- ... -->

        <script type="text/javascript">
            $(".file-loading input").each(function() {
                var id = $(this).attr('id');
                $("#" + id).fileinput({
                    theme: 'fa',
                    uploadUrl: "{{ route('upload.file') }}", // Sesuaikan dengan rute untuk mengunggah file
                    uploadExtraData: function() {
                        return {
                            _token: $("input[name='_token']").val(),
                            id: $("#id").val(), // Ganti dengan cara Anda mendapatkan ID
                            store_id: $("#store_id").val(), // Ganti dengan cara Anda mendapatkan store_id
                            file_category: $("#file_category").val() // Ganti dengan cara Anda mendapatkan kategori file
                        };
                    },
                    allowedFileExtensions: ['jpg', 'png', 'gif', 'pdf'], // Sesuaikan dengan ekstensi file yang diizinkan
                    overwriteInitial: false,
                    maxFileSize: 2000,
                    maxFilesNum: 10,
                    slugCallback: function(filename) {
                        return filename.replace('(', '_').replace(']', '_');
                    }
                });
            });
        </script>
    </body>

    </html>
@endsection
