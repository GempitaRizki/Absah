@extends('cms.index')

@section('content')
    @include('seller.Items.wizard')

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Upload File</h5>
            </div>
            <div class="card-body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                    <img src="{{ asset('images/' . Session::get('path')) }}">
                @endif

                <form action="{{ route('upload-file') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <input type="file" name="path" class="form-control">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6 offset-md-3">
                            <button type="submit" class="btn btn-success btn-block">Upload</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row mt-3">
                <div class="col-md-6 offset-md-3">
                    <button type="submit" class="btn btn-success">Upload</button>
                    <a href="{{ route('summary.publish') }}" class="btn btn-primary">Publish</a>
                </div>
            </div>
        </div>
    </div>
@endsection
