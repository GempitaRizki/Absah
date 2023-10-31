<?
public function store(Request $request, $slug, $id)
{
    $product = ProductSku::where('slug', $slug)->where('id', $id)->firstOrFail();
    $user_id = Auth::id(); 
    $store_id = $product->store_id;
    $sumber_dana_id = $request->input('sumber_dana_id'); 
    $shipping_method = $product->shipping_method; 
    $denda = $request->input('denda'); 
    $estimasi_pembayaran = $request->input('estimasi_pembayaran'); 
    $shipping_estimate = 0; 
    $shipping_note = null; 
    $shipping_cost = 0; 
    $sekolah_id = $product->sekolah_id;
    $metodePembayaran = BankMp::getBankAvailableBuyer();
    $payment_method = $request->input('payment_method'); 
    $category_id = null; 
    $shipping_method_code = null;

    // Simpan data ke dalam model IprCart
    $cart = new IprCart([
        'status_id' => 0,
        'user_id' => $user_id,
        'store_id' => $store_id,
        'sumber_dana_id' => $sumber_dana_id,
        'shipping_method' => $shipping_method,
        'denda' => $denda,
        'etimasi_pebayaran' => $estimasi_pembayaran,
        'shipping_estimate' => $shipping_estimate,
        'shipping_note' => $shipping_note,
        'shipping_cost' => $shipping_cost,
        'sekolah_id' => $sekolah_id,
        'payment_method' => $payment_method,
        'shipping_method_code' => $shipping_method_code,
        'category_id' => $category_id,
        'metodePembayaran' => $metodePembayaran
    ]);

    $cart->save();


    return redirect()->route('cartIndex'); 
}