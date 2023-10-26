<div class="container">
    <div class="product-wrapper">
        <div class="section-title-furits bg-shape text-center mb-80">
            <div class="all-products-area pt-115 pb-50">
                <div class="ps-top-categories" style="padding: 0px;">
                    <div class="ps-container">
                        <div class="section-title-3 text-center mb-50">
                            <h2>Produk</h2>
                        </div>
                        <table>
                            <tbody>
                                @foreach ($productSkus as $productSku)
                                    <tr>
                                        <td>{{ $productSku->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <table>
                            <tbody>
                                @foreach($productPrices as $productPrice)
                                    <tr>
                                        <td>{{ $productPrice->price }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
