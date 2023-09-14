@extends('themes.ezone.register')

@section('content')

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<div class="container mt-5">
    <div class="col-lg-12">
        <div class="d-flex justify-content-center">
            <h2>Register</h2>
        </div>
        <div class="d-flex justify-content-center">
            <img src="{{url('assets/img/product/absahlogo.png')}}" alt="logoip.png" width="300pxs">
        </div>
    </div>
</div>

<div class="container mt-3">
    <div class="col-lg-12">
        <div class="signup">
            <div class="d-flex justify-content-center">
                <div class="col-lg-4 justify-content-center">
                        <div class="card card-body mb-2">
                            <center>
                                <img src="{{url('assets/img/logo/pembeli.png')}}" alt="pembeli.png" width="50px" height="50px">
                                <br>
                                <a href="{{ route('register.validate') }}">Register Pembeli</a> 
                            </center>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4 justify-content-center">
                        <div class="card card-body mb-2">
                            <center>
                                <img src="{{url('assets/img/logo/penyedia.png')}}" alt="penyedia.png" width="50px" height="50px">
                                <br>
                                <a href="{{ url('#') }}">Register Penjual</a>
                            </center>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection