<?php 


//register tab one 
$store = new Store();
$store->seller_type = $storeSession['seller_type_value'];
$store->name = $storeSession['store_name'];
$store->save();

$user = new User();
$user->surel = $storeSession['surel'];
$user->password = $storeSession['password'];
$user->save();

//register tab two 
//not nullable
$store = new Store();
$store->store_name = $storeFormSession['store_name'];
$store->public_email = $storeFormSession['public_email'];
$store->phone_number = $storeFormSession['phone_number'];
//nullable  
$store->web_name = $storeFormSession['web_name'];
$store->short_description = $storeFormSession['short_description'];
$store->about_us = $storeFormSession['about_us'];
$store->fb_name = $storeFormSession['fb_name'];
$store->tw_name = $storeFormSession['tw_name'];
$store->linked_name = $storeFormSession['linked_name'];
$store->yt_name = $storeFormSession['yt_name'];

// $store->kekayaan_bersih = $storeFormSession['kekayaan_bersih']; Belum tau ada di model mana  
$storeDetail = new StoreDetail
$storeDetail->npwp = $storeFormSession['npwp'];
$storeDetail->kategori_usaha = $storeFormSession['kategori_usaha'];
$storeDetail->kekayaan_bersih =$storeFormSession['kekayaan_bersih'];
$storeDetail->kategori_usaha = $storeFormSession['kategori_usaha'];
$storeDetail->pkp = $storeFormSession['pkp'];
//nullable 
$storeDetail->nib = $storeFormSession['nib'];
$storeDetail->skb = $storeFormSession['skb'];
$storeDetail->akta = $storeFormSession['akta'];
$storeDetail->siup = $storeFormSession['siup'];
$storeDetail->akta_perusahaan = $storeFormSession['akta_perusahaan'];
$storeDetail->tdp = $storeFormSession['tdp'];
$storeDetail->kbli = $storeFormSession['kbli'];
$storeDetail->save();



$kategori_usaha_values = [
    'Mikro' => 0,
    'Kecil' => 1,
    'Menengah' => 2,
];


$kekayaan_bersih = $request->input('kekayaan_bersih');
$kategori_usaha = '';

if ($kekayaan_bersih < 50000000) {
    $kategori_usaha = 'Mikro';
} elseif ($kekayaan_bersih >= 50000000 && $kekayaan_bersih <= 50000000) {
    $kategori_usaha = 'Kecil';
} elseif ($kekayaan_bersih > 50000000 && $kekayaan_bersih <= 10000000000) {
    $kategori_usaha = 'Menengah';
}

// Atur nilai kategori_usaha_value berdasarkan array yang telah dibuat
$kategori_usaha_value = $kategori_usaha_values[$kategori_usaha];

$storeFormSession['kategori_usaha'] = $kategori_usaha;
$storeFormSession['kategori_usaha_value'] = $kategori_usaha_value;


$storeDetail = new StoreDetail();
$storeDetail->kekayaan_bersih = $storeFormSession['kekayaan_bersih'];
$storeDetail->kategori_usaha = $storeFormSession['kategori_usaha_value'];
$storeDetail->save();


$storeDetail = new StoreDetail();
$storeDetail->npwp = $storeFormSession['npwp'];
$storeDetail->kekayaan_bersih = $storeFormSession['kekayaan_bersih'];
$storeDetail->kategori_usaha = $storeFormSession['kategori_usaha_value'];
$storeDetail->pkp = $storeFormSession['pkp']; // Atur nilai pkp berdasarkan pkp_value
// ... kode lainnya
$storeDetail->save();

