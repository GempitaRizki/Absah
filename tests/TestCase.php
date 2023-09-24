<?php

namespace frontend\modules\register\controllers;

use common\models\Store;
use common\models\StoreUser;
use common\models\MasterKekayaanCat;
use common\models\User;
use common\models\UserProfile;
use common\models\ModelMultiple;
use common\models\StoreDetail;
use common\models\StoreFile;
use common\models\StoreOwner;
use common\models\StoreWiljual;
use common\models\BankStore;
use common\models\TtdTanggungjawab;
use yii\helpers\Json;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use common\components\CodeUtility;
use common\models\Activity;
use common\models\Districts;
use common\models\MasterBank;
use common\models\NoFaktur;
use common\models\Subdistrict;

/**
 * Account controller for the `register` module
 */
class AccountController extends Controller
{

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $this->layout =  'main-signup';

        $model = new \yii\base\DynamicModel([
            'email', 'password', 'seller_type', 'store_name',
        ]);
        $model->addRule(['email', 'password', 'seller_type', 'store_name'], 'required')
            ->addRule(['email'], 'email')

            ->addRule(['email'], 'unique');

        $modelUser = new User();

        if ($model->load(Yii::$app->request->post()) && $modelUser->load(Yii::$app->request->post())) {
            if (!$modelUser->validate()) {
                return $this->render('index', [
                    'model' => $model,
                    'modelUser' => $modelUser
                ]);
            }
            $session = Yii::$app->session;

            $session->set('dataPengguna',  [
                'email' => $modelUser->email,
                'password' => $model->password,
                'seller_type' => $model->seller_type,
                'store_name' => $model->store_name,

            ]);


            $this->redirect(array('info-usaha', array()));
        }

