@extends('seller.topbar')

@section('content')
    <style>
        /* CSS Anda tetap sama */
    </style>
    <div class="login_form">
        <form action="{{ route('seller.login') }}" method="POST" class="form">
            @csrf
            <h1 class="form_title"><b>Seller Login</b></h1>
            <div class="form_div">
                <input type="text" class="form_input" name="identifier" placeholder=" ">
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

public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        if ($user->role == 1) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk login.');
        }
    }
    return redirect()->back()->with('error', 'Email atau kata sandi salah.');
}