$pkp = $request->input('pkp');
// disini controller baruu form store
// Periksa apakah data pkp sudah ada di master_status
public function FormStore(Request $request)
{
    $request->validate([
        'store_name' => 'required',
        'public_email' => 'required',
        'phone_number' => 'required',
        'pkp' => 'required',
        'kekayaan_bersih' => 'required',
        'npwp' => 'required',
        'kategori_usaha' => 'required'
    ]);

    $storeFormSession = [
            'store_name' => $request->input('store_name'),
            'web_name' => $request->input('web_name'),
            'public_email' => $request->input('public_email'),
            'phone_number' => $request->input('phone_number'),
            'short_description' => $request->input('short_description'),
            'about_us' => $request->input('about_us'),
            'fb_name' => $request->input('fb_name'),
            'tw_name' => $request->input('tw_name'),
            'linked_name' => $request->input('linked_name'),
            'inst_name' => $request->input('inst_name'),
            'yt_name' => $request->input('yt_name'),
            'nib' => $request->input('nib'),
            'skb' => $request->input('skb'),
            'akta' => $request->input('akta'),
            'siup' => $request->input('siup'),
            'akta_perusahaan' => $request->input('akta_perusahaan'),
            'npwp' => $request->input('npwp'),
            'tdp' => $request->input('tdp'),
            'kbli' => $request->input('kbli'),
            'kekayaan_bersih' => $request->input('kekayaan_bersih'),
            'pkp' => $request->input('pkp')
        ];

    $kekayaan_bersih = $request->input('kekayaan_bersih');
    $kategori_usaha = '';

    if ($kekayaan_bersih < 50000000) {
        $kategori_usaha = 'Mikro';
    } elseif ($kekayaan_bersih >= 50000000 && $kekayaan_bersih <= 500000000) {
        $kategori_usaha = 'Kecil';
    } elseif ($kekayaan_bersih > 500000000 && $kekayaan_bersih <= 10000000000) {
        $kategori_usaha = 'Menengah';
    }

    // Mencari ID dari 'PKP' atau 'NON PKP' berdasarkan data yang ada di master_status
    $pkp = $request->input('pkp');
    $pkpStatus = MasterStatus::where('name', $pkp)->first();

    if (!$pkpStatus) {
        // Jika tidak ada dalam master_status, mungkin ada perubahan nama atau situasi khusus
        // Anda dapat menangani kasus ini sesuai kebutuhan Anda.
    } else {
        $storeFormSession['pkp'] = $pkpStatus->id;
    }

    // Melakukan hal yang sama untuk 'NON PKP' jika perlu

    // Menghitung nilai kategori usaha sesuai dengan data yang ada di master_status
    $kategori_usaha_value = MasterStatus::where('name', $kategori_usaha)->value('id');

    $storeFormSession['kategori_usaha'] = $kategori_usaha;
    $storeFormSession['kategori_usaha_value'] = $kategori_usaha_value;

    $store = new Store();
        $store->store_name = $storeFormSession['store_name'];
        $store->public_email = $storeFormSession['public_email'];
        $store->phone_number = $storeFormSession['phone_number'];
        //nullable  
        $store->web_name = $storeFormSession['web_name'];
        $store->short_description = $storeFormSession['short_description'];
        $store->about_us = $storeFormSession['about_us'];
        $store->fb_name = $storeFormSession['fb_name'];
        $store->tw_name = $storeFormSession['tw_name'];
        $store->linked_name = $storeFormSession['linked_name'];
        $store->yt_name = $storeFormSession['yt_name'];

        // $store->kekayaan_bersih = $storeFormSession['kekayaan_bersih']; Belum tau ada di model mana  
        $storeDetail = new StoreDetail();
        $storeDetail->npwp = $storeFormSession['npwp'];
        $storeDetail->kekayaan_bersih = $storeFormSession['kekayaan_bersih'];
        $storeDetail->pkp = $storeFormSession['pkp'];

        //nullable 
        $storeDetail->nib = $storeFormSession['nib'];
        $storeDetail->skb = $storeFormSession['skb'];
        $storeDetail->akta = $storeFormSession['akta'];
        $storeDetail->siup = $storeFormSession['siup'];
        $storeDetail->akta_perusahaan = $storeFormSession['akta_perusahaan'];
        $storeDetail->tdp = $storeFormSession['tdp'];
        $storeDetail->kbli = $storeFormSession['kbli'];
        $storeDetail->save();



        
        
        return redirect()->route('indexForm.info-ttd');
    }




    public function FormStore(Request $request)
{
    $request->validate([
        'store_name' => 'required',
        'public_email' => 'required',
        'phone_number' => 'required',
        'pkp' => 'required',
        'kekayaan_bersih' => 'required',
        'npwp' => 'required',
        'kategori_usaha' => 'required'
    ]);

    $storeFormSession = [
        'kepemilikan_usaha' => $request->input('kepemilikan_usaha'),
        'store_name' => $request->input('store_name'),
        'web_name' => $request->input('web_name'),
        'public_email' => $request->input('public_email'),
        'phone_number' => $request->input('phone_number'),
        'short_description' => $request->input('short_description'),
        'about_us' => $request->input('about_us'),
        'fb_name' => $request->input('fb_name'),
        'tw_name' => $request->input('tw_name'),
        'linked_name' => $request->input('linked_name'),
        'inst_name' => $request->input('inst_name'),
        'yt_name' => $request->input('yt_name'),
        'nib' => $request->input('nib'),
        'skb' => $request->input('skb'),
        'akta' => $request->input('akta'),
        'siup' => $request->input('siup'),
        'akta_perusahaan' => $request->input('akta_perusahaan'),
        'npwp' => $request->input('npwp'),
        'tdp' => $request->input('tdp'),
        'kbli' => $request->input('kbli'),
        'kekayaan_bersih' => $request->input('kekayaan_bersih'),
        'pkp' => $request->input('pkp')
    ];

    $kekayaan_bersih = $request->input('kekayaan_bersih');
    $kategori_usaha = '';

    if ($kekayaan_bersih < 50000000) {
        $kategori_usaha = 'Mikro';
    } elseif ($kekayaan_bersih >= 50000000 && $kekayaan_bersih <= 500000000) {
        $kategori_usaha = 'Kecil';
    } elseif ($kekayaan_bersih > 500000000 && $kekayaan_bersih <= 10000000000) {
        $kategori_usaha = 'Menengah';
    }

    $pkp = $request->input('pkp');
    $pkpStatus = MasterStatus::where('name', $pkp)->first();

    if (!$pkpStatus) {
    } else {
        $storeFormSession['pkp'] = $pkpStatus->id;
    }

    $kepemilikan_usaha = $request->input('kepemilikan_usaha');
    $kepemilikan_usahaStatus = MasterStatus::where('name', $kepemilikan_usaha)->first();

    if (!$kepemilikan_usahaStatus) {
    } else {
        $storeFormSession['kepemilikan_usaha'] = $kepemilikan_usahaStatus->id;
    }

    // Melakukan hal yang sama untuk 'NON PKP' jika perlu

    // Menghitung nilai kategori usaha sesuai dengan data yang ada di master_status
    $kategori_usaha_value = MasterStatus::where('name', $kategori_usaha)->value('id');

    $storeFormSession['kategori_usaha'] = $kategori_usaha;
    $storeFormSession['kategori_usaha_value'] = $kategori_usaha_value;

    $store = new Store();
    $store->store_name = $storeFormSession['store_name'];
    $store->public_email = $storeFormSession['public_email'];
    $store->phone_number = $storeFormSession['phone_number'];
    //nullable  
    $store->web_name = $storeFormSession['web_name'];
    $store->short_description = $storeFormSession['short_description'];
    $store->about_us = $storeFormSession['about_us'];
    $store->fb_name = $storeFormSession['fb_name'];
    $store->tw_name = $storeFormSession['tw_name'];
    $store->linked_name = $storeFormSession['linked_name'];
    $store->yt_name = $storeFormSession['yt_name'];
    $store->save();

    // $store->kekayaan_bersih = $storeFormSession['kekayaan_bersih']; Belum tau ada di model mana  
    $storeDetail = new StoreDetail();
    $storeDetail->kepemilikan_usaha = $storeFormSession['kepemilikan_usaha'];
    $storeDetail->npwp = $storeFormSession['npwp'];
    $storeDetail->kekayaan_bersih = $storeFormSession['kekayaan_bersih'];
    $storeDetail->pkp = $storeFormSession['pkp'];

    //nullable 
    $storeDetail->nib = $storeFormSession['nib'];
    $storeDetail->skb = $storeFormSession['skb'];
    $storeDetail->akta = $storeFormSession['akta'];
    $storeDetail->siup = $storeFormSession['siup'];
    $storeDetail->akta_perusahaan = $storeFormSession['akta_perusahaan'];
    $storeDetail->tdp = $storeFormSession['tdp'];
    $storeDetail->kbli = $storeFormSession['kbli'];
    $storeDetail->save();

    return redirect()->route('indexForm.info-ttd');
}



