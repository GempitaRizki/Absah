<?php

use common\models\Cart;
use common\models\UserAddress;
use common\models\CartItem;
use common\models\CCompare;
use common\models\CartNegoItem;
use common\models\UserProfile;
use common\models\User;
use common\models\CourierPartner;
use common\models\CourierProduct;
use common\models\MasterStatus;
use common\models\ProductCategory;
use common\models\Order;
use common\models\ProductPrice;
use common\models\ProductSku;
use common\models\Store;
use common\models\AssignProductCat;
use common\models\ProductFile;
use common\models\ProductBundle;
use common\models\SumberDanaSekolah;
use common\models\SumberDana;
use common\models\Sekolah;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\BankMp;
use common\models\Province;
use common\models\Districts;
use common\models\Subdistrict;
use common\models\Village;

?>


<?php
// print_r($listStoreOnCart);
// exit;
if (count($listStoreOnCart) >= 1) { ?>

    <div class="container mt-5">
        <?php if (Yii::$app->session->hasFlash('error')) : ?>
            <div class="alert alert-danger alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <?= Yii::$app->session->getFlash('error') ?>
            </div>
        <?php endif; ?>


        <?php
        $totalCartAllStore = 0;
        foreach ($listStoreOnCart as $listStoreOnCart) {
            $storeId = $listStoreOnCart['store_id'];
            $storeDetailByStoreId = Store::findOne(['id' => $storeId]);
            $cartId = $listStoreOnCart['id'];
            $totalCartByStore = Cart::totalOrderByStoreNew($cartId);

            // echo $cartId.'xx';
        ?>
            <?php $form = ActiveForm::begin(['id' => $storeId]); ?>
            <div class="row">
                <div class="col-12">
                    <!-- Custom Tabs -->
                    <div class="card">

                        <div class="card-header d-flex p-0">
                            <h3 class="card-title p-3"> <?= $storeDetailByStoreId['store_name'] ?></h3>
                            <ul class="nav nav-pills ml-auto p-2">
                                <li class="nav-item"><a class="nav-link active" href="<?= Url::to(['cart/index']); ?>">Keranjang Belanja</a></li>
                                <li class="nav-item"><a class="nav-link " href="<?= Url::to(['chat/index', 'cartId' => $cartId]); ?>">Chat Penjual</a></li>
                                <li class="nav-item"><a class="nav-link" href="<?= Url::to(['nego/index', 'storeId' => $storeId]); ?>">Nego</a></li>

                                <?php
                                $checkPerbandingan = CCompare::find()->where(['cart_id' => $cartId])->one();

                                if ($checkPerbandingan == true) { ?>
                                    <li class="nav-item"><a class="nav-link" href="<?= Url::to(['compare/index', 'cartId' => $cartId]); ?>">Perbandingan</a></li>
                                <?php } ?>
                            </ul>
                        </div><!-- /.card-header -->

                        <?php
                        $checkCartOnCompare = CCompare::findOne(['cart_id' => $cartId, 'status_id' => ['1', '3']]);

                        //  if ($checkCartOnCompare == true) { 
                        ?>
                        <!-- <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                        <div class="row">
                                            <div class="col-lg-12 text-center">
                                                <p> Item sudah di pindahkan ke bagian <b>perbandingan</b></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        <?php //} else { 
                        ?>
                        <div class="card-body">
                            <?php
                            if (isset($_SESSION['gagalInsertCart']) && !empty($_SESSION['gagalInsertCart'])) {
                                // print_r($_SESSION['gagalInsertCart']);
                                // exit();
                            ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    Stok habis untuk daftar produk dibawah:<br>
                                    <?php
                                    $noStockHabis = 1;
                                    foreach ($_SESSION['gagalInsertCart'] as $gagalInserCart) {
                                        $productSkuStock = ProductSku::find()->where(['id' => $gagalInserCart])->one();

                                        echo $noStockHabis . '. ' . $productSkuStock['name'] . '<br>';

                                        $noStockHabis++;
                                    }
                                    ?>
                                </div>
                            <?php } else {
                                // echo 'd';
                            }

                            if (isset($_SESSION['gagalInsertCart'])) {
                                unset($_SESSION['gagalInsertCart']);
                            }

                            ?>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    <div class="row">

                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <td>Nama Produk</td>
                                                    <td>Harga</td>
                                                    <td>Kuantiti</td>
                                                    <td>Total</td>
                                                    <td><a href="<?= Url::to(['/checkout/cart/delete-all', 'id' => $cartId, 'storeid' => $storeId]) ?>"><i class="fas fa-trash"></i></a></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                $listCartByStore = CartItem::listCartByStore($cartId);

                                                $checkCart = Cart::findOne(['id' => $cartId]);

                                                $totalPriceCart = 0;
                                                $beratProduct = 0;
                                                foreach ($listCartByStore as $listCart) {
                                                    $skuId = $listCart['product_sku_id'];
                                                    $qty = $listCart['qty'];
                                                    $storeDetail = ProductPrice::getStoreDetailBySkuId($skuId);
                                                    $productPrice = ProductPrice::showPriceTypeAfterLogin($skuId, $qty);
                                                    $price = $productPrice;
                                                    $priceAfterDisc = $listCart['price_after_disc'];
                                                    $priceWithQty = ProductPrice::priceWithQty($priceAfterDisc, $qty);
                                                    $productSkuDetail = ProductSku::findOne(['id' => $skuId]);

                                                    $productImageDetail = ProductFile::findOne(['product_sku_id' => $skuId]);
                                                    $checkKategoriOnCart = AssignProductCat::findOne(['product_sku_id' => $skuId]);
                                                    $kategoriDetail = ProductCategory::findOne(['id' => $checkKategoriOnCart['category_id']]);
                                                    //                                                    $fileUrl = $productImageDetail['path_bashurl'] . '/' . $productImageDetail['path'];

                                                    if (strpos($productImageDetail['path'], 'http') !== false) {
                                                        $fileUrl = $productImageDetail['path'];
                                                    } else {
                                                        $fileUrl = $productImageDetail['path_bashurl'] . '/' . $productImageDetail['path'];
                                                    }


                                                ?>
                                                    <tr>
                                                        <td>
                                                            <div class="ps-product--cart">
                                                                <div class="ps-product__thumbnail">
                                                                    <div class="row">
                                                                        <div class="col-lg-2">
                                                                            <a href="#">
                                                                                <img src="<?= $fileUrl ?>" alt="" style="width: 80%;" class="img-fluid img-thumbnail">
                                                                            </a>
                                                                        </div>
                                                                        <div class="col-lg-9">
                                                                            <a href="#"><?= $productSkuDetail['name'] ?></a>
                                                                            <br>Kategori
                                                                            <?php
                                                                            // $kategori = ProductCategory::getListHirarchySelected($checkKategoriOnCart['category_id']);

                                                                            // echo $kategori[$checkKategoriOnCart['category_id']];
                                                                            if ($kategoriDetail['type_category'] == '115') {
                                                                                echo "Barang";
                                                                            } elseif ($kategoriDetail['type_category'] == '116') {
                                                                                echo "Jasa";
                                                                            }

                                                                            ?>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($priceAfterDisc < $price) {
                                                                echo '<span style="text-decoration: line-through;">Rp' . number_format($price, 2, ',', '.') . '</span><br>';
                                                            }
                                                            echo 'Rp' . number_format($priceAfterDisc, 2, ',', '.');

                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            $checkProductDiBundle = ProductBundle::find()->where(['product_sku_id' => $skuId])->one();
                                                            $getProductSkuBundle = ProductSku::findOne(['id' => $checkProductDiBundle['bundle_id'], 'status_id' => ProductSku::ENABLE_STATUS_ID]);
                                                            $checkNegoByCart = CartNegoItem::findOne(['cart_id' => $cartId, 'product_sku_id' => $skuId]);

                                                            // echo $cartId;
                                                            if ($checkNegoByCart == true) {
                                                                echo $qty;
                                                            } else {
                                                                if ($getProductSkuBundle == true && $checkProductDiBundle == true) {
                                                                    if ($checkProductDiBundle['is_edit_qty'] == '1') { // tidak bisa di edit
                                                                        echo $qty;
                                                                    } else {
                                                                        echo $form->field($model, 'qty[' . $skuId . ']', [])->textInput(['value' => $qty])->label(false);
                                                                    }
                                                                } else {
                                                                    echo $form->field($model, 'qty[' . $skuId . ']', [])->textInput(['value' => $qty])->label(false);
                                                                }
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            echo 'Rp' . number_format($priceWithQty, 2, ',', '.');
                                                            ?>
                                                        </td>
                                                        <td data-label="Actions">
                                                            <?php
                                                            if ($checkProductDiBundle == false) { ?>
                                                                <a href="<?= Url::to(['/checkout/cart/delete', 'id' => $productSkuDetail['id']]) ?>"><i class="fas fa-trash"></i></a>
                                                            <?php } else if ($getProductSkuBundle == true && $checkProductDiBundle['is_delete'] == '2') { ?>
                                                                <a href="<?= Url::to(['/checkout/cart/delete', 'id' => $productSkuDetail['id']]) ?>"><i class="fas fa-trash"></i></a>
                                                            <?php } else if ($getProductSkuBundle == false) { ?>
                                                                <a href="<?= Url::to(['/checkout/cart/delete', 'id' => $productSkuDetail['id']]) ?>"><i class="fas fa-trash"></i></a>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                <?php
                                                    // echo $form->field($model, 'product_sku_id[' . $skuId . ']')->hiddenInput(['value' => $productSkuDetail['id']])->label(false);
                                                    $totalPriceCart += $priceWithQty;
                                                    $beratProduct += $productSkuDetail['weight'] * $qty;
                                                }
                                                ?>
                                                <tr>
                                                    <td colspan="3">Total</td>
                                                    <td><?= 'Rp' . number_format($totalPriceCart, 2, ',', '.'); ?></td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <p>Sumber Dana</p>
                                            <?php
                                            $sekolahId = Sekolah::getSekolahId();
                                            $checkStatusSumberDanaSekolah = 1;
                                            echo $form->field($modelCart, 'sumber_dana_id[' . $storeId . ']')->widget(Select2::classname(), [
                                                'data' => SumberDana::getSumberDana(),
                                                // 'data' => ['21' => 'test'],
                                                'options' => [
                                                    'placeholder' => Yii::t('app', 'Sumber Dana'),
                                                    'value' => $checkCart['sumber_dana_id']
                                                ],
                                                'pluginOptions' => [
                                                    'allowClear' => true
                                                ],
                                            ])->label(false); ?>
                                        </div>
                                        <div class="col-lg-6">
                                            <p>Metode Pengiriman</p>
                                            <?php
                                            echo $form->field($modelCart, 'shipping_method[' . $storeId . ']')->widget(Select2::classname(), [
                                                'data' => MasterStatus::getOrderShippingMethod(),
                                                'options' => [
                                                    'placeholder' => Yii::t('app', 'Metode Pengiriman'),
                                                    'value' => $checkCart['shipping_method'],
                                                    'options' => [
                                                        67 => ['disabled' => true],

                                                    ]
                                                ],
                                                'pluginOptions' => [
                                                    'allowClear' => true
                                                ],
                                            ])->label(false);


                                            // echo $form->field($modelCart, 'shipping_method[' . $storeId . ']')->widget(Select2::classname(), [
                                            //     'data' => Order::getEkspedisi($storeId, $beratProduct, $totalPriceCart),
                                            //     'options' => [
                                            //         'placeholder' => Yii::t('app', 'Metode Pengiriman'),
                                            //         'value' => $checkCart['shipping_method_code'],
                                            //     ],
                                            //     'pluginOptions' => [
                                            //         'allowClear' => true
                                            //     ],
                                            // ])->label(false);

                                            ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <p>Denda (Rp)</p>
                                            <?= $form->field($modelCart, 'denda[' . $storeId . ']')->textInput(['value' => $checkCart['denda']])->hint('Denda yang akan di berikan kepada penjual jika ada keterlambatan pengiriman')->label(false) ?>
                                        </div>
                                        <div class="col-lg-3">
                                            <p>Estimasi Pembayaran (Hari)</p>
                                            <?= $form->field($modelCart, 'estimasi_pembayaran[' . $storeId . ']')->textInput(['value' => $checkCart['estimasi_pembayaran']])->hint('Estimasi pembayaran setelah barang di terima')->label(false) ?>
                                        </div>
                                        <div class="col-lg-6">
                                            <p>Metode Pembayaran</p>
                                            <?= $form->field($modelCart, 'payment_method[' . $storeId . ']')->widget(Select2::classname(), [
                                                // 'data' =>  MasterStatus::getPaymentMethod(),
                                                'data' => BankMp::getBankAvailableBuyer(),
                                                'options' => ['placeholder' => Yii::t('app', 'Choose Payment Method'),  'value' => $checkCart['payment_method']],
                                                'pluginOptions' => [
                                                    'allowClear' => true
                                                ],
                                            ])->label(false); ?>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <?php
                                                $modelCourierPartner = CourierPartner::listCourier();
                                                $listRadio = [];
                                                foreach ($modelCourierPartner as $modelCourierPartner) { ?>

                                                    <div class="col-lg-6">
                                                        <?php
                                                        // echo "<p><b>" . $modelCourierPartner['name'] . "</b></p>";

                                                        $modelCourierPartnerProduct = CourierPartner::listCourierProduct($modelCourierPartner['id']); ?>


                                                        <?php
                                                        foreach ($modelCourierPartnerProduct as $modelCourierPartnerProduct) {
                                                            // if($checkCart['shipping_method'] == $modelCourierPartnerProduct['id']){
                                                            //     $checked = 'checked';
                                                            // }else{
                                                            //     $checked = false;
                                                            // }
                                                            // echo $form->field($modelCart, 'shipping_method['.$storeId.']')->radio([
                                                            //     'label' => $modelCourierPartnerProduct['name'], 
                                                            //     'value' => '99', 
                                                            //     'id' => $modelCourierPartnerProduct['id'], 
                                                            //     'checked' => $checked]);
                                                            //  $modelInfoBiayaKirim = CourierPartner::getInfoBiayaKirim($storeId, $modelCourierPartnerProduct['id']);


                                                        ?>
                                                            <!-- <div class="form-group highlight-addon well well-sm ">
                                                                <span>
                                                                    Biaya : <?php // echo $modelInfoBiayaKirim['ongkir'] 
                                                                            ?>
                                                                    Esimasi : <?php //echo $modelInfoBiayaKirim['estimasi'] 
                                                                                ?>
                                                                    Keterangan : <?php //echo $modelInfoBiayaKirim['ket'] 
                                                                                    ?>
                                                                </span>
                                                            </div> -->
                                                        <?php
                                                            $listRadio[$modelCourierPartnerProduct['id']] = $modelCourierPartnerProduct['name'] . '(' . $modelCourierPartner['name'] . ')';
                                                        } ?>

                                                    </div>
                                                <?php }
                                                ?>
                                                <div class="input-wrap">
                                                    <div class="clearfix" id="UserLogin-gender">
                                                        <!-- <label class="radio-head">Pengiriman Yang Dipilih</label> -->

                                                        <?php
                                                        // $form->field($modelCart, 'shipping_method[' . $storeId . ']')
                                                        //     ->radioList(
                                                        //         $listRadio,
                                                        //         [
                                                        //             'item' => function ($index, $label, $name, $checked, $value) {

                                                        //                 $return = '<label class="modal-radio">';
                                                        //                 $return .= '<input type="radio" name="' . $name . '" value="' . $value . '" tabindex="3">';
                                                        //                 $return .= '<i></i>';
                                                        //                 $return .= '<span>' . ucwords($label) . '</span>';
                                                        //                 $return .= '</label>';

                                                        //                 return $return;
                                                        //             }
                                                        //         ]
                                                        //     )
                                                        //     ->label(false);
                                                        ?>
                                                    </div>
                                                    <div class="help-block"></div>
                                                </div>

                                                <?php
                                                /**
                                                 * Ini konsep sebelum ada KAK. dimana metode pngiriman dijdikan status. tapi karna KAK minta -
                                                 * klo harus ada alamat mitra kirim, kurir, layanan dari mitra kirim, maka dibuat table dengan prefix courier 
                                                 *
                                                 */
                                                //  $form->field($modelCart, 'shipping_method[' . $storeId . ']')->widget(Select2::classname(), [
                                                //     'data' => MasterStatus::getOrderShippingMethod(),
                                                //     'options' => [
                                                //         'placeholder' => Yii::t('app', 'Metode Pengiriman'),
                                                //         'value' => $checkCart['shipping_method'],
                                                //         'options' => [
                                                //             67 => ['disabled' => true],

                                                //         ]
                                                //     ],
                                                //     'pluginOptions' => [
                                                //         'allowClear' => true
                                                //     ],
                                                // ])->label(false);

                                                ?>

                                                <?php
                                                // if ($checkCart['shipping_method'] == Order::SHIPPING_METHOD_KURIR_JALADARA) {
                                                //     $jaladaraDetail = Cart::getInfoOngkirJaladara($storeId);

                                                //     echo "<p>Biaya Kirim " . number_format($jaladaraDetail, 2, ',', '.');
                                                //     "</p>";
                                                // } elseif ($checkCart['shipping_method'] == Order::SHIPPING_METHOD_KURIR_PRIBADI) {
                                                //     echo "<p>Biaya Kirim <i>Belum diketahui</i>";
                                                //     "</p>";
                                                // }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <b>Lengkapi Data Anda</b>
                                        </div>
                                    </div>
                                    <br>
                                    <?php
                                    $userId = \Yii::$app->user->identity->id;
                                    $getUser = User::findOne(['id' => $userId]);
                                    $getUserProfile = UserProfile::findOne(['user_id' => $userId]);
                                    $getUserAddress = UserAddress::findOne(['user_id' => $userId, 'status_id' => '2']);
                                    ?>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <?= $form->field($modelUserProfile, 'firstname')->textInput()->label('Nama') ?>
                                        </div>

                                        <div class="col-lg-3">
                                            <?= $form->field($modelUserProfile, 'phone_number')->textInput()->label('Nomor Telepon') ?>
                                        </div>

                                        <div class="col-lg-3">
                                            <?= $form->field($modelSekolah, 'npwp')->textInput()->label('NPWP') ?>
                                        </div>

                                        <div class="col-lg-3">
                                            <?= $form->field($modelSekolah, 'no_telepon')->textInput()->label('No Telepon Sekolah') ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <?= $form->field($modelUserAddress, 'province_id')->widget(Select2::classname(), [
                                                'data' => Province::getListProvince(),
                                                'options' => [
                                                    'placeholder' => \Yii::t('app', 'Province'),
                                                    'class' => 'form-control',
                                                    'requried' => 'required',
                                                    'id' => 'province_id',
                                                ],
                                                'pluginOptions' => [
                                                    'allowClear' => true
                                                ],
                                            ])->label('Provinsi'); ?>

                                        </div>
                                        <div class="col-lg-6">
                                            <?= $form->field($modelUserAddress, 'districts_id')->widget(DepDrop::classname(), [
                                                'type' => DepDrop::TYPE_SELECT2,
                                                'options' => ['id' => 'districts_id', 'placeholder' => 'Select Districts'],
                                                'pluginOptions' => [
                                                    'depends' => ['province_id'],
                                                    'initialize' => $modelUserAddress->isNewRecord ? false : true,
                                                    'placeholder' => \Yii::t('app', 'Districts'),
                                                    'url' => \yii\helpers\Url::to(['/cmregions/default/show-district']),
                                                ]
                                            ])->label(\Yii::t('common', 'Kabupaten'));
                                            ?>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <?= $form->field($modelUserAddress, 'subdistrict_id')->widget(DepDrop::classname(), [
                                                'type' => DepDrop::TYPE_SELECT2,
                                                'options' => ['id' => 'subdistricts_id', 'placeholder' => 'Select Districts'],
                                                'pluginOptions' => [
                                                    'depends' => ['districts_id'],
                                                    'initialize' => $modelUserAddress->isNewRecord ? false : true,
                                                    'placeholder' => \Yii::t('app', 'Districts'),
                                                    'url' => \yii\helpers\Url::to(['/cmregions/default/show-subdistrict']),
                                                ]
                                            ])->label(\Yii::t('common', 'Kecamatan'));
                                            ?>
                                        </div>
                                        <div class="col-lg-6">
                                            <?= $form->field($modelUserAddress, 'village_id')->widget(DepDrop::classname(), [
                                                'type' => DepDrop::TYPE_SELECT2,
                                                'options' => ['id' => 'village_id'],
                                                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                                                'pluginOptions' => [
                                                    'depends' => ['subdistricts_id'],
                                                    'initialize' => $modelUserAddress->isNewRecord ? false : true,
                                                    'url' => \yii\helpers\Url::to(['/cmregions/default/show-village']),
                                                    'placeholder' => Yii::t('app', 'Pilih Kelurahan / Desa'),
                                                ]
                                            ]);
                                            ?>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <?php $modelUserAddress->address = $getUserAddress['address']; ?>
                                            <?= $form->field($modelUserAddress, 'address')->textInput(['maxlength' => true])->label('Nama Jalan') ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label class="radio-head">Pengiriman Yang Dipilih</label><br>
                                            <?php
                                            $shippingDetail = CourierProduct::findOne(['id' => $checkCart['shipping_method']]);

                                            echo 'Metode Kirim : ' . $shippingDetail['name'] . '<br>';
                                            echo 'Estimasi Kirim : ' . $checkCart['shipping_estimate'] . '<br>';
                                            echo 'Biaya Kirim : ' . $checkCart['shipping_cost'] . '<br>';
                                            echo 'Catatan Pengiriman : ' . $checkCart['shipping_note'] . '<br>';
                                            ?>
                                        </div>
                                    </div>

                                    <div>
                                        <?php
                                        $checkNegoForCheckoutSubmit = CartNegoItem::find()->where(['cart_id' => $cartId])->all();
                                        $checkCompare = CCompare::find()->where(['cart_id' => $cartId, 'status_id' => ['1', '3']])->one();
                                        if ($checkNegoForCheckoutSubmit == true) {
                                            $checkNegoGantung = 0;
                                            foreach ($checkNegoForCheckoutSubmit as $checkNegoForCheckoutSubmit) {
                                                if (in_array($checkNegoForCheckoutSubmit['status_id'], ['87'])) {
                                                    $checkNegoGantung += 1;
                                                }
                                            }
                                        } else {
                                            $checkNegoGantung = 0;
                                        }

                                        if ($checkNegoForCheckoutSubmit == false && $checkCompare == false) {
                                            if ($totalCartByStore >= Order::MIN_50 && $totalCartByStore <= Order::MAX_200) {
                                                // echo "<br> Total pesanan lebih dari >Rp " . Order::MIN_50 . ". Lakukan perbandingan paling sedikit dari 2(dua) calon penyedia atau lakukan nego";
                                            }

                                            if ($totalCartByStore >= Order::MAX_200) {
                                                // echo "<br> Total pesanan lebih dari >Rp " . Order::MAX_200 . ". Lakukan perbandingan paling sedikit dari 3(tiga) calon penyedia atau lakukan nego";
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                            if (Yii::$app->user->can('kepalaSekolah')  || Yii::$app->user->can('guruPbj')) { ?>

                            <?php } else { ?>
                                <br>
                                <div class="alert alert-warning" role="alert">
                                    Checkout tidak dapat dilakukan.
                                    Checkout hanya dapat dilakukan oleh <b>Kepala Sekolah atau Guru PBJ</b>. Silahkan minta Kepala Sekolah dari sekolah anda untuk melanjutkan pesanan.
                                </div>
                            <?php }
                            ?>

                            <?php
                            $statusIdCompare = '1';
                            $checkPerbandinganActive =   \Yii::$app->db->createCommand("SELECT * FROM {{%c_compare}} AS c JOIN {{%c_compare_store}} AS cs ON c.id = cs.compare_id WHERE c.status_id =:status_id AND cs.store_id =:storeId AND c.cart_id =:cart_id")
                                ->bindValue(':status_id', $statusIdCompare)
                                ->bindValue(':storeId', $storeId)
                                ->bindValue(':cart_id', $cartId)
                                ->queryScalar();

                            if ($checkPerbandinganActive >= 1) {
                                $statusTokoBanding = "Aktif";
                            } else {
                                $statusTokoBanding = "Not Aktif";
                            }

                            if ($statusTokoBanding == 'Aktif') { ?>
                                <div class="alert alert-warning mt-5" role="alert">
                                    Perbandingan untuk penjual <?= $storeDetailByStoreId['store_name'] ?> sudah dibuat. <a href="<?= Url::to(['compare/index']); ?>">Detail pebandingan</a>
                                </div>
                                <?php }

                            $checkNegoForCheckoutSubmitAlert = CartNegoItem::find()->where(['cart_id' => $cartId])->all();
                            $checkCompareAlert = CCompare::find()->where(['cart_id' => $cartId, 'status_id' => ['1', '3']])->one();
                            if ($checkNegoForCheckoutSubmitAlert == true) {

                                $checkNegoAlert = 0;
                                foreach ($checkNegoForCheckoutSubmitAlert as $checkNegoForCheckoutSubmitAlert) {
                                    if (in_array($checkNegoForCheckoutSubmitAlert['status_id'], ['87', '94', '110'])) {
                                        $checkNegoAlert += 1;
                                    }
                                }

                                if ($checkNegoAlert <= 0 || $checkCompareAlert == true) {
                                    // echo "xxxxx";
                                } else { ?>
                                    <div class="alert alert-warning mt-5" role="alert">
                                        Checkout belum dapat dilakukan. Masih ada <b>perbandingan</b> yang belum di simpan atau <b>nego</b> yang belum di setujui oleh penjual.
                                    </div>
                            <?php }
                            }
                            ?>

                        </div><!-- /.card-body -->

                        <div class="card-footer">
                            <div class="row" style="padding-bottom: 0px;">
                                <?php


                                /**
                                 * check compare atau perbandingan sudah ada.
                                 */
                                $checkNegoForCheckoutSubmit = CartNegoItem::find()->where(['cart_id' => $cartId])->all();
                                $checkCompare = CCompare::find()->where(['cart_id' => $cartId, 'status_id' => ['1', '3']])->one();
                                if ($checkNegoForCheckoutSubmit == true) {
                                    $checkNegoGantung = 0;
                                    foreach ($checkNegoForCheckoutSubmit as $checkNegoForCheckoutSubmit) {
                                        if (in_array($checkNegoForCheckoutSubmit['status_id'], ['87'])) {
                                            $checkNegoGantung += 1;
                                        }
                                    }
                                } else {
                                    $checkNegoGantung = 0;
                                }

                                if (($checkNegoForCheckoutSubmit == true && $checkNegoGantung == 0) || $checkCompare == true) {
                                    if (Yii::$app->user->can('kepalaSekolah')  || Yii::$app->user->can('guruPbj')) {
                                        if ($checkStatusSumberDanaSekolah > 0) {
                                            echo Html::submitButton(Yii::t('backend', '{icon}  Buat Pesanan', [
                                                'icon' => FAS::icon('save')
                                            ]), ['name' => 'save_' . $storeId . '', 'value' => 'save_' . $storeId . '', 'class' => 'btn btn-success float-right mr-2']);
                                        }
                                    }
                                } else if ($checkNegoForCheckoutSubmit == false && $checkCompare == false) {
                                    // if ($totalCartByStore >= Order::MIN_50) {
                                    //     echo Html::submitButton(Yii::t('backend', '{icon} Buat Perbandingan', [
                                    //         'icon' => FAS::icon('not-equal')
                                    //     ]), ['name' => 'compare_' . $storeId . '', 'value' => 'compare_' . $storeId . '', 'class' => 'btn btn-warning float-right mr-2']);
                                    // } else {
                                        if (Yii::$app->user->can('kepalaSekolah')  || Yii::$app->user->can('guruPbj')) {
                                            if ($checkStatusSumberDanaSekolah > 0) {
                                                echo Html::submitButton(Yii::t('backend', '{icon}  Buat Pesanan', [
                                                    'icon' => FAS::icon('save')
                                                ]), ['name' => 'save_' . $storeId . '', 'value' => 'save_' . $storeId . '', 'class' => 'btn btn-success float-right mr-2']);
                                            }
                                        }
                                    // }
                                }

                                echo Html::submitButton(Yii::t('backend', '{icon} Perbarui Keranjang', [
                                    'icon' => FAS::icon('refresh')
                                ]), ['name' => 'update_qty_' . $storeId . '', 'value' => 'update_qty_' . $storeId . '', 'class' => 'btn btn-default float-right mr-2']);

                                ?>


                            </div>
                        </div>
                    </div>
                    <!-- ./card -->
                </div>
                <!-- /.col -->
            </div>

            <?php
            $totalCartAllStore += $totalCartByStore;
            ?>


            <?php ActiveForm::end(); ?>
        <?php } ?>

        <div class="row" class="mt-4" style="margin-bottom: 120px;">
            <div class="col-lg-12">
                <?php $formAllCheckout = ActiveForm::begin(['id' => 'all-checkout', 'action' => 'checkout-all', 'method' => 'post']); ?>



                <?php
                if (Yii::$app->user->can('kepalaSekolah')  || Yii::$app->user->can('guruPbj')) {

                    $listStoreOnCart = Cart::listStoreOnCart();


                    $totalDataNotValid = 0;
                    foreach ($listStoreOnCartAll as $listStoreOnCartAll) {

                        $storeId = $listStoreOnCartAll['store_id'];
                        $cartId = $listStoreOnCartAll['id'];

                        $checkCart = Cart::findOne(['id' => $cartId]);


                        if ($checkCart['sumber_dana_id'] == '0') {
                            $totalDataNotValid += 1;
                        }

                        if ($checkCart['shipping_method'] == NULL) {
                            $totalDataNotValid += 1;
                        }

                        if ($checkCart['estimasi_pembayaran'] == '0') {
                            $totalDataNotValid += 1;
                        }
                    }
                    if ($totalDataNotValid != 0) { ?>
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            Buat Pesanan Sekaligus dapat dilakukan setelah informasi yang di minta pada masing - masing penjual terpenuhi.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php if ($checkStatusSumberDanaSekolah > 0) { ?>
                            <button type="button" class=" float-right mr-2 btn bg-gradient-secondary disabled" data-toggle="tooltip" data-placement="top" title=""><span class="fas fa-save"></span> Buat Pesanan Sekaligus</button>
                        <?php } ?>
                <?php } else {
                        /**
                         * check compare atau perbandingan sudah ada.
                         */
                        $checkNegoForCheckoutSubmit = CartNegoItem::find()->where(['cart_id' => $cartId])->all();
                        $checkCompare = CCompare::find()->where(['cart_id' => $cartId, 'status_id' => ['1', '3']])->one();
                        if ($checkNegoForCheckoutSubmit == true) {

                            $checkNegoGantung = 0;
                            foreach ($checkNegoForCheckoutSubmit as $checkNegoForCheckoutSubmit) {
                                if (in_array($checkNegoForCheckoutSubmit['status_id'], ['87'])) {
                                    $checkNegoGantung += 1;
                                }
                            }
                        } else {
                            $checkNegoGantung = 0;
                        }

                        if (($checkNegoForCheckoutSubmit == true && $checkNegoGantung == 0) || $checkCompare == true) {
                            $checkStatusSumberDanaSekolah = SumberDanaSekolah::checkStatusSumberDanaSekolah($sekolahId);
                            if ($checkStatusSumberDanaSekolah > 0) {
                                if (Yii::$app->user->can('kepalaSekolah')  || Yii::$app->user->can('guruPbj')) {
                                    if ($checkStatusSumberDanaSekolah > 0) {
                                        echo Html::submitButton(Yii::t('backend', '{icon}  Buat Pesanan Sekaligus', [
                                            'icon' => FAS::icon('save')
                                        ]), ['name' => 'save_all', 'value' => 'save_all', 'class' => 'btn btn-success float-right mr-2']);
                                    }
                                }
                            }
                        } else if ($checkNegoForCheckoutSubmit == false && $checkCompare == false) {
                            if ($totalCartByStore >= Order::MIN_50) {
                                // echo Html::submitButton(Yii::t('backend', '{icon} Buat Perbandingan', [
                                //     'icon' => FAS::icon('not-equal')
                                // ]), ['name' => 'compare_' . $storeId . '', 'value' => 'compare_' . $storeId . '', 'class' => 'btn btn-warning float-right mr-2']);
                            } else {
                                if (Yii::$app->user->can('kepalaSekolah')  || Yii::$app->user->can('guruPbj')) {
                                    if ($checkStatusSumberDanaSekolah > 0) {
                                        echo Html::submitButton(Yii::t('backend', '{icon}  Buat Pesanan Sekaligus', [
                                            'icon' => FAS::icon('save')
                                        ]), ['name' => 'save_all', 'value' => 'save_all', 'class' => 'btn btn-success float-right mr-2']);
                                    }
                                }
                            }
                        }
                    }
                }
                ?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>

    </div>
<?php } else { ?>
    <p style="text-align: center;">
        Keranjang Belanja anda kosong. Kembali <a href="<?= Url::to(['/site/index']); ?>"> kehalaman depan</a>.
    </p>
<?php }
?>