@extends('cms.index')

@section('content')
    @include('seller.items.wizard')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <div class="text-center">
            <form action="{{ route('upload.product.file.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    @foreach (['Image' => 'logo', 'Gambar TKDN' => 'banner', 'Gambar BMP' => 'ktp', 'Pdf Spec' => 'npwp'] as $label => $type)
                        @if (isset($uploaded_files[$type]))
                            <div class="file-info">
                                <div class="file-box">
                                    <h3>{{ $label }}</h3>
                                    @if (isset($uploaded_files[$type]['type']) && $uploaded_files[$type]['type'] === 'image')
                                        <img src="{{ asset('storage/product_files/' . $uploaded_files[$type]['path']) }}" alt="{{ $label }}" class="file-thumbnail">
                                    @else
                                        <a href="{{ asset('storage/product_files/' . $uploaded_files[$type]['path']) }}" target="_blank">Lihat</a>
                                    @endif
                                    <form action="{{ route('product-deleteFile-product', $type) }}" method="POST">
                                        @csrf
                                        @method('delete') 
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <div class="file-info">
                                <div class="file-box">
                                    <h3>{{ $label }}</h3>
                                    <form action="{{ route('upload.product.file.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="file_type" value="{{ $type }}">
                                        <input type="file" name="file" class="form-control-file" accept=".jpeg, .jpg, .png, .pdf">
                                        <button type="submit" class="btn btn-primary">Unggah</button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </form>
        </div>
        <hr>
        <div class="text-center">
            @if (Session::has('uploaded_files') && is_array(Session::get('uploaded_files')))
            <div class="file-container">
                @foreach (Session::get('uploaded_files') as $key => $file)
                    <div class="file-info">
                        <div class="file-box">
                            <h3>{{ $file['name'] }}</h3>
                            @if (isset($file['type']) && $file['type'] === 'image')
                                <a href="{{ asset('storage/product_files/' . $file['path']) }}" target="_blank">Lihat</a>
                                <img src="{{ route('thumbnail', ['key' => $key]) }}" alt="{{ $file['name'] }}" class="file-thumbnail">
                            @else
                                <a href="{{ asset('storage/product_files/' . $file['path']) }}" target="_blank">Lihat</a>
                            @endif
                            <form action="{{ route('deleteFile', $key) }}" method="POST">
                                @csrf
                                @method('delete') 
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
            @endif
        </div>
        <div class="text-center">
            <a href="{{ route('summary.publish') }}" class="btn btn-primary">Selanjutnya</a>
        </div>
    </div>
@endsection

<style>
    .file-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .file-info {
        flex: 0 0 calc(33.33% - 20px);
        margin: 10px;
    }

    .file-box {
        border: 1px solid #ccc;
        padding: 10px;
        text-align: center;
    }

    .file-thumbnail {
        max-width: 100px;
    }
</style>
