<?php

use common\models\Order;
use common\models\MasterStatus;
use common\models\OrderHistory;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var common\models\search\OrderSearch $searchModel
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = Yii::t('dashbuyer', 'Orders');
$this->params['breadcrumbs'][] = $this->title;
?>
<ul class="pagination pagination-month justify-content-center">
    <li class="page-item mr-2 text-center">
        <a class="page-link" href="<?= Url::to(['index']) ?>">
            <p class="page-month mb-0">Semua </p>
            <p class="page-year mb-0"><?= Order::getTotalOrderBuyerByStatus(); ?><0/p>
        </a>
    </li>
    <li class="page-item mr-2 text-center">
        <a class="page-link" href="{{ route('order.index', ['status' => \App\Models\Order::PESANAN_BARU]) }}">
            <p class="page-month mb-0"> Baru </p>
            {{ $newOrder }}
        </a>
    </li>    
    <li class="page-item mr-2 text-center">
        <a class="page-link" href="<?= Url::to(['index','status' => Order::PESANAN_KONFIRMASI_PENGIRIMAN]) ?>">
            <p class="page-month mb-0">Konfirmasi  / Proses</p>
            <p class="page-year mb-0"><?= Order::getTotalOrderBuyerByStatus(Order::PESANAN_KONFIRMASI_PENGIRIMAN); ?></p>
        </a>
    </li>

    <li class="page-item mr-2 text-center">
        <a class="page-link" href="<?= Url::to(['index','status' => Order::PESANAN_KONFIRMASI_PEMBATALAN_PENJUAL]) ?>">
            <p class="page-month mb-0"> Konfirmasi Batal</p>
            <p class="page-year mb-0"><?= Order::getTotalOrderBuyerByStatus(Order::PESANAN_KONFIRMASI_PEMBATALAN_PENJUAL); ?></p>
        </a>
    </li>

    <li class="page-item mr-2 text-center">
        <a class="page-link" href="<?= Url::to(['index','status' => Order::PESANAN_DIBATALKAN_PEMBELI]) ?>">
            <p class="page-month mb-0"> Dibatalkan Pembeli</p>
            <p class="page-year mb-0"><?= Order::getTotalOrderBuyerByStatus(Order::PESANAN_DIBATALKAN_PEMBELI); ?></p>
        </a>
    </li>

    <li class="page-item mr-2 text-center">
        <a class="page-link" href="<?= Url::to(['index','status' => Order::PESANAN_DIKIRIM]) ?>">
            <p class="page-month mb-0"> Dikirim</p>
            <p class="page-year mb-0"><?= Order::getTotalOrderBuyerByStatus(Order::PESANAN_DIKIRIM); ?></p>
        </a>
    </li>

    <li class="page-item mr-2 text-center">
        <a class="page-link" href="<?= Url::to(['index','status' => Order::PESANAN_DITERIMA]) ?>">
            <p class="page-month mb-0"> Diterima</p>
            <p class="page-year mb-0"><?= Order::getTotalOrderBuyerByStatus(Order::PESANAN_DITERIMA); ?></p>
        </a>
    </li>

    <li class="page-item mr-2 text-center">
        <a class="page-link" href="<?= Url::to(['index','status' => Order::PESANAN_SUDAH_BAST]) ?>">
            <p class="page-month mb-0"> Sudah BAST</p>
            <p class="page-year mb-0"><?= Order::getTotalOrderBuyerByStatus(Order::PESANAN_SUDAH_BAST); ?></p>
        </a>
    </li>

    <li class="page-item mr-2 text-center">
        <a class="page-link" href="<?= Url::to(['index','status' => Order::PESANAN_MENUNGGU_PEMBAYARAN]) ?>">
            <p class="page-month mb-0">Menunggu Pembayaran</p>
            <p class="page-year mb-0"><?= Order::getTotalOrderBuyerByStatus(Order::PESANAN_MENUNGGU_PEMBAYARAN); ?></p>
        </a>
    </li>

    <li class="page-item mr-2 text-center">
        <a class="page-link" href="<?= Url::to(['index','status' => Order::PESANAN_TERBAYAR]) ?>">
            <p class="page-month mb-0"> Dibayar</p>
            <p class="page-year mb-0"><?= Order::getTotalOrderBuyerByStatus(Order::PESANAN_TERBAYAR); ?></p>
        </a>
    </li>

    <li class="page-item mr-2 text-center">
        <a class="page-link" href="<?= Url::to(['index','status' => Order::PESANAN_PESANAN_SELESAI]) ?>">
            <p class="page-month mb-0"> Selesai</p>
            <p class="page-year mb-0"><?= Order::getTotalOrderBuyerByStatus(Order::PESANAN_PESANAN_SELESAI); ?></p>
        </a>
    </li>
    
    <li class="page-item mr-2 text-center active">
        <a class="page-link" href="<?= Url::to(['pembekuan']) ?>">
            <p class="page-month mb-0"> Dibekukan</p>
            <p class="page-year mb-0"><?= Order::getTotalOrderStoreByStatusBuyerPembekuan(); ?></p>
        </a>
    </li>