public function FormStore(Request $request)
{
    $request->validate([
        'store_name' => 'required',
        'public_email' => 'required',
        'phone_number' => 'required',
        'pkp' => 'required',
        'kekayaan_bersih' => 'required',
        'npwp' => 'required',
        'kategori_usaha' => 'required'
    ]);

    $storeFormSession = [
        'kepemilikan_usaha' => $request->input('kepemilikan_usaha'),
        'store_name' => $request->input('store_name'),
        'web_name' => $request->input('web_name'),
        'public_email' => $request->input('public_email'),
        'phone_number' => $request->input('phone_number'),
        'short_description' => $request->input('short_description'),
        'about_us' => $request->input('about_us'),
        'fb_name' => $request->input('fb_name'),
        'tw_name' => $request->input('tw_name'),
        'linked_name' => $request->input('linked_name'),
        'inst_name' => $request->input('inst_name'),
        'yt_name' => $request->input('yt_name'),
        'nib' => $request->input('nib'),
        'skb' => $request->input('skb'),
        'akta' => $request->input('akta'),
        'siup' => $request->input('siup'),
        'akta_perusahaan' => $request->input('akta_perusahaan'),
        'npwp' => $request->input('npwp'),
        'tdp' => $request->input('tdp'),
        'kbli' => $request->input('kbli'),
        'kekayaan_bersih' => $request->input('kekayaan_bersih'),
        'pkp' => $request->input('pkp'),
        'kategori_usaha' => $request->input('kategori_usaha')
    ];

    $kekayaan_bersih = $request->input('kekayaan_bersih');
    $kategori_usaha = '';

    if ($kekayaan_bersih < 50000000) {
        $kategori_usaha = 'Mikro';
    } elseif ($kekayaan_bersih >= 50000000 && $kekayaan_bersih <= 500000000) {
        $kategori_usaha = 'Kecil';
    } elseif ($kekayaan_bersih > 500000000 && $kekayaan_bersih <= 10000000000) {
        $kategori_usaha = 'Menengah';
    }

    // ...

    // Set kategori_usaha sesuai dengan yang ada di referensi MasterStatus
    $kategori_usahaStatus = MasterStatus::where('name', $kategori_usaha)->first();

    if (!$kategori_usahaStatus) {
        // Handle jika tidak ditemukan
    } else {
        $storeFormSession['kategori_usaha'] = $kategori_usahaStatus->id;
    }

    // ...
}


