<?
    public function CheckoutStore(Request $request)
    {
        $this->validate($request, [
            'partnerCourier' => 'required',
            'sumber_dana_id' => 'required',
            'denda' => 'nullable',
            'estimasi_pembayaran' => 'nullable',
            'paymentMethod' => 'required',
            'label' => 'required',
            'phone_number' => 'required',
            // 'province_id' => 'required',  
            // 'districts' => 'required',
            // 'subdistricts' => 'required',
            // 'villages' => 'required',
            'address' => 'required',
        ]);
    
        $partnerCourier = $request->input('partnerCourier');
        $sumber_dana_id = $request->input('sumber_dana_id');
        $denda = $request->input('denda');
        $estimasi_pembayaran = $request->input('estimasi_pembayaran');
        $paymentMethod = $request->input('paymentMethod');
        $label = $request->input('label');
        $phone_number = $request->input('phone_number');
        // $province_id = $request->input('province_id');  
        // $districts_id = $request->input('districts');
        // $subdistrict_id = $request->input('subdistricts');
        // $village_id = $request->input('villages');
        $address = $request->input('address');  
    
        $order = new IprOrder();
        $order->sumber_dana_id = $sumber_dana_id;
        $order->shipping_method = $partnerCourier;
        $order->denda = $denda;
        $order->estimasi_pembayaran = $estimasi_pembayaran;
        $order->payment_method = $paymentMethod;
        // Simpan order terlebih dahulu
    
        $userAddress = new UserAddress();  // Ganti nama variabel untuk menghindari kebingungan
        $userAddress->label = $label;
        $userAddress->phone_number = $phone_number;
        // $userAddress->province_id = $province_id;
        // $userAddress->districts_id = $districts_id;
        // $userAddress->subdistrict_id = $subdistrict_id;
        // $userAddress->village_id = $village_id;
        $userAddress->address = $address;
        // Simpan alamat pengiriman
    
        // Sekarang, Anda perlu mengaitkan alamat pengiriman dengan pesanan
        $order->userAddress()->associate($userAddress);
        $order->save();
    
        return redirect()->route('dashboard.index');
    }