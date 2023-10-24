use App\Models\YourModel; // Gantilah YourModel dengan model yang sesuai

public function storeInfo(Request $request)
{
    // Validasi data yang diterima dari request
    $request->validate([
        'field1' => 'required',
        'field2' => 'required',
        // tambahkan validasi sesuai kebutuhan Anda
    ]);

    // Simpan data ke dalam model
    $yourModel = new YourModel(); // Gantilah YourModel dengan model yang sesuai
    $yourModel->field1 = $request->input('field1');
    $yourModel->field2 = $request->input('field2');
    // Tambahkan atribut lain sesuai dengan kebutuhan

    $yourModel->save();

    // Redirect ke halaman yang sesuai
    return redirect()->route('nama_rute_tujuan');
}
`