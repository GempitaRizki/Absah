<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\NpwpDinas;
use App\Models\Sekolah;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Throwable;

class LoginRegisterController extends Controller
{
    public function index()
    {
        return view('auth.validationform');
    }

    public function form()
    {
        return view('auth.registration');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            // Validasi data dari form
            $request->validate([
                // Atur aturan validasi sesuai kebutuhan Anda
            ]);

            // Simpan data ke dalam tabel User
            $user = User::create([
                // Sesuaikan dengan kolom-kolom yang ada di tabel User
            ]);

            // Simpan data ke dalam tabel Sekolah
            $sekolah = Sekolah::create([
                // Sesuaikan dengan kolom-kolom yang ada di tabel Sekolah
            ]);

            // Simpan data ke dalam tabel NpwpDinas
            $npwpDinasData = [
                'npwp' => $request->npwp,
                'npwp_dinas' => $request->npwp_dinas,
            ];

            $sekolah->NpwpDinas()->create($npwpDinasData);

            // Lainnya: Commit transaksi, login pengguna, dan alihkan ke rute yang sesuai
            DB::commit();
            Auth::login($user);
            $request->session()->regenerate();
            return Redirect::route('DataSekolah');
        } catch (Throwable $e) {
            // Jika ada kesalahan, rollback transaksi
            DB::rollBack();
            // Handle kesalahan sesuai kebutuhan Anda
            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal mendaftar.']);
        }
    }
}
