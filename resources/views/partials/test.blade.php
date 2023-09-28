<?php

use common\models\Province;
use kartik\depdrop\DepDrop;
use kartik\form\ActiveForm;
use kartik\helpers\Html;
use kartik\select2\Select2;
$this->registerJs("$('#npwp').mask('00.000.000.0-000.000');");
$this->registerJs("
    $('#npsn').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    
    $('#no_telepon').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    $('#nip_bendahara_bos').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    $('#nip_kepala_sekolah').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9]/g, '');
    });
");

$form = ActiveForm::begin(['id' => 'register-form']); ?>

<div class="container mt-5" style="margin-bottom: 100px;">
    <div class="tab-pane" role="tabpanel" id="step4">
        <h3>Sekolah</h3>
        <hr>
        <div class="row">
            <div class="col-lg-6">
                <?= $form->field($modelSekolah, 'nama_sekolah')->textInput(['maxlength' => true])->label('Nama Sekolah') ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($modelSekolah, 'npsn')->textInput(['maxlength' => true, 'id' => 'npsn']) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($modelSekolah, 'npwp')->textInput(['maxlength' => true, 'id' => 'npwp']) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3">
                <?= $form->field($modelSekolah, 'bentuk_pendidikan')->dropdownList([
                    'MI' => 'MI',
                    'MTS' => 'MTs',
                    'MA' => 'MA'
                ])->label('Jenjang'); ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($modelSekolah, 'status')->dropdownList([
                    'Negeri' => 'Negeri',
                    'Swasta' => 'Swasta',
                ])->label('Status'); ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($modelSekolah, 'email')->textInput(['maxlength' => true])->label('Email Sekolah') ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($modelSekolah, 'no_telepon')->textInput(['maxlength' => true, 'id' => 'no_telepon'])->label('No Telepon Sekolah') ?>
            </div>
        </div>
        <div class="row">
            <?php
            $dataUser = Yii::$app->session->get('dataUser');

            if ($dataUser['jabatan'] == 'Kepala Sekolah') {
                $namaKepsek = $dataUser['nama'];
                $nipKepsek = $dataUser['nip'];

                $namaBendahara = '';
                $nipBendahara = '';
            } else {
                $namaKepsek = '';
                $nipKepsek = '';

                $namaBendahara = $dataUser['nama'];
                $nipBendahara = $dataUser['nip'];
            }

            ?>
            <div class="col-lg-3">
                <?= $form->field($modelSekolah, 'kepala_sekolah')->textInput(['maxlength' => true, 'value' => $namaKepsek]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($modelSekolah, 'nip_kepala_sekolah')->textInput(['maxlength' => true, 'id' => 'nip_kepala_sekolah', 'value' => $nipKepsek])->label('NIP / NIY Kepala Sekolah') ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($modelSekolah, 'bendahara_bos')->textInput(['maxlength' => true, 'value' => $namaBendahara]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($modelSekolah, 'nip_bendahara_bos')->textInput(['maxlength' => true, 'id' => 'nip_bendahara_bos', 'value' => $nipBendahara])->label('NIP / NIY Bendahara') ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <?= $form->field($modelSekolah, 'kd_prov')->widget(Select2::classname(), [
                    'data' =>  Province::getListProvince(),
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
                <?= $form->field($modelSekolah, 'kd_kab')->widget(DepDrop::classname(), [
                    'type' => DepDrop::TYPE_SELECT2,
                    'options' => ['id' => 'districts_id', 'placeholder' => 'Select Districts'],
                    'pluginOptions' => [
                        'depends' => ['province_id'],
                        'placeholder' => \Yii::t('app', 'Districts'),
                        'url' => \yii\helpers\Url::to(['/cmregions/default/show-district']),
                    ]
                ])->label(\Yii::t('common', 'Kabupaten'));
                ?>


            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <?= $form->field($modelSekolah, 'kd_kec')->widget(DepDrop::classname(), [
                    'type' => DepDrop::TYPE_SELECT2,
                    'options' => ['id' => 'subdistricts_id', 'placeholder' => 'Select Districts'],
                    'pluginOptions' => [
                        'depends' => ['districts_id'],
                        'placeholder' => \Yii::t('app', 'Districts'),
                        'url' => \yii\helpers\Url::to(['/cmregions/default/show-subdistrict']),
                    ]
                ])->label(\Yii::t('common', 'Kecamatan'));
                ?>
            </div>
            <div class="col-lg-6">
                <?= $form->field($modelDesa, 'kd_desa')->widget(DepDrop::classname(), [
                    'type' => DepDrop::TYPE_SELECT2,
                    'options' => ['id' => 'village_id'],
                    'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                    'pluginOptions' => [
                        'depends' => ['subdistricts_id'],
                        'url' => \yii\helpers\Url::to(['/cmregions/default/show-village']),
                        'placeholder' => Yii::t('app', 'Pilih Kelurahan / Desa'),
                    ]
                ])->label('Desa');
                ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-9">
                <?= $form->field($modelSekolah, 'alamat')->textInput(['maxlength' => true])->label('Alamat') ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($modelSekolah, 'kode_pos')->textInput(['maxlength' => true]) ?>
            </div>
        </div>


    </div>

    <div class="row">
        <div class="col-lg-12">
            <?= Html::submitButton('Berikutnya', ['class' => 'btn btn-primary float-right', 'name' => 'info-usaha']) ?>
        </div>
    </div>

</div>
<?php ActiveForm::end(); ?>