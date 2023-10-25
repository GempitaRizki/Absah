<?

public function storeProductData(Request $request)
{
    $request->validate([
        'tipe_kategori_id' => 'required',
        'category_id' => 'required',
    ]);

    // Mengambil data yang dibutuhkan dari request
    $data = $request->all();

    // Mendapatkan ID dari user yang membuat data
    $createdBy = Auth::id();

    // Mendapatkan ID produk dari session
    $iprProductId = session('ipr_product_id');

    // Mengelompokkan kategori
    $categories = $this->groupCategories($data);

    // Mencari ProductSku berdasarkan ID
    $productSku = ProductSku::find($iprProductId);

    if (!$productSku) {
        return redirect()->route('syntaxError');
    }

    // Memasukkan kategori ke dalam AssignProductCat
    $this->assignCategories($categories, $productSku);

    // Membuat dan menyimpan ProductSku baru
    $newProductSku = $this->createProductSku($data, $createdBy, $iprProductId);

    // Membuat dan menyimpan ProductStock
    $this->createProductStock($newProductSku, $data);

    return redirect()->route('IndexPrice');
}

// Fungsi untuk mengelompokkan kategori
private function groupCategories($data)
{
    $parentParts = [
        $data['tipe_kategori_id'],
        $data['category_id'],
        $data['sub_category_satu'],
        $data['sub_category_dua'],
        $data['sub_category_tiga'],
        $data['sub_category_empat'],
        $data['sub_category_lima'],
        $data['sub_category_enam'],
    ];

    $categories = [];
    $parent = 0;

    foreach ($parentParts as $part) {
        if (!empty($part)) {
            $categories[] = [
                'category_id' => $part,
                'parent' => $parent,
            ];
            $parent = $part;
        }
    }

    return $categories;
}

// Fungsi untuk memasukkan kategori ke dalam AssignProductCat
private function assignCategories($categories, $productSku)
{
    foreach ($categories as $category) {
        $productInfoUmum = new AssignProductCat();
        $productInfoUmum->category_id = $category['category_id'];
        $productInfoUmum->parent = $category['parent'];
        $productInfoUmum->product_sku_id = $productSku->id;
        $productInfoUmum->save();
    }
}

// Fungsi untuk membuat dan menyimpan ProductSku baru
private function createProductSku($data, $createdBy, $iprProductId)
{
    $productSku = new ProductSku();
    $productSku->fill($data);
    $productSku->created_by = $createdBy;
    $productSku->type_ppn = 1;
    $productSku->preorder = ProductSku::DEFAULT_PREORDER;

    if ($iprProduct) {
        $productSku->product_id = $iprProduct->id;
        $productSku->product_id_reference = $iprProduct->id;
    }

    $slug = Str::slug($data['name'], '-') . '-' . $iprProductId;
    $productSku->slug = $slug;

    $defaultStatus = MasterStatus::where('id', ProductSku::PENDING_REVIEW_STATUS_ID)->first();
    $productSku->status()->associate($defaultStatus);
    $productSku->save();

    return $productSku;
}

// Fungsi untuk membuat dan menyimpan ProductStock
private function createProductStock($productSku, $data)
{
    $productStock = new ProductStock();
    $productStock->product_sku_id = $productSku->id;
    $productStock->stock = $data['stok'];
    $productStock->limit_stock = $data['limit_stock'];
    $productStock->save();
}
