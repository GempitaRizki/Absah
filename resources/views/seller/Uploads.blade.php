@extends('themes.ezone.layout')

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

            .file-loading:after {
                content: "";
                display: none;
            }

            .file-box {
                flex: 1;
                max-width: calc(33.33% - 20px);
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 5px;
            }

            .file-box label {
                font-weight: bold;
            }
        </style>
    </head>

    <body>
        {!! csrf_field() !!}
        <div class="form-group">
            <div class="file-loading" style="display: flex; flex-wrap: wrap; gap: 20px;">
                <div class="file-box">
                    <label for="file-1">NPWP</label>
                    <input id="file-1" type="file" name="file" multiple class="file"
                        data-overwrite-initial="false" data-min-file-count="2">
                </div>
                <div class="file-box">
                    <label for="file-2">Label 2</label>
                    <input id="file-2" type="file" name="file" multiple class="file"
                        data-overwrite-initial="false" data-min-file-count="2">
                </div>
                <div class="file-box">
                    <label for="file-3">Label 3</label>
                    <input id="file-3" type="file" name="file" multiple class="file"
                        data-overwrite-initial="false" data-min-file-count="2">
                </div>
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
