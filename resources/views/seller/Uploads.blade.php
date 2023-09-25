@extends('seller.layout')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all"
            rel="stylesheet" type="text/css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" media="all"
            rel="stylesheet" type="text/css" />

        <style type="text/css">
            .main-section {
                margin: 0 auto;
                padding: 20px;
                margin-top: 50px;
                background-color: #fff;
                box-shadow: 0px 0px 20px #c1c1c1;
            }

            .fileinput-remove,
            .fileinput-upload {
                display: none;
            }

            .file-loading {
                display: flex;
                flex-wrap: wrap;
                gap: 20px;
            }

            .file-box {
                flex: 1;
                max-width: calc(33.33% - 20px);
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 5px;
                margin-bottom: 20px;
            }

            .file-box label {
                font-weight: bold;
            }

            .file-loading .file-box:nth-child(6n+1) {
                clear: left;
            }
        </style>
    </head>

    <body>
        {!! csrf_field() !!}
        <div class="form-group ">
            <div class="file-loading">
                <form method="POST" action="{{ route('upload.file') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="1">
                    <input type="hidden" name="store_id" value="123">
                    <input type="hidden" name="file_category" value="logo">
                    <input type="file" name="file">
                    <button type="submit">Unggah File</button>
                </form>
                

                <div class="file-box">
                    <label for="file-1" class="text-center">Logo</label>
                    <input id="file-1" type="file" name="file" multiple class="file"
                        data-overwrite-initial="false" data-min-file-count="2">
                </div>
                <div class="file-box">
                    <label for="file-2" class="text-center">Banneer</label>
                    <input id="file-2" type="file" name="file" multiple class="file"
                        data-overwrite-initial="false" data-min-file-count="2">
                </div>
                <div class="file-box">
                    <label for="file-3" class="text-center">KTP</label>
                    <input id="file-3" type="file" name="file" multiple class="file"
                        data-overwrite-initial="false" data-min-file-count="2">
                </div>
                <div class="file-box">
                    <label for="file-4" class="text-center">NPWP</label>
                    <input id="file-4" type="file" name="file" multiple class="file"
                        data-overwrite-initial="false" data-min-file-count="2">
                </div>
                <div class="file-box">
                    <label for="file-5" class="text-center">Buku Tabungan</label>
                    <input id="file-5" type="file" name="file" multiple class="file"
                        data-overwrite-initial="false" data-min-file-count="2">
                </div>
            </div>
            <div class="file-loading">
                <div class="file-box">
                    <label for="file-6" class="text-center">Akta</label>
                    <input id="file-6" type="file" name="file" multiple class="file"
                        data-overwrite-initial="false" data-min-file-count="2">
                </div>
                <div class="file-box">
                    <label for="file-7" class="text-center">Akta Perubahan</label>
                    <input id="file-7" type="file" name="file" multiple class="file"
                        data-overwrite-initial="false" data-min-file-count="2">
                </div>
                <div class="file-box">
                    <label for="file-8" class="text-center">SIUP</label>
                    <input id="file-8" type="file" name="file" multiple class="file"
                        data-overwrite-initial="false" data-min-file-count="2">
                </div>
                <div class="file-box">
                    <label for="file-9" class="text-center">NPWP Badan Usaha</label>
                    <input id="file-9" type="file" name="file" multiple class="file"
                        data-overwrite-initial="false" data-min-file-count="2">
                </div>
                <div class="file-box">
                    <label for="file-10" class="text-center">NIB</label>
                    <input id="file-10" type="file" name="file" multiple class="file"
                        data-overwrite-initial="false" data-min-file-count="2">
                </div>
            </div>
            <div class="file-loading">
                <div class="file-box">
                    <label for="file-11" class="text-center">SKB</label>
                    <input id="file-11" type="file" name="file" multiple class="file"
                        data-overwrite-initial="false" data-min-file-count="2">
                </div>
                <div class="file-box">
                    <label for="file-12" class="text-center">Bebas Pajak Tertentu</label>
                    <input id="file-12" type="file" name="file" multiple class="file"
                        data-overwrite-initial="false" data-min-file-count="2">
                </div>
                <div class="file-box">
                    <label for="file-13" class="text-center">KBLI</label>
                    <input id="file-13" type="file" name="file" multiple class="file"
                        data-overwrite-initial="false" data-min-file-count="2">
                </div>
                <div class="file-box">
                    <label for="file-14" class="text-center">TDP</label>
                    <input id="file-14" type="file" name="file" multiple class="file"
                        data-overwrite-initial="false" data-min-file-count="2">
                </div>
                <div class="file-box">
                    <label for="file-15" class="text-center">PKP</label>
                    <input id="file-15" type="file" name="file" multiple class="file"
                        data-overwrite-initial="false" data-min-file-count="2">
                </div>
            </div>
        </div>
        <br>
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
        



        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js" type="text/javascript">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js"
            type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" type="text/javascript"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(".file-loading input").each(function() {
                var id = $(this).attr('id');
                $("#" + id).fileinput({
                    theme: 'fa',
                    uploadUrl: "/image-view",
                    uploadExtraData: function() {
                        return {
                            _token: $("input[name='_token']").val(),
                        };
                    },
                    allowedFileExtensions: ['jpg', 'png', 'gif', 'pdf'],
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
