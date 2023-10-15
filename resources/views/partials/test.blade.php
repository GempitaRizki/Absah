<?php

namespace common\models;

use common\commands\AddToTimelineCommand;
use common\models\query\UserQuery;
use Yii;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $email
 * @property string $auth_key
 * @property string $access_token
 * @property string $oauth_client
 * @property string $oauth_client_user_id
 * @property string $publicIdentity
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $logged_at
 * @property string $password write-only password
 *
 * @property \common\models\UserProfile $userProfile
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_NOT_ACTIVE = 1;
    const STATUS_ACTIVE = 2;
    const STATUS_DELETED = 3;

    const ROLE_BUYER = 'buyer';
    const ROLE_MANAGER = 'manager';
    const ROLE_ADMINISTRATOR = 'administrator';
    const ROLE_OWNER_STORE = 'ownerStore';
    const ROLE_USER_STORE = 'userStore';

    const EVENT_AFTER_SIGNUP = 'afterSignup';
    const EVENT_AFTER_LOGIN = 'afterLogin';

    public $jabatan;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->on(self::EVENT_AFTER_INSERT, [$this, 'notifySignup']);
        $this->on(self::EVENT_AFTER_DELETE, [$this, 'notifyDeletion']);
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::find()
            ->active()
            ->andWhere(['id' => $id])
            ->one();
    }

    /**
     * @return UserQuery
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::find()
            ->active()
            ->andWhere(['access_token' => $token])
            ->one();
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return User|array|null
     */
    public static function findByUsername($username)
    {
        return static::find()
            ->active()
            ->andWhere(['username' => $username])
            ->one();
    }

    /**
     * Finds user by username or email
     *
     * @param string $login
     * @return User|array|null
     */
    public static function findByLogin($login)
    {
        return static::find()
            ->active()
            ->andWhere(['or', ['username' => $login], ['email' => $login]])
            ->one();
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            'auth_key' => [
                'class' => AttributeBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'auth_key'
                ],
                'value' => Yii::$app->getSecurity()->generateRandomString()
            ],
            'access_token' => [
                'class' => AttributeBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'access_token'
                ],
                'value' => function () {
                    return Yii::$app->getSecurity()->generateRandomString(40);
                }
            ]
        ];
    }

    /**
     * @return array
     */
    public function scenarios()
    {
        return ArrayHelper::merge(
            parent::scenarios(),
            [
                'oauth_create' => [
                    'oauth_client', 'oauth_client_user_id', 'email', 'username', '!status'
                ]
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email'], 'required'],
            [['email'], 'email'],
            [['email', 'username'], 'unique', 'targetAttribute' => ['email', 'username']],
            ['status', 'default', 'value' => self::STATUS_NOT_ACTIVE],
            ['status', 'in', 'range' => array_keys(self::statuses())],
            [['username'], 'filter', 'filter' => '\yii\helpers\Html::encode']
        ];
    }

    /**
     * Returns user statuses list
     * @return array|mixed
     */
    public static function statuses()
    {
        return [
            self::STATUS_NOT_ACTIVE => Yii::t('common', 'Not Active'),
            self::STATUS_ACTIVE => Yii::t('common', 'Active'),
            self::STATUS_DELETED => Yii::t('common', 'Deleted')
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('common', 'Username'),
            'email' => Yii::t('common', 'E-mail'),
            'status' => Yii::t('common', 'Status'),
            'access_token' => Yii::t('common', 'API access token'),
            'created_at' => Yii::t('common', 'Created at'),
            'updated_at' => Yii::t('common', 'Updated at'),
            'logged_at' => Yii::t('common', 'Last login'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProfile()
    {
        return $this->hasOne(UserProfile::class, ['user_id' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->getSecurity()->generatePasswordHash($password);
    }

    /**
     * Creates user profile and application event
     * @param array $profileData
     */
    public function afterSignup(array $profileData = [])
    {
        $this->refresh();
        $profile = new UserProfile();
        $profile->locale = Yii::$app->language;
        $profile->load($profileData, '');
        $this->link('userProfile', $profile);
        $this->trigger(self::EVENT_AFTER_SIGNUP);
        // Default role
        $auth = Yii::$app->authManager;
        $auth->assign($auth->getRole(User::ROLE_BUYER), $this->getId());
    }

    public function notifySignup($event)
    {
        $this->refresh();
        Yii::$app->commandBus->handle(new AddToTimelineCommand([
            'category' => 'user',
            'event' => 'signup',
            'data' => [
                'public_identity' => $this->getPublicIdentity(),
                'user_id' => $this->getId(),
                'created_at' => $this->created_at
            ]
        ]));
    }

    public function notifyDeletion($event)
    {
        Yii::$app->commandBus->handle(new AddToTimelineCommand([
            'category' => 'user',
            'event' => 'delete',
            'data' => [
                'public_identity' => $this->getPublicIdentity(),
                'user_id' => $this->getId(),
                'deleted_at' => time()
            ]
        ]));
    }

    /**
     * @return string
     */
    public function getPublicIdentity()
    {
        if ($this->userProfile && $this->userProfile->getFullname()) {
            return $this->userProfile->getFullname();
        }
        if ($this->username) {
            return $this->username;
        }
        return $this->email;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function jumlahPenggunaSeller()
    {
        $userId = \Yii::$app->user->identity->id;
        $storeId = Store::getStoreIdByUserLogin();

        $query = User::find()
            ->alias('u')
            ->join('JOIN', '{{%store_user}} AS su', 'su.user_id = u.id')
            ->where(['su.store_id' => $storeId])->count();

        return $query;
    }

    public function jumlahPenggunaSellerAktif()
    {
        $userId = \Yii::$app->user->identity->id;
        $storeId = Store::getStoreIdByUserLogin();

        $query = User::find()
            ->alias('u')
            ->join('JOIN', '{{%store_user}} AS su', 'su.user_id = u.id')
            ->where(['su.store_id' => $storeId, 'u.status' => '2'])->count();

        return $query;
    }

    public function jumlahPenggunaSellerTidakAktif()
    {
        $userId = \Yii::$app->user->identity->id;
        $storeId = Store::getStoreIdByUserLogin();

        $query = User::find()
            ->alias('u')
            ->join('JOIN', '{{%store_user}} AS su', 'su.user_id = u.id')
            ->where(['su.store_id' => $storeId, 'u.status' => '1'])->count();

        return $query;
    }

    public function totalUser()
    {
        $query = User::find()->count();

        return $query;
    }

    public function totalUserAktif()
    {
        $query = User::find()->where(['status' => User::STATUS_ACTIVE])->count();

        return $query;
    }

    public function totalUserBeku()
    {
        $query = User::find()->where(['status' => User::STATUS_NOT_ACTIVE])->count();

        return $query;
    }

    public function totalPengawas()
    {
        $query = User::find()
            ->join('LEFT JOIN', '{{%rbac_auth_assignment}} as rbac_auth_assignment', 'rbac_auth_assignment.user_id = id')
            ->where(['rbac_auth_assignment.item_name' => 'pengawas'])
            ->count();

        return $query;
    }

    public function totalPengawasAktif()
    {
        $query = User::find()
            ->join('LEFT JOIN', '{{%rbac_auth_assignment}} as rbac_auth_assignment', 'rbac_auth_assignment.user_id = id')
            ->where(['rbac_auth_assignment.item_name' => 'pengawas'])
            ->andWhere(['status' => User::STATUS_ACTIVE])
            ->count();

        return $query;
    }

    public function totalPengawasBeku()
    {
        $query = User::find()
            ->join('LEFT JOIN', '{{%rbac_auth_assignment}} as rbac_auth_assignment', 'rbac_auth_assignment.user_id = id')
            ->where(['rbac_auth_assignment.item_name' => 'pengawas'])
            ->andWhere(['status' => User::STATUS_NOT_ACTIVE])
            ->count();

        return $query;
    }

    public function totalPengguna()
    {
        $userId = \Yii::$app->user->identity->id;

        $userSekolah = UserSekolah::findOne(['user_id' => $userId, 'status' => '1']);
        $sekolahId = $userSekolah['sekolah_id'];

        $query = User::find()
            ->alias('u')
            ->select(['u.*', 'jabatan'])
            ->join('JOIN', '{{%user_sekolah}} as user_sekolah', 'user_sekolah.user_id = u.id')
            ->where(['user_sekolah.sekolah_id' => $sekolahId])
            ->distinct()
            ->count();

        return $query;
    }

    public function totalPenggunaAktif()
    {
        $userId = \Yii::$app->user->identity->id;

        $userSekolah = UserSekolah::findOne(['user_id' => $userId, 'status' => '1']);
        $sekolahId = $userSekolah['sekolah_id'];

        $query = User::find()
            ->alias('u')
            ->select(['u.*', 'jabatan'])
            ->join('JOIN', '{{%user_sekolah}} as user_sekolah', 'user_sekolah.user_id = u.id')
            ->where(['u.status' => User::STATUS_ACTIVE])
            ->andWhere(['user_sekolah.sekolah_id' => $sekolahId])
            ->distinct()
            ->count();

        return $query;
    }

    public function totalPenggunaBeku()
    {
        $userId = \Yii::$app->user->identity->id;

        $userSekolah = UserSekolah::findOne(['user_id' => $userId, 'status' => '1']);
        $sekolahId = $userSekolah['sekolah_id'];

        $query = User::find()
            ->alias('u')
            ->select(['u.*', 'jabatan'])
            ->join('JOIN', '{{%user_sekolah}} as user_sekolah', 'user_sekolah.user_id = u.id')
            ->where(['u.status' => User::STATUS_NOT_ACTIVE])
            ->andWhere(['user_sekolah.sekolah_id' => $sekolahId])
            ->distinct()
            ->count();

        return $query;
    }
}
