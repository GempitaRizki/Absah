@extends('seller.layout')

@section('content')
    @if (session('success'))
        <div style="background-color: #4CAF50; color: white; padding: 10px;">{{ session('success') }}</div>
    @endif

    <div style="text-align: center;">
        <form action="{{ route('uploadForm') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div style="display: inline-block; margin-right: 20px; text-align: center;">
                <h3>Logo</h3>
                <input type="file" name="logo" accept=".pdf">
            </div>
            <div style="display: inline-block; margin-right: 20px; text-align: center;">
                <h3>Banner</h3>
                <input type="file" name="banner" accept=".pdf">
            </div>
            <div style="display: inline-block; margin-right: 20px; text-align: center;">
                <h3>KTP</h3>
                <input type="file" name="ktp" accept=".pdf">
            </div>
            <div style="display: inline-block; margin-right: 20px; text-align: center;">
                <h3>NPWP</h3>
                <input type="file" name="npwp" accept=".pdf">
            </div>
            <div style="display: inline-block; margin-right: 20px; text-align: center;">
                <h3>Akta Perubahan</h3>
                <input type="file" name="aktaprb" accept=".pdf">
            </div>
            <div style="display: inline-block; margin-right: 20px; text-align: center;">
                <h3>SIUP</h3>
                <input type="file" name="siup" accept=".pdf">
            </div>
            <div style="display: inline-block; margin-right: 20px; text-align: center;">
                <h3>NPWP Badan Usaha</h3>
                <input type="file" name="npwpbu" accept=".pdf">
            </div>  
            <div style="display: inline-block; margin-right: 20px; text-align: center;">
                <h3>NIB</h3>
                <input type="file" name="nib" accept=".pdf">
            </div>    
            <div style="display: inline-block; margin-right: 20px; text-align: center;">
                <h3>SKB</h3>
                <input type="file" name="skb" accept=".pdf">
            </div>
            <div style="display: inline-block; margin-right: 20px; text-align: center;">
                <h3>Bebas Pejak Tertentu</h3>
                <input type="file" name="bpt" accept=".pdf">
            </div> 
            <div style="display: inline-block; margin-right: 20px; text-align: center;">
                <h3>KBLI</h3>
                <input type="file" name="kbli" accept=".pdf">
            </div>
            <div style="display: inline-block; margin-right: 20px; text-align: center;">
                <h3>TDP</h3>
                <input type="file" name="tdp" accept=".pdf">
            </div>
            <div style="display: inline-block; margin-right: 20px; text-align: center;">
                <h3>PKP</h3>
                <input type="file" name="pkp" accept=".pdf">
            </div>        
            <br><br>
            <div class="bs-example">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 bg-light text-right">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
