<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $mobile
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $created_ip
 * @property string $updated_ip
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    public $password;
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
//    const ROLE_USER = 10;
//    const AUTH_KEY = '123456';
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
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];


/*
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
*/
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'mobile',/* 'auth_key', 'password_hash',*/ 'email'/*, 'created_at', 'updated_at'*/], 'required'],
            [['status','login','role','qq','updated_at','created_at'], 'integer'],
            [['username','name','mobile'], 'string', 'max' => 15],
            [[ /*'password_hash', 'password_reset_token',*/ 'email'], 'string', 'max' => 50],
            [['auth_key', 'updated_ip', 'created_ip'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['mobile'], 'unique'],
            [['email'], 'unique'],
            [['email'], 'email'],
//            [['qq'], 'unique'],
            [['password_reset_token'], 'unique'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],

        ];
    }



    public function attributeLabels()
    {
        return [
            'uid' => Yii::t('tbhome', 'Uid'),
            'username' => Yii::t('tbhome', 'Username'),
            'name' => Yii::t('tbhome', 'Name'),
            'mobile' => Yii::t('tbhome', 'Mobile'),
            'qq' => Yii::t('tbhome', 'Qq'),
            'email' => Yii::t('tbhome', 'Email'),
            'password_hash' => Yii::t('tbhome', '密码加密值'),
 //           'auth_key' => Yii::t('tbhome', 'Auth Key'),
            'status' => Yii::t('tbhome', 'Status'),
            'login' => Yii::t('tbhome', 'Login'),
 //           'password_reset_token' => Yii::t('tbhome', 'Password Reset Token'),
            'role' => Yii::t('tbhome', 'Role'),
            'created_ip' => Yii::t('tbhome', 'Created IP'),
            'updated_ip' => Yii::t('tbhome', 'Updated Ip'),
            'created_at' => Yii::t('tbhome', 'Created At'),
            'updated_at' => Yii::t('tbhome', 'Updated At'),
          'password' => Yii::t('tbhome', 'Password'),
        ];
    }


    /**
     * @inheritdoc
     */
    public static function findIdentity($uid)
    {
        return static::findOne(['uid' => $uid, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

}