        return $this->render('index', [
            'model' => $model,
            'modelUser' => $modelUser
        ]);
    }



    public function actionInfoUsaha()
    {
        $model = new Store();
        $modelDetail = new StoreDetail();

        $dataInfoPengguna = Yii::$app->session->get('dataPengguna');


        if ($model->load(Yii::$app->request->post()) && $modelDetail->load(Yii::$app->request->post())) {

            $session = Yii::$app->session;
            if ($dataInfoPengguna['seller_type'] == '1') { // individu

                if ($modelDetail->kekayaan_bersih == '1') {
                    $kategoriUsaha = '1';
                } elseif ($modelDetail->kekayaan_bersih == '2') {
                    $kategoriUsaha = '9';
                } elseif ($modelDetail->kekayaan_bersih == '3') {
                    $kategoriUsaha = '10';
                } else {
                    $kategoriUsaha = '1';
                }

                $session->set('dataInfoUsaha',  [
                    'store_name' => $model->store_name,
                    'web_name' => $model->web_name,
                    'public_email' => $model->public_email,
                    'phone_number' => $model->phone_number,
                    'short_description' => $model->short_description,
                    'about_us' => $model->about_us,
                    'fb_name' => $model->fb_name,
                    'tw_name' => $model->tw_name,
                    'linked_name' => $model->linked_name,
                    'inst_name' => $model->inst_name,
                    'yt_name' => $model->yt_name,
                    'nib' => $modelDetail->nib,
                    'skb' => $modelDetail->skb,
                    'kekayaan_bersih' => $modelDetail->kekayaan_bersih,
                    'kategori_usaha' => $kategoriUsaha,
                    'npwp' => $modelDetail->npwp,
                    'sk_umkm' => $modelDetail->sk_umkm,
                    'kepemilikan_usaha' => $modelDetail->kepemilikan_usaha,
                    'pkp' => $modelDetail->pkp,

                ]);
            } elseif ($dataInfoPengguna['seller_type'] == '0') { // corporate
                if ($modelDetail->kekayaan_bersih == '1') {
                    $kategoriUsaha = '1';
                } elseif ($modelDetail->kekayaan_bersih == '2') {
                    $kategoriUsaha = '9';
                } elseif ($modelDetail->kekayaan_bersih == '3') {
                    $kategoriUsaha = '10';
                } else {
                    $kategoriUsaha = '1';
                }
                $session->set('dataInfoUsaha',  [
                    'store_name' => $model->store_name,
                    'web_name' => $model->web_name,
                    'public_email' => $model->public_email,
                    'phone_number' => $model->phone_number,
                    'short_description' => $model->short_description,
                    'about_us' => $model->about_us,
                    'fb_name' => $model->fb_name,
                    'tw_name' => $model->tw_name,
                    'linked_name' => $model->linked_name,
                    'yt_name' => $model->yt_name,
                    'inst_name' => $model->inst_name,
                    'nib' => $modelDetail->nib,
                    'skb' => $modelDetail->skb,
                    'kekayaan_bersih' => $modelDetail->kekayaan_bersih,
                    'kategori_usaha' => $kategoriUsaha,
                    'npwp' => $modelDetail->npwp,
                    'kbli' => $modelDetail->kbli,
                    'tdp' => $modelDetail->tdp,
                    'siup' => $modelDetail->siup,
                    'akta_perusahaan' => $modelDetail->akta_perusahaan,
                    'akta' => $modelDetail->akta,
                    'pkp' => $modelDetail->pkp,
                    'kepemilikan_usaha' => $modelDetail->kepemilikan_usaha,
                ]);
            }

            // print_r($_SESSION['dataInfoUsaha']);

            return $this->redirect('info-ttd');
        }



        if ($dataInfoPengguna['seller_type'] == '1') {
            return $this->render('info-usaha-individu', [
                'model' => $model,
                'modelDetail' => $modelDetail,
            ]);
        } elseif ($dataInfoPengguna['seller_type'] == '0') {
            return $this->render('info-usaha-corporate', [
                'model' => $model,
                'modelDetail' => $modelDetail,
            ]);
        }
    }

    public function actionInfoTtd()
    {
        $session = Yii::$app->session;
        $modelInChargePerson = new \yii\base\DynamicModel([
            'name', 'jabatan', 'nik', 'npwp', 'phone_number', 'check'
        ]);
        $modelInChargePerson->addRule(['name', 'jabatan', 'phone_number', 'check'], 'string', ['max' => 128]);
        $modelInChargePerson->addRule(['name', 'nik', 'phone_number'], 'required');
        $modelInChargePerson->addRule(['npwp'], 'string', ['min' => 20]);
        $modelInChargePerson->addRule(['nik'], 'string', ['min' => 16, 'max' => 16]);
        $modelInChargePerson->addRule(['phone_number'], 'match', ['pattern' => '/^(\+62|62|0)8[1-9][0-9]{6,11}/']);

        $modelFaktur = new \yii\base\DynamicModel([
            'min_no_faktur', 'max_no_faktur'
        ]);
        $modelFaktur->addRule(['min_no_faktur', 'max_no_faktur'], 'string', ['min' => 15]);
        if ($session->get('dataInfoUsaha')['pkp'] == '17') {
            $modelFaktur->addRule(['min_no_faktur', 'max_no_faktur'], 'required');
        }

        $modelOwner = new StoreOwner();

        if ($modelInChargePerson->load(Yii::$app->request->post()) && $modelOwner->load(Yii::$app->request->post())) {

            if ($modelFaktur->load(Yii::$app->request->post())) {
                $session->set('dataFaktur',  [
                    'min_no_faktur' => $modelFaktur->min_no_faktur,
                    'max_no_faktur' => $modelFaktur->max_no_faktur,
                ]);
            }

            if ($modelInChargePerson->check == '1') {
                $session->set('dataTtd',  [
                    'name' => $modelOwner->name,
                    'jabatan' => $modelOwner->jabatan,
                    'nik' => $modelOwner->nik,
                    'npwp' => $modelOwner->npwp,
                    'phone_number' => $modelOwner->phone_number,

                ]);
                $session->set('dataPenanggujawab',  [
                    'name' => $modelOwner->name,
                    'jabatan' => $modelOwner->jabatan,
                    'nik' => $modelOwner->nik,
                    'npwp' => $modelOwner->npwp,
                    'phone_number' => $modelOwner->phone_number

                ]);
            } else {
                $session->set('dataTtd',  [
                    'name' => $modelOwner->name,
                    'jabatan' => $modelOwner->jabatan,
                    'nik' => $modelOwner->nik,
                    'npwp' => $modelOwner->npwp,
                    'phone_number' => $modelOwner->phone_number

                ]);

                $session->set('dataPenanggujawab',  [
                    'name' => $modelInChargePerson->name,
                    'jabatan' => $modelInChargePerson->jabatan,
                    'nik' => $modelInChargePerson->nik,
                    'npwp' => $modelInChargePerson->npwp,
                    'phone_number' => $modelInChargePerson->phone_number

                ]);
            }



            // print_r($_SESSION['dataTtd']) . '<br>';
            // print_r($_SESSION['dataPenanggujawab']) . '<br>';

            // exit();

            return $this->redirect('info-alamat');
        }
        return $this->render('info-ttd', [
            'modelInChargePerson' => $modelInChargePerson,
            'modelOwner' => $modelOwner,
            'modelFaktur' => $modelFaktur,
        ]);
    }


    public function actionInfoAlamat()
    {
        $model = new Store();
        $modelStoreDetail = new StoreDetail();

        if ($model->load(Yii::$app->request->post()) && $modelStoreDetail->load(Yii::$app->request->post())) {

            $session = Yii::$app->session;
            $session->set('dataInfoAlamat',  [
                'province_id' => $model->province_id,
                'districts_id' => $model->districts_id,
                'subdistrict_id' => $model->subdistrict_id,
                'village_id' => $model->village_id,
                'address' => $model->address,
                'postal_code' => $model->postal_code,

            ]);


            $session->set('dataInfoLatLot',  [
                'latitude' => $modelStoreDetail->latitude,
                'longtitude' => $modelStoreDetail->longtitude,

            ]);


            // print_r($_SESSION['dataInfoLatLot']);
            // exit();

            return $this->redirect('info-bank');
        }


        return $this->render('info-alamat', [
            'model' => $model,
            'modelStoreDetail' => $modelStoreDetail
        ]);
    }



    public function actionInfoBank()
    {
        $model = new BankStore();

        if ($model->load(Yii::$app->request->post())) {

            $session = Yii::$app->session;
            $session->set('dataInfoBank',  [
                'bank_id' => $model->bank_id,
                'number' => $model->number,
                'name' => $model->name

            ]);

            // print_r($_SESSION['dataInfoBank']);
            // exit();

            return $this->redirect('info-wil-jual');
        }

        return $this->render('info-bank', [
            'model' => $model,

        ]);
    }

    public function actionInfoWilJual()
    {
        $modelWilJual = [new StoreWiljual()];
        $model = new BankStore();



        if ($model->load(Yii::$app->request->post())) {


            $modelWilJual = ModelMultiple::createMultiple(StoreWiljual::classname());
            ModelMultiple::loadMultiple($modelWilJual, Yii::$app->request->post());



            $dataCheck = [];
            foreach ($modelWilJual as $modelRegion) {
                // if ($modelRegion->region_type == StoreWiljual::NATIONAL) {
                //     $modelRegion->store_id = 1;
                //     if ($modelRegion->save()) {
                //     } else {
                //         $successFlag = false;
                //         var_dump('yaahh');
                //         die;
                //     }
                // } else {

                // }
                $dataCheck[] = [
                    'category_id' => $modelRegion->category_id,
                    'wilayah_jual' => $modelRegion->region_type,
                    'kota' => $modelRegion->districts_id
                ];


                // $districtList = array();
                // $districtList = $modelRegion->districts_id;
                // $upperlimit = count((array)$districtList);
                // for ($i = 0; $i < $upperlimit; $i++) {
                //     $modelMultiRegion = new StoreWiljual();
                //     $modelMultiRegion->category_id = $modelRegion->category_id;
                //     $modelMultiRegion->subcategory_id = $modelRegion->subcategory_id;
                //     $modelMultiRegion->store_id = 1;
                //     $modelMultiRegion->districts_id = $districtList[$i];



                //     // if ($modelMultiRegion->save(false)) {
                //     // } else {
                //     //     $successFlag = false;
                //     //     var_dump('uwau');
                //     //     die;
                //     // }
                // }


            }

            $session = Yii::$app->session;
            $session->set('dataInfoWilJual',  $dataCheck);

            // echo "<pre>";
            // print_r($_SESSION['dataInfoWilJual']);
            // echo "</pre>";

            // exit();

            return $this->redirect('info-doc');
        }


        return $this->render('info-wil-jual', [

            'modelWilJual' => (empty($modelWilJual)) ? [new StoreWiljual()] : $modelWilJual,
            'model' => $model,


        ]);
    }


    public function actionInfoDoc()
    {

        $modelDetail = new StoreDetail();
        $modelBank = new BankStore();
        $model = new Store();
        $modelUser = new User();
        $modelUserStore = new StoreUser();




        $dataInfoPengguna = Yii::$app->session->get('dataPengguna');
        $dataInfoUsaha = Yii::$app->session->get('dataInfoUsaha');
        $dataTtd = Yii::$app->session->get('dataTtd');
        $dataPenanggujawab = Yii::$app->session->get('dataPenanggujawab');
        $dataInfoAlamat = Yii::$app->session->get('dataInfoAlamat');
        $dataInfoLatLot = Yii::$app->session->get('dataInfoLatLot');
        $dataInfoBank = Yii::$app->session->get('dataInfoBank');
        $dataInfoWilJual = Yii::$app->session->get('dataInfoWilJual');


        if (!empty(Yii::$app->session->get('dataFaktur'))) {
            $dataFaktur = Yii::$app->session->get('dataFaktur');
        }


        if ($dataInfoPengguna['seller_type'] == '1') {

            $modelFile = new \yii\base\DynamicModel([
                'logo', 'banner', 'ktp', 'npwpfile', 'butab', 'skumkm', 'nib', 'skb', 'npwpbu', 'bpt', 'tc'
            ]);
            //  $modelFile->addRule(['logo', 'banner', 'ktp', 'npwpfile', 'butab', 'nib'], 'required');
        } else {

            $modelFile = new \yii\base\DynamicModel([
                'logo', 'banner', 'ktp', 'npwpfile', 'butab',  'akta', 'aktaprb', 'siup', 'tdp', 'nib', 'kbli', 'pkp', 'skb', 'npwpbu', 'bpt', 'tc'
            ]);
            // $modelFile->addRule(['logo', 'banner', 'ktp', 'npwpfile', 'butab',  'akta', 'aktaprb', 'siup', 'tdp', 'nib', 'kbli', 'pkp', 'skb', 'npwpbu', 'bpt'], 'required');
        }



        if ($modelFile->load(Yii::$app->request->post())) {

            $connection = \Yii::$app->db;
            $transaction = $connection->beginTransaction();
            $successFlag = true;


            $model->slug = strtolower(str_replace(' ', '', $dataInfoPengguna['store_name']));
            $model->logo_bashurl = \Yii::getAlias('@fileDirStore');
            $model->banner_bashurl = \Yii::getAlias('@fileDirStore');
            $model->status_id = 5;
            $model->store_name = $dataInfoUsaha['store_name'];
            $model->web_name = $dataInfoUsaha['web_name'];
            $model->public_email = $dataInfoUsaha['public_email'];
            $model->short_description = $dataInfoUsaha['short_description'];
            $model->about_us = $dataInfoUsaha['about_us'];
            $model->fb_name = $dataInfoUsaha['fb_name'];
            $model->tw_name = $dataInfoUsaha['tw_name'];
            $model->linked_name = $dataInfoUsaha['linked_name'];
            $model->yt_name = $dataInfoUsaha['yt_name'];
            $model->inst_name = $dataInfoUsaha['inst_name'];
            $model->province_id = $dataInfoAlamat['province_id'];
            $model->districts_id = $dataInfoAlamat['districts_id'];
            $model->subdistrict_id = $dataInfoAlamat['subdistrict_id'];
            $model->village_id = $dataInfoAlamat['village_id'];
            $model->address = $dataInfoAlamat['address'];
            $model->postal_code = $dataInfoAlamat['postal_code'];
            $model->store_type = $dataInfoPengguna['seller_type'];


            if ($model->save(false)) {
                $user = new User();

                $user->username = $dataInfoPengguna['email'];
                $user->email = $dataInfoPengguna['email'];
                $user->setPassword($dataInfoPengguna['password']);




                if ($user->save(false)) {

                    $auth = Yii::$app->authManager;
                    $auth->assign($auth->getRole(User::ROLE_OWNER_STORE), $user->id);

                    $modelProfile = new UserProfile();
                    $modelProfile->user_id = $user->id;
                    $modelProfile->locale = 'en-US';
                    $modelProfile->save(false);

                    $modelUserStore->store_id = $model->id;
                    $modelUserStore->user_id = $user->id;
                    if ($modelUserStore->save(false)) {
                    } else {
                        $successFlag = false;
                        var_dump('b');
                        die;
                    }
                } else {
                    $successFlag = false;
                    var_dump('ab');
                    die;
                }


                foreach ($dataInfoWilJual as $keyKategory => $dataInfoWilJualKategori) {
                    foreach ($dataInfoWilJualKategori['kota'] as $keyDistrict => $valueDistrict) {
                        $modelMultiRegion = new StoreWiljual();
                        $modelMultiRegion->category_id = $keyKategory;
                        $modelMultiRegion->store_id = $model->id;
                        $modelMultiRegion->districts_id = $valueDistrict;

                        if ($modelMultiRegion->save(false)) {
                        } else {
                            $successFlag = false;
                            var_dump('uwau');
                            die;
                        }
                    }
                }


                if ($dataInfoPengguna['seller_type'] == '1') { // individu

                    $modelDetail->store_id = $model->id;
                    $modelDetail->latitude = $dataInfoLatLot['latitude'];
                    $modelDetail->longtitude = $dataInfoLatLot['longtitude'];
                    $modelDetail->nib = $dataInfoUsaha['nib'];
                    $modelDetail->skb = $dataInfoUsaha['skb'];
                    $modelDetail->kekayaan_bersih = $dataInfoUsaha['kekayaan_bersih'];
                    $modelDetail->kategori_usaha = $dataInfoUsaha['kategori_usaha'];
                    $modelDetail->npwp = $dataInfoUsaha['npwp'];
                    $modelDetail->pkp = $dataInfoUsaha['pkp'];
                    $modelDetail->kepemilikan_usaha = $dataInfoUsaha['kepemilikan_usaha'];
                } else {
                    $modelDetail->store_id = $model->id;
                    $modelDetail->latitude = $dataInfoLatLot['latitude'];
                    $modelDetail->longtitude = $dataInfoLatLot['longtitude'];
                    $modelDetail->nib = $dataInfoUsaha['nib'];
                    $modelDetail->skb = $dataInfoUsaha['skb'];
                    $modelDetail->kekayaan_bersih = $dataInfoUsaha['kekayaan_bersih'];
                    $modelDetail->kategori_usaha = $dataInfoUsaha['kategori_usaha'];
                    $modelDetail->npwp = $dataInfoUsaha['npwp'];
                    $modelDetail->kbli = $dataInfoUsaha['kbli'];
                    $modelDetail->tdp = $dataInfoUsaha['tdp'];
                    $modelDetail->siup = $dataInfoUsaha['siup'];
                    $modelDetail->akta_perusahaan = $dataInfoUsaha['akta_perusahaan'];
                    $modelDetail->akta = $dataInfoUsaha['akta'];
                    $modelDetail->pkp = $dataInfoUsaha['pkp'];
                    $modelDetail->kepemilikan_usaha = $dataInfoUsaha['kepemilikan_usaha'];
                }

                if ($modelDetail->save(false)) {
                    // if ($dataInfoUsaha['pkp'] == '17') {
                    //     $min_no_faktur = substr($dataFaktur['min_no_faktur'], -8);
                    //     $max_no_faktur = substr($dataFaktur['max_no_faktur'], -8);
                    //     foreach (range($min_no_faktur, $max_no_faktur, 1) as $nofaktur) {
                    //         $modelFaktur = new NoFaktur();
                    //         $modelFaktur->store_id = $model->id;
                    //         $modelFaktur->no_faktur = substr($dataFaktur['max_no_faktur'], 0, 7) . str_pad($nofaktur, 8, '0', STR_PAD_LEFT);
                    //         $modelFaktur->status = 152;
                    //         $modelFaktur->created_at = new \yii\db\Expression('NOW()');
                    //         $modelFaktur->updated_at = new \yii\db\Expression('NOW()');
                    //         $modelFaktur->save(false);
                    //     }
                    // }
                } else {
                    $successFlag = false;
                    var_dump('e');
                    die;
                }

                $modelOwnerTtd = new StoreOwner();


                $modelOwnerTtd->name = $dataTtd['name'];
                $modelOwnerTtd->jabatan = $dataTtd['jabatan'];
                $modelOwnerTtd->nik = $dataTtd['nik'];
                $modelOwnerTtd->npwp = $dataTtd['npwp'];
                $modelOwnerTtd->phone_number = $dataTtd['phone_number'];
                $modelOwnerTtd->store_id = $model->id;
                $modelOwnerTtd->type = '19';

                if ($modelOwnerTtd->save(false)) {
                    $modelOwnerJawab = new StoreOwner();

                    $modelOwnerJawab->name = $dataPenanggujawab['name'];
                    $modelOwnerJawab->jabatan = $dataPenanggujawab['jabatan'];
                    $modelOwnerJawab->nik = $dataPenanggujawab['nik'];
                    $modelOwnerJawab->npwp = $dataPenanggujawab['npwp'];
                    $modelOwnerJawab->phone_number = $dataPenanggujawab['phone_number'];
                    $modelOwnerJawab->store_id = $model->id;
                    $modelOwnerJawab->type = '20';
                    if ($modelOwnerJawab->save(false)) {
                        echo "sip";
                    } else {
                        $successFlag = false;
                        var_dump('xxx');
                        die;
                    }
                } else {
                    $successFlag = false;
                    var_dump('yy');
                    die;
                }



                $modelBank->bank_id = $dataInfoBank['bank_id'];
                $modelBank->number = $dataInfoBank['number'];
                $modelBank->name = $dataInfoBank['name'];
                $modelBank->store_id = $model->id;
                $modelBank->status_id = '2';
                $modelBank->save(false);

                $documents = [];



                $logo = UploadedFile::getInstance($modelFile, 'logo');
                $banner = UploadedFile::getInstance($modelFile, 'banner');
                $ktp = UploadedFile::getInstance($modelFile, 'ktp');
                $npwpfile = UploadedFile::getInstance($modelFile, 'npwpfile');
                $butab = UploadedFile::getInstance($modelFile, 'butab');
                $skumkm = UploadedFile::getInstance($modelFile, 'skumkm');
                $akta = UploadedFile::getInstance($modelFile, 'akta');
                $aktaprb = UploadedFile::getInstance($modelFile, 'aktaprb');
                $siup = UploadedFile::getInstance($modelFile, 'siup');
                $tdp = UploadedFile::getInstance($modelFile, 'tdp');
                $nib = UploadedFile::getInstance($modelFile, 'nib');
                $kbli = UploadedFile::getInstance($modelFile, 'kbli');
                $pkp = UploadedFile::getInstance($modelFile, 'pkp');
                $skb = UploadedFile::getInstance($modelFile, 'skb');
                $npwpbu = UploadedFile::getInstance($modelFile, 'npwpbu');
                $bpt = UploadedFile::getInstance($modelFile, 'bpt');

                if (
                    !isset($logo->name) &&
                    !isset($banner->name) &&
                    !isset($ktp->name) &&
                    !isset($npwpfile->name) &&
                    !isset($butab->name) &&
                    !isset($skumkm->name) &&
                    !isset($akta->name) &&
                    !isset($aktaprb->name) &&
                    !isset($siup->name) &&
                    !isset($tdp->name) &&
                    !isset($nib->name) &&
                    !isset($kbli->name) &&
                    !isset($pkp->name) &&
                    !isset($skb->name) &&
                    !isset($npwpbu->name) &&
                    !isset($bpt->name)
                ) {
                    $transaction->rollBack();
                    \Yii::$app->session->setFlash('warning', 'Minimal ada 1 dokumen yang diupload');

                    return $this->redirect('info-doc');
                }



                if (isset($logo->name)) {
                    $saveName = CodeUtility::saveImages($logo);
                    $modelStoreFile = new StoreFile();
                    $modelStoreFile->storefile = $saveName;
                    $modelStoreFile->store_id = $model->id;
                    $modelStoreFile->file_category = StoreFile::LOGO;
                    if ($modelStoreFile->save()) {
                    } else {
                        $successFlag = false;
                    }

                    $documents = array(
                        array(
                            'id' => '1',
                            'number' => '1',
                            'type' => 'LOGO'
                        )
                    );
                }

                if (isset($banner->name)) {
                    $saveName = CodeUtility::saveImages($banner);
                    $modelStoreFile = new StoreFile();
                    $modelStoreFile->storefile = $saveName;
                    $modelStoreFile->store_id = $model->id;
                    $modelStoreFile->file_category = StoreFile::BANNER;
                    if ($modelStoreFile->save()) {
                    } else {
                        $successFlag = false;
                    }

                    $documents = array(
                        array(
                            'id' => '2',
                            'number' => '2',
                            'type' => 'BANNER'
                        )
                    );
                }

                if (isset($ktp->name)) {
                    $saveName = CodeUtility::saveFiles($ktp);
                    $modelStoreFile = new StoreFile();
                    $modelStoreFile->storefile = $saveName;
                    $modelStoreFile->store_id = $model->id;
                    $modelStoreFile->file_category = StoreFile::KTP;
                    if ($modelStoreFile->save()) {
                    } else {
                        $successFlag = false;
                    }

                    $documents = array(
                        array(
                            'id' => '3',
                            'number' => '3',
                            'type' => 'KTP'
                        )
                    );
                }

                if (isset($npwpfile->name)) {
                    $saveName = CodeUtility::saveFiles($npwpfile);
                    $modelStoreFile = new StoreFile();
                    $modelStoreFile->storefile = $saveName;
                    $modelStoreFile->store_id = $model->id;
                    $modelStoreFile->file_category = StoreFile::NPWP;
                    if ($modelStoreFile->save()) {
                    } else {
                        $successFlag = false;
                    }

                    $documents = array(
                        array(
                            'id' => '4',
                            'number' => '4',
                            'type' => 'NPWP'
                        )
                    );
                }


                if (isset($butab->name)) {
                    $saveName = CodeUtility::saveFiles($butab);
                    $modelStoreFile = new StoreFile();
                    $modelStoreFile->storefile = $saveName;
                    $modelStoreFile->store_id = $model->id;
                    $modelStoreFile->file_category = StoreFile::BUTAB;
                    if ($modelStoreFile->save()) {
                    } else {
                        $successFlag = false;
                    }

                    $documents = array(
                        array(
                            'id' => '5',
                            'number' => '5',
                            'type' => 'BUKU TABUNGAN'
                        )
                    );
                }


                if (isset($skumkm->name)) {
                    $saveName = CodeUtility::saveFiles($skumkm);
                    $modelStoreFile = new StoreFile();
                    $modelStoreFile->storefile = $saveName;
                    $modelStoreFile->store_id = $model->id;
                    $modelStoreFile->file_category = StoreFile::SKUMKM;
                    if ($modelStoreFile->save()) {
                    } else {
                        $successFlag = false;
                    }

                    $documents = array(
                        array(
                            'id' => '6',
                            'number' => '6',
                            'type' => 'SKU'
                        )
                    );
                }

                if (isset($akta->name)) {
                    $saveName = CodeUtility::saveFiles($akta);
                    $modelStoreFile = new StoreFile();
                    $modelStoreFile->storefile = $saveName;
                    $modelStoreFile->store_id = $model->id;
                    $modelStoreFile->file_category = StoreFile::AKTA;
                    if ($modelStoreFile->save()) {
                    } else {
                        $successFlag = false;
                    }

                    $documents = array(
                        array(
                            'id' => '7',
                            'number' => '7',
                            'type' => 'AKTA'
                        )
                    );
                }


                if (isset($aktaprb->name)) {
                    $saveName = CodeUtility::saveFiles($aktaprb);
                    $modelStoreFile = new StoreFile();
                    $modelStoreFile->storefile = $saveName;
                    $modelStoreFile->store_id = $model->id;
                    $modelStoreFile->file_category = StoreFile::AKTAPRB;
                    if ($modelStoreFile->save()) {
                    } else {
                        $successFlag = false;
                    }

                    $documents = array(
                        array(
                            'id' => '8',
                            'number' => '8',
                            'type' => 'AKTA PERUBAHAN'
                        )
                    );
                }


                if (isset($siup->name)) {
                    $saveName = CodeUtility::saveFiles($siup);
                    $modelStoreFile = new StoreFile();
                    $modelStoreFile->storefile = $saveName;
                    $modelStoreFile->store_id = $model->id;
                    $modelStoreFile->file_category = StoreFile::SIUP;
                    if ($modelStoreFile->save()) {
                    } else {
                        $successFlag = false;
                    }

                    $documents = array(
                        array(
                            'id' => '9',
                            'number' => '9',
                            'type' => 'SIUP'
                        )
                    );
                }


                if (isset($tdp->name)) {
                    $saveName = CodeUtility::saveFiles($tdp);
                    $modelStoreFile = new StoreFile();
                    $modelStoreFile->storefile = $saveName;
                    $modelStoreFile->store_id = $model->id;
                    $modelStoreFile->file_category = StoreFile::TDP;
                    if ($modelStoreFile->save()) {
                    } else {
                        $successFlag = false;
                    }

                    $documents = array(
                        array(
                            'id' => '10',
                            'number' => '10',
                            'type' => 'TDP'
                        )
                    );
                }


                if (isset($nib->name)) {
                    $saveName = CodeUtility::saveFiles($nib);
                    $modelStoreFile = new StoreFile();
                    $modelStoreFile->storefile = $saveName;
                    $modelStoreFile->store_id = $model->id;
                    $modelStoreFile->file_category = StoreFile::NIB;
                    if ($modelStoreFile->save()) {
                    } else {
                        $successFlag = false;
                    }

                    $documents = array(
                        array(
                            'id' => '11',
                            'number' => '11',
                            'type' => 'NIB'
                        )
                    );
                }


                if (isset($kbli->name)) {
                    $saveName = CodeUtility::saveFiles($kbli);
                    $modelStoreFile = new StoreFile();
                    $modelStoreFile->storefile = $saveName;
                    $modelStoreFile->store_id = $model->id;
                    $modelStoreFile->file_category = StoreFile::KBLI;
                    if ($modelStoreFile->save()) {
                    } else {
                        $successFlag = false;
                    }

                    $documents = array(
                        array(
                            'id' => '12',
                            'number' => '12',
                            'type' => 'KBLI'
                        )
                    );
                }


                if (isset($pkp->name)) {
                    $saveName = CodeUtility::saveFiles($pkp);
                    $modelStoreFile = new StoreFile();
                    $modelStoreFile->storefile = $saveName;
                    $modelStoreFile->store_id = $model->id;
                    $modelStoreFile->file_category = StoreFile::PKP;
                    if ($modelStoreFile->save()) {
                    } else {
                        $successFlag = false;
                    }

                    $documents = array(
                        array(
                            'id' => '13',
                            'number' => '13',
                            'type' => 'PKP'
                        )
                    );
                }


                if (isset($skb->name)) {
                    $saveName = CodeUtility::saveFiles($skb);
                    $modelStoreFile = new StoreFile();
                    $modelStoreFile->storefile = $saveName;
                    $modelStoreFile->store_id = $model->id;
                    $modelStoreFile->file_category = StoreFile::SKB;
                    if ($modelStoreFile->save()) {
                    } else {
                        $successFlag = false;
                    }

                    $documents = array(
                        array(
                            'id' => '14',
                            'number' => '14',
                            'type' => 'SKB'
                        )
                    );
                }


                if (isset($npwpbu->name)) {
                    $saveName = CodeUtility::saveFiles($npwpbu);
                    $modelStoreFile = new StoreFile();
                    $modelStoreFile->storefile = $saveName;
                    $modelStoreFile->store_id = $model->id;
                    $modelStoreFile->file_category = StoreFile::NPWPBU;
                    if ($modelStoreFile->save()) {
                    } else {
                        $successFlag = false;
                    }

                    $documents = array(
                        array(
                            'id' => '15',
                            'number' => '15',
                            'type' => 'NPWP BADAN USAHA'
                        )
                    );
                }


                if (isset($bpt->name)) {
                    $saveName = CodeUtility::saveFiles($bpt);
                    $modelStoreFile = new StoreFile();
                    $modelStoreFile->storefile = $saveName;
                    $modelStoreFile->store_id = $model->id;
                    $modelStoreFile->file_category = StoreFile::BPT;
                    if ($modelStoreFile->save()) {
                    } else {
                        $successFlag = false;
                    }

                    $documents = array(
                        array(
                            'id' => '16',
                            'number' => '16',
                            'type' => 'BPT'
                        )
                    );
                }


                if ($successFlag) {
                    $transaction->commit();
                    \Yii::$app->session->setFlash('success', 'Data Berhasil Disimpan. Data Anda Akan Diverifikasi Admin Terlebih Dahulu Oleh Admin. Info Selanjutnya Akan Diberitahukan Melalui Email Terdaftar.');

                    $district = Districts::findOne(['id' => $dataInfoAlamat['districts_id']]);
                    $subdisctrict = Subdistrict::findOne(['id' => $dataInfoAlamat['subdistrict_id']]);
                    $masterBank = MasterBank::findOne(['id' => $dataInfoBank['bank_id']]);
                    // date_default_timezone_set('UTC');
                    $data = [
                        'endpoint' => ['idpenjual' => $model->id],
                        'json' => array(
                            'createdMerchant' => array(
                                'merchantInfo' => array(
                                    'name' => $dataInfoUsaha['store_name'],
                                    'rating' => 0,
                                    'regionId' => $district->id_dikbud,
                                    'npwp' => str_replace('-', '', str_replace('.', '', $dataInfoUsaha['npwp'])),
                                    'address' => $dataInfoAlamat['address'] . ', ' . $district->name,
                                    'kecamatan' => $subdisctrict->name,
                                    'postalCode' => $dataInfoAlamat['postal_code'],
                                    'locationLat' => $dataInfoLatLot['latitude'],
                                    'locationLong' => $dataInfoLatLot['longtitude'],
                                    'phone' => $dataPenanggujawab['phone_number'],
                                    'email' => $dataInfoUsaha['public_email'],
                                    'bankAccName' => $masterBank['name'],
                                    'bankAccNum' => $dataInfoBank['number'],
                                    'bankAccOwner' => $dataInfoBank['name'],
                                    'legalStatus' => 2,
                                    'exclusiveInfo' => array(
                                        'individual' => array(
                                            'nik' => $dataPenanggujawab['nik']
                                        )
                                    ),
                                    'isUmkm' => ($dataInfoUsaha['kategori_usaha'] != 11) ? true : false,
                                    'merchantStatus' => 0
                                ),
                                'documents' => $documents,
                                'client' => [
                                    'userAgent' => \Yii::$app->request->getUserAgent(),
                                    'ipAddress' => \Yii::$app->request->getUserIp()
                                ],
                                'occurredAt' => date('Y-m-d\TH:i:s\Z', strtotime(date('Y-m-d H:i:s') . ' -7 hour'))
                            ),
                            'sentAt' => date('Y-m-d\TH:i:s\Z', strtotime(date('Y-m-d H:i:s') . ' -7 hour'))
                        ),
                    ];

                    $message = 'Buat Penjual';
                    Activity::logBuatPenjual($message, $data);

                    return $this->redirect('end');
                } else {
                    $transaction->rollBack();
                    \Yii::$app->session->setFlash('warning', 'Terdapat Kesalahan. Pastikan Inputan Anda');
                    return $this->redirect('end');
                }
            }
        }

        if ($dataInfoPengguna['seller_type'] == '1') {
            return $this->render('info-doc-individu', [
                'modelFile' => $modelFile,
                'dataInfoPengguna' => $dataInfoPengguna,
                'dataInfoUsaha' => $dataInfoUsaha,
                'dataTtd' => $dataTtd,
                'dataPenanggujawab' => $dataPenanggujawab,
                'dataInfoAlamat' => $dataInfoAlamat,
                'dataInfoLatLot' => $dataInfoLatLot,
                'dataInfoBank' => $dataInfoBank,
                'dataInfoWilJual' => $dataInfoWilJual

            ]);
        } else {
            return $this->render('info-doc-corporate', [
                'modelFile' => $modelFile,
                'dataInfoPengguna' => $dataInfoPengguna,
                'dataInfoUsaha' => $dataInfoUsaha,
                'dataTtd' => $dataTtd,
                'dataPenanggujawab' => $dataPenanggujawab,
                'dataInfoAlamat' => $dataInfoAlamat,
                'dataInfoLatLot' => $dataInfoLatLot,
                'dataInfoBank' => $dataInfoBank,
                'dataInfoWilJual' => $dataInfoWilJual

            ]);
        }
    }


    public function actionEnd()
    {

        return $this->render('end');
    }


    public function actionKekayaanKategori()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $rangeKekayaan = $parents[0];
                $out = MasterKekayaanCat::getCat($rangeKekayaan);

                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionTestUpload()
    {
        $modelFile = new \yii\base\DynamicModel([
            'logo', 'banner', 'ktp', 'npwpfile', 'butab', 'skumkm', 'nib', 'skb', 'npwpbu', 'bpt'
        ]);

        $logo = UploadedFile::getInstance($modelFile, 'logo');
        if (isset($logo->name)) {
            $saveName = CodeUtility::saveImages($logo);
            // $modelStoreFile = new StoreFile();
            // $modelStoreFile->storefile = $saveName;
            // $modelStoreFile->store_id = $model->id;
            // $modelStoreFile->file_category = StoreFile::LOGO;
            if ($saveName) {
                echo print_r($logo);
            } else {
                echo "failed";
            }
        }

        $banner = UploadedFile::getInstance($modelFile, 'banner');
        if (isset($banner->name)) {
            $saveName = CodeUtility::saveImages($banner);
            if ($saveName) {
                echo print_r($banner);
            } else {
                echo "failed";
            }
        }

        $ktp = UploadedFile::getInstance($modelFile, 'ktp');
        if (isset($ktp->name)) {
            $saveName = CodeUtility::saveFiles($ktp);
            if ($saveName) {
                echo print_r($ktp);
            } else {
                echo "failed";
            }
        }

        $npwpfile = UploadedFile::getInstance($modelFile, 'npwpfile');
        if (isset($npwpfile->name)) {
            $saveName = CodeUtility::saveFiles($npwpfile);
            if ($saveName) {
                echo print_r($npwpfile);
            } else {
                echo "failed";
            }
        }

        $butab = UploadedFile::getInstance($modelFile, 'butab');
        if (isset($butab->name)) {
            $saveName = CodeUtility::saveFiles($butab);
            if ($saveName) {
                echo print_r($butab);
            } else {
                echo "failed";
            }
        }

        $skumkm = UploadedFile::getInstance($modelFile, 'skumkm');
        if (isset($skumkm->name)) {
            $saveName = CodeUtility::saveFiles($skumkm);
            if ($saveName) {
                echo print_r($skumkm);
            } else {
                echo "failed";
            }
        }

        $akta = UploadedFile::getInstance($modelFile, 'akta');
        if (isset($akta->name)) {
            $saveName = CodeUtility::saveFiles($akta);
            if ($saveName) {
                echo print_r($akta);
            } else {
                echo "failed";
            }
        }

        $aktaprb = UploadedFile::getInstance($modelFile, 'aktaprb');
        if (isset($aktaprb->name)) {
            $saveName = CodeUtility::saveFiles($aktaprb);
            if ($saveName) {
                echo print_r($aktaprb);
            } else {
                echo "failed";
            }
        }

        $siup = UploadedFile::getInstance($modelFile, 'siup');
        if (isset($siup->name)) {
            $saveName = CodeUtility::saveFiles($siup);
            if ($saveName) {
                echo print_r($siup);
            } else {
                echo "failed";
            }
        }

        $tdp = UploadedFile::getInstance($modelFile, 'tdp');
        if (isset($tdp->name)) {
            $saveName = CodeUtility::saveFiles($tdp);
            if ($saveName) {
                echo print_r($tdp);
            } else {
                echo "failed";
            }
        }

        $nib = UploadedFile::getInstance($modelFile, 'nib');
        if (isset($nib->name)) {
            $saveName = CodeUtility::saveFiles($nib);
            if ($saveName) {
                echo print_r($nib);
            } else {
                echo "failed";
            }
        }

        $kbli = UploadedFile::getInstance($modelFile, 'kbli');
        if (isset($kbli->name)) {
            $saveName = CodeUtility::saveFiles($kbli);
            if ($saveName) {
                echo print_r($kbli);
            } else {
                echo "failed";
            }
        }

        $pkp = UploadedFile::getInstance($modelFile, 'pkp');
        if (isset($pkp->name)) {
            $saveName = CodeUtility::saveFiles($pkp);
            if ($saveName) {
                echo print_r($pkp);
            } else {
                echo "failed";
            }
        }

        $skb = UploadedFile::getInstance($modelFile, 'skb');
        if (isset($skb->name)) {
            $saveName = CodeUtility::saveFiles($skb);
            if ($saveName) {
                echo print_r($skb);
            } else {
                echo "failed";
            }
        }

        $npwpbu = UploadedFile::getInstance($modelFile, 'npwpbu');
        if (isset($npwpbu->name)) {
            $saveName = CodeUtility::saveFiles($npwpbu);
            if ($saveName) {
                echo print_r($npwpbu);
            } else {
                echo "failed";
            }
        }

        $bpt = UploadedFile::getInstance($modelFile, 'bpt');
        if (isset($bpt->name)) {
            $saveName = CodeUtility::saveFiles($bpt);
            if ($saveName) {
                echo print_r($bpt);
            } else {
                echo "failed";
            }
        }

        return $this->render('test-upload', [
            'modelFile' => $modelFile,

        ]);
    }
}