</ul>
<div class="order-index">
    <div class="card">
        <div class="card-header ui-sortable-handle" style="cursor: move;">
            <div class="card-tools">
                <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                        <a class="nav-link active">Total Nominal : Rp<?= number_format(Order::getTotalAmountOrderStoreByStatusBuyerPembekuan()); ?></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card-body">
            <?php // echo $this->render('_search', ['model' => $searchModel]); 
            ?>

            <?php echo GridView::widget([
                'layout' => "{items}\n{pager}",
                'options' => [
                    'class' => ['gridview', 'table-responsive'],
                ],
                'tableOptions' => [
                    'class' => ['table', 'text-nowrap', 'table-striped', 'table-bordered', 'mb-0'],
                ],
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'nomor_order',
                    [
                        'header' => 'Tanggal Pesan',
                        'attribute' => 'date_order',
                        'filter' => false,
                        'value' => function($model){
                            return $model->date_order;

                        }
                    ],
                    [
                        'header' => 'Total Pesanan',
                        'filter' => false,
                        'value' => function($model){
                            return 'Rp'.number_format(Order::getTotalHarga($model->id) + $model->shipping_cost, 2, ",", ".");
                        }
                    ],
                    // 'payment_method',
                    // 'user_id',
                    [
                        'header' => 'Status',
                        'attribute' => 'status_id',
                        'value' => function($model){
                            $statusTransaksi = MasterStatus::findOne(['id' => $model->status_id]);
                            return $statusTransaksi['name'];
                        }
                    ],
                    [
                        'header' => 'Penjual',
                        'attribute' => 'store.store_name',
                    ],
                    [
                        'header' => 'Penjual wajib kirim <br> dalam jangka waktu',
                        'value' => function ($model) {
                            $getTanggalKonfirmasi = OrderHistory::findOne(['order_id' => $model['id'], 'order_status_check' => Order::PESANAN_KONFIRMASI_PENGIRIMAN]);
                            $getJangkaWaktu = strtotime($model['confirm_shipping_date']) - strtotime(date('Y-m-d', strtotime($getTanggalKonfirmasi['created_at'])));
                            $jangkaWaktu = floor($getJangkaWaktu / (24 * 60 * 60));

                            return $jangkaWaktu . ' Hari';
                        }
                    ],
                    [
                        'header' => 'Tiba di sekolah',
                        'value' => function ($model) {
                            if ($model->tiba_disekolah == '0000-00-00' || $model->tiba_disekolah == NULL) {
                                return '';
                            } else {
                                return $model->tiba_disekolah;
                            }
                        }
                    ],
                    [
                        'class' => \common\widgets\ActionColumn::class,
                        'template' => '{view}',
                        'buttons' => [
                            'view' => function ($url, $model) {
                                return Html::a('<span class="fa-fw fas fa-eye"></span>', $url, [
                                    'title' => Yii::t('app', 'lead-view'),
                                    'class' => 'btn btn-info btn-xs'
                                ]);
                            },
                        ],
                        'urlCreator' => function ($action, $model, $key, $index) {
                            if ($action === 'view') {
                                $url = Url::to(['list/detail', 'id' => $model->id, 'status' => $model->status_id]);
                                return $url;
                            }
                        },


                    ],
                ],
            ]); ?>
        </div>
        <div class="card-footer">
            <?php echo getDataProviderSummary($dataProvider) ?>
        </div>
    </div>

</div>