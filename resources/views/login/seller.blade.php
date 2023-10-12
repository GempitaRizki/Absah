@extends('seller.topbar')

@section('content')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-size: 1em;
        }

        .login_form {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form {
            width: 30em;
            padding: 2em;
            border-radius: 1em;
            box-shadow: 0 10px 25px rgba(90, 100, 100, .2);
        }

        .form_title {
            font-weight: 300;
            margin-bottom: 1.3em;
            text-align: center;
        }

        .form_div {
            position: relative;
            height: 3em;
            margin-bottom: 1.6em;
        }

        .form_input {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            font-size: 1em;
            border: .1em solid #dadce0;
            border-radius: .5em;
            outline: none;
            padding: 1em;
            z-index: 1;
            background: none;
        }

        .form_label {
            position: absolute;
            left: 1em;
            top: 1em;
            padding: 0 .25em;
            background-color: #fff;
            color: #80868b;
            font-size: 1em;
            transition: .4s;
        }

        .form_button {
            width: 100%;
            display: block;
            margin-left: auto;
            padding: 1em 2em;
            ;
            outline: none;
            border: none;
            background-color: rgb(28, 164, 248);
            color: #fff;
            font-size: 1em;
            border-radius: .5em;
            cursor: pointer;
            transition: .4s;
            margin-top: 6.3em;
        }

        .form_button:hover {
            transform: scale(0.90);
            box-shadow: 0 5px 5px rgba(0, 0, 0, 0.20);
        }

        .form_input:focus+.form_label {
            top: -.5em;
            left: .8em;
            color: rgb(28, 164, 248);
            font-size: .80em;
            font-weight: 600;
            z-index: 5;
        }

        .form_input:not(:placeholder-shown).form_input:not(:focus)+.form_label {
            top: -.5em;
            left: .8em;
            font-size: .80em;
            font-weight: 600;
            z-index: 5;
        }

        .form_input:focus {
            border: .1em solid rgb(28, 164, 248);
        }
    </style>
    <div class="login_form">
        <form action="{{ route('seller.login') }}" method="POST" class="form">
            @csrf
            <h1 class="form_title"><b>Seller Login</b></h1>

            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first('login') }}
                </div>
            @endif

            <div class="form_div">
                <input type="text" class="form_input" name="email" placeholder=" ">
                <label class="form_label"><b>Email</b></label>
            </div>

            <div class="form_div">
                <input type="password" class="form_input" name="password" placeholder=" ">
                <label class="form_label"><b>Password</b></label>
            </div>

            <input type="submit" class="form_button" value="Log In">
        </form>
    </div>
@endsection
