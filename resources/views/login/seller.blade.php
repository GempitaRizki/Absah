@extends('seller.topbar')
@section('content')
    <div id="card">
        <div id="card-content">
            <div id="card-title">
                <h2>Seller</h2>
                <div class="underline-title"></div>
            </div>
            <form method="post" class="form" action="{{ route('seller-post') }}">
                @csrf 
                @if(session('login')) <!-- Menampilkan pesan kesalahan jika ada -->
                    <div class="alert alert-danger">
                        {{ session('login') }}
                    </div>
                @endif
                <label for="user-email" style="padding-top:13px">
                    &nbsp;Email
                </label>
                <input id="user-email" class="form-content" type="email" name="email" autocomplete="on" required />
                <div class="form-border"></div>
                <label for="user-password" style="padding-top:22px">&nbsp;Password
                </label>
                <input id="user-password" class="form-content" type="password" name="password" required />
                <div class="form-border"></div>
                <a href="#">
                    <legend id="forgot-pass">Forgot password?</legend>
                </a>
                <input id="submit-btn" type="submit" name="submit" value="LOGIN" />
            </form>
        </div>
    </div>
@endsection