//IndexStore , form , 
public function IndexStore(Request $request)
{
    $request->validate([
        'seller_type' => 'required',
    ]);

    $storeSession = [
        'seller_type' => $request->seller_type,
    ];

    $seller_type = $request->input('seller_type');
    $seller_typeStatus = MasterStatus::where('name', $seller_type)->first();

    if ($seller_typeStatus) {
        $storeSession['seller_type'] = $seller_typeStatus->id;
    }

    session(['storeSession' => $storeSession]);

    return redirect()->route('sellerIndexForm');
}

public function form()
    {
        return view('seller.register_form');
    }

public function FormStore(Request $request)
{
    $request->validate([
        'store_name' => 'required',
        'public_email' => 'required',
        'phone_number' => 'required',
        'pkp' => 'required',
        'kekayaan_bersih' => 'required',
        'npwp' => 'required',
    ]);

    $storeFormSession = [
        'kepemilikan_usaha' => $request->input('kepemilikan_usaha'),
        'store_name' => $request->input('store_name'),
        'web_name' => $request->input('web_name'),
        'public_email' => $request->input('public_email'),
        'phone_number' => $request->input('phone_number'),
        'short_description' => $request->input('short_description'),
        'about_us' => $request->input('about_us'),
        'fb_name' => $request->input('fb_name'),
        'tw_name' => $request->input('tw_name'),
        'linked_name' => $request->input('linked_name'),
        'inst_name' => $request->input('inst_name'),
        'yt_name' => $request->input('yt_name'),
        'seller_type' => $request->input('seller_type'),
        'status_id' => 5, // Atur status_id sesuai kebutuhan Anda
    ];

    $pkp = $request->input('pkp');
    $pkpStatus = MasterStatus::where('name', $pkp)->first();

    if ($pkpStatus) {
        $storeFormSession['pkp'] = $pkpStatus->id;
    }

    $kepemilikan_usaha = $request->input('kepemilikan_usaha');
    $kepemilikan_usahaStatus = MasterStatus::where('name', $kepemilikan_usaha)->first();

    if ($kepemilikan_usahaStatus) {
        $storeFormSession['kepemilikan_usaha'] = $kepemilikan_usahaStatus->id;
    }

    $kategori_usaha = $request->input('kategori_usaha');
    $kategori_usahaStatus = MasterStatus::where('name', $kategori_usaha)->first();

    if ($kategori_usahaStatus) {
        $storeFormSession['kategori_usaha'] = $kategori_usahaStatus->id;
    }

    $storeDetail = new StoreDetail();
    $storeDetail->fill($storeFormSession);
    $storeDetail->save();

    $store = new Store();
    $store->fill($storeFormSession);
    $store->save();

    return redirect()->route('indexForm.info-ttd');
}


