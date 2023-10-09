use App\BankStore; // Pastikan Anda mengimpor model BankStore
use App\MasterBank;
use App\MasterStatus;
use App\Store;

public function IndexBankStore(Request $request)
{
    $request->validate([
        'bank_id' => 'required',
        'number' => 'required|max:255',
        'name' => 'required|max:255',
    ]);

    // Mendapatkan data dari request
    $data = $request->all();

    // Mencari MasterBank dengan ID yang diberikan
    $masterBank = MasterBank::find($data['bank_id']);

    // Mencari MasterStatus dengan ID yang sesuai
    $masterStatus = MasterStatus::find($masterBank->status_id);

    // Mencari Store dengan ID yang sesuai
    $store = Store::find($data['store_id']);

    // Menyimpan data ke dalam tabel BankStore
    $bankStore = new BankStore();
    $bankStore->name = $data['name'];
    $bankStore->number = $data['number'];
    $bankStore->status_id = $masterStatus->id;
    $bankStore->store_id = $store->id;
    $bankStore->bank_id = $masterBank->id;
    $bankStore->kode_bank = $masterBank->name; // Menggunakan name dari MasterBank
    $bankStore->save();

    // Menyimpan data dalam sesi
    session(['bankSession' => $data]);

    // Redirect ke rute 'WilayahJualIndex'
    return redirect()->route('WilayahJualIndex');
}
