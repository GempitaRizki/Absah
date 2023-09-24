<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
class UserRegisterController extends Controller
{
    public function FormOneRegistrationUser()
    {
        return view('auth.registration');
    }


    public function SellerValidate(Request $request)
    {
        $request->session()->put('layout', 'main-signup');

        $model = new \stdClass();
        $model->email = null;
        $model->password = null;
        $model->seller_type = null;
        $model->store_name = null;

        $modelUser = new User();

        if ($request->isMethod('post')) {
            $input = $request->input();

            $validator = $modelUser->validate($input);

            if ($validator->fails()) {
                return view('index', ['model' => $model, 'modelUser' => $modelUser]);
            }

            $session = $request->session();

            $session->put('dataPengguna', [
                'surel' => $input['surel'],
                'password' => $input['password'],
                'seller_type' => $input['seller_type'],
                'store_name' => $input['store_name'],
            ]);
            dd(session($request));

            return redirect()->route('register.seller');
        }

        return view('index');
        //  ['model' => $model, 'modelUser' => $modelUser]
    }

    public function actionInfoUsaha(Request $request)
    {
        $model = new Store();
        $modelDetail = new StoreDetail();

        $dataInfoPengguna = $request->session()->get('dataPengguna');

        if ($request->isMethod('post')) {
            $input = $request->input();

            $session = $request->session();

            if ($dataInfoPengguna['seller_type'] == '1') { 

                $session->put('dataInfoUsaha', [
                    'store_name' => $input['store_name'],
                    'web_name' => $input['web_name'],
                    'public_email' => $input['public_email'],
                    'phone_number' => $input['phone_number'],
                    'short_description' => $input['short_description'],
                    'about_us' => $input['about_us'],
                    'fb_name' => $input['fb_name'],
                    'tw_name' => $input['tw_name'],
                    'linked_name' => $input['linked_name'],
                    'yt_name' => $input['yt_name'],
                    'nib' => $input['nib'],
                    'skb' => $input['skb'],
                    'kekayaan_bersih' => $input['kekayaan_bersih'],
                    'kategori_usaha' => $kategoriUsaha, 
                    'npwp' => $input['npwp'],
                    'sk_umkm' => $input['sk_umkm'],
                    'kepemilikan_usaha' => $input['kepemilikan_usaha'],
                    'pkp' => $input['pkp'],
                ]);
            } elseif ($dataInfoPengguna['seller_type'] == '0') { 

                $session->put('dataInfoUsaha', [
                    'store_name' => $input['store_name'],
                    'web_name' => $input['web_name'],
                    'public_email' => $input['public_email'],
                    'phone_number' => $input['phone_number'],
                    'short_description' => $input['short_description'],
                    'about_us' => $input['about_us'],
                    'fb_name' => $input['fb_name'],
                    'tw_name' => $input['tw_name'],
                    'linked_name' => $input['linked_name'],
                    'yt_name' => $input['yt_name'],
                    'nib' => $input['nib'],
                    'skb' => $input['skb'],
                    'kekayaan_bersih' => $input['kekayaan_bersih'],
                    'kategori_usaha' => $input ['kategoriUsaha'],
                    'npwp' => $input['npwp'],
                    'kbli' => $input['kbli'],
                    'tdp' => $input['tdp'],
                    'siup' => $input['siup'],
                    'akta_perusahaan' => $input['akta_perusahaan'],
                    'akta' => $input['akta'],
                    'pkp' => $input['pkp'],
                    'kepemilikan_usaha' => $input['kepemilikan_usaha'],
                ]);
            }

            return redirect()->route('info-ttd');
        }

        if ($dataInfoPengguna['seller_type'] == '1') {
            return view('info-usaha-individu', ['model' => $model, 'modelDetail' => $modelDetail]);
        } elseif ($dataInfoPengguna['seller_type'] == '0') {
            return view('info-usaha-corporate', ['model' => $model, 'modelDetail' => $modelDetail]);
        }
    }
}