//seller new controller 


public function IndexStore(Request $request)
{
    $request->validate([
        'seller_type' => 'required',
    ]);

    // Mendapatkan value dari form HTML dengan nama 'seller_type'
    $sellerTypeInput = $request->input('seller_type');

    // Mencari MasterStatus sesuai dengan nama yang dikirimkan dari form
    $sellerTypeStatus = MasterStatus::where('name', $sellerTypeInput)->first();

    if (!$sellerTypeStatus) {
        // Handle jika tidak ditemukan
    }

    // Simpan ke session
    session(['storeSession' => ['seller_type' => $sellerTypeStatus->id]]);

    return redirect()->route('sellerIndexForm');
}

$kekayaanBersihInput = $request->input('kekayaan_bersih');
$kategoriUsahaInput = $request->input('kategori_usaha');

$kategoriUsahaStatus = MasterStatus::where('name', $kategoriUsahaInput)->first();

if (!$kategoriUsahaStatus) {
    // Handle jika tidak ditemukan
    // Misalnya, mengembalikan respon error atau mengalihkan kembali ke halaman sebelumnya
}

$kekayaanBersihStatus = MasterStatus::where('name', $kekayaanBersihInput)->first();

if (!$kekayaanBersihStatus) {
    // Handle jika tidak ditemukan
    // Misalnya, mengembalikan respon error atau mengalihkan kembali ke halaman sebelumnya
}

// Lanjutkan dengan penyimpanan data ke database
$storeFormSession = [
    // ... (bagian lain dari data)
    'kekayaan_bersih' => $kekayaanBersihStatus ? $kekayaanBersihStatus->id : null,
    'kategori_usaha' => $kategoriUsahaStatus ? $kategoriUsahaStatus->id : null,
    'seller_type' => $request->input('seller_type'),
    'status_id' => 5,
];

session(['storeSession' => $storeFormSession]);

$storeDetail = new StoreDetail();
$storeDetail->fill($storeFormSession);
$storeDetail->save();

$store = new Store();
$store->fill($storeFormSession);
$store->save();

return redirect()->route('indexForm.info-ttd');




$kepemilikanUsahaInput = $request->input('kepemilikan_usaha');

// Mencari data MasterStatus sesuai dengan nama kepemilikan usaha
$kepemilikanUsahaStatus = MasterStatus::where('name', $kepemilikanUsahaInput)->first();

if (!$kepemilikanUsahaStatus) {
    // Handle jika tidak ditemukan
    // Misalnya, mengembalikan respon error atau mengalihkan kembali ke halaman sebelumnya
}

$storeFormSession = [
    // ... (bagian lain dari data)
    'kepemilikan_usaha' => $kepemilikanUsahaStatus->id, // Menggunakan ID yang sesuai
    'kategori_usaha' => $kategoriUsahaStatus ? $kategoriUsahaStatus->id : null,
    'seller_type' => $request->input('seller_type'),
    'status_id' => 5,
];

// Lanjutkan dengan penyimpanan data ke database
