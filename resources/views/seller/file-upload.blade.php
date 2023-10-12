@extends('seller.layout')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="text-center">
            <form action="{{ route('uploadForm') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    @foreach ([
            'Logo' => 'logo',
            'Banner' => 'banner',
            'KTP' => 'ktp',
            'NPWP' => 'npwp',
            'Akta Perubahan' => 'aktaprb',
            'SIUP' => 'siup',
            'NPWP Badan Usaha' => 'npwpbu',
            'NIB' => 'nib',
            'SKB' => 'skb',
            'Bebas Pejak Tertentu' => 'bpt',
            'KBLI' => 'kbli',
            'TDP' => 'tdp',
            'PKP' => 'pkp',
        ] as $label => $type)
                        @if (isset($uploaded_files[$type]))
                            <div class="file-info">
                                <div class="file-box">
                                    <h3>{{ $label }}</h3>
                                    <a href="{{ $uploaded_files[$type]['path'] }}" target="_blank">Lihat</a>
                                    <form action="{{ route('deleteFile', $type) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <div class="file-info">
                                <div class="file-box">
                                    <h3>{{ $label }}</h3>
                                    <form action="{{ route('uploadForm') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="file_type" value="{{ $type }}">
                                        <input type="file" name="file" class="form-control-file" accept=".pdf">
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
                                @if (isset($file['type']) &&
                                        in_array($file['type'], [
                                            'logo',
                                            'banner',
                                            'ktp',
                                            'npwp',
                                            'aktaprb',
                                            'siup',
                                            'npwpbu',
                                            'nib',
                                            'skb',
                                            'bpt',
                                            'kbli',
                                            'tdp',
                                            'pkp',
                                        ]))
                                    <a href="{{ $file['path'] }}" target="_blank">Lihat</a>
                                @endif
                                @if (isset($file['thumbnail']))
                                    <img src="{{ $file['thumbnail'] }}" alt="{{ $file['name'] }}" class="file-thumbnail">
                                @endif
                                <form action="{{ route('deleteFile', $key) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
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