@extends('seller.topbar')
@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css?family=Lato');

        $animationTime: 900s;

        * {
            position: relative;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Lato', sans-serif;
        }

        body {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: linear-gradient(to bottom right, #EEE, #AAA);
        }

        h1 {
            margin: 40px 0 20px;
        }

        .message {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: center;
            position: relative;
        }

        .message-content {
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        @keyframes lock {
            0% {
                top: -45px;
            }

            65% {
                top: -45px;
            }

            100% {
                top: -30px;
            }
        }

        @keyframes spin {
            0% {
                transform: scaleX(-1);
                left: calc(50% - 30px);
            }

            65% {
                transform: scaleX(1);
                left: calc(50% - 12.5px);
            }
        }

        @keyframes dip {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(10px);
            }

            100% {
                transform: translateY(0px);
            }



        }
    </style>
    <div class="lock"></div>
    <div class="message">
        <div class="message-content">
            <h1>Anda tidak memiliki Akses</h1>
            <p>Demi keamanan, silahkan hubungi admin </p>
        </div>
    </div>
@endsection
