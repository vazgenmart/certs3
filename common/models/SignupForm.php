<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $action;
    public $username;
    public $name;
    public $surname;
    public $email;
    public $password;
    public $type;
    public $authority_certificate;
    public $body_data;
    public $active_from;
    public $active_to;

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['insert'] = ['action', 'username', 'name', 'surname', 'password', 'email', 'type', 'authority_certificate', 'body_data', 'active_from', 'active_to'];
        $scenarios['update'] = ['action', 'username', 'name', 'surname', 'password', 'email', 'type', 'authority_certificate', 'body_data', 'active_from', 'active_to'];
        return $scenarios;
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['action', 'type', 'name', 'surname', 'email', 'password', 'type', 'authority_certificate', 'body_data', 'active_from', 'active_to'], 'safe', 'on' => ['insert', 'update']],
            [['type', 'name', 'surname', 'email', 'password', 'type', 'authority_certificate', 'body_data', 'active_from', 'active_to'], 'required', 'on' => ['insert', 'update']],
            [['active_from', 'active_to'], 'customDateTimeValidate', 'skipOnEmpty' => false, 'on' => ['insert', 'update']],
            ['active_from', 'customDateTimeCompare', 'skipOnEmpty' => false, 'on' => ['insert', 'update']],
            ['active_to', 'customDateTimeCompare', 'skipOnEmpty' => false, 'on' => ['insert', 'update']],
            ['type', 'in', 'range' => [20, 30], 'on' => ['insert', 'update']],

            ['username', 'trim', 'on' => ['insert', 'update']],
            ['username', 'required', 'on' => ['insert', 'update']],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.', 'on' => 'insert'],
            ['username', 'string', 'min' => 2, 'max' => 255, 'on' => ['insert', 'update']],

            ['email', 'trim', 'on' => ['insert', 'update']],
            ['email', 'required', 'on' => ['insert', 'update']],
            ['email', 'email', 'on' => ['insert', 'update']],
            ['email', 'string', 'max' => 255, 'on' => ['insert', 'update']],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.', 'on' => 'insert'],

            ['password', 'required', 'on' => ['insert', 'update']],
            ['password', 'string', 'min' => 6, 'on' => ['insert', 'update']],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup($id = 0)
    {
        if (!$this->validate()) {
            return null;
        }

        $user = $id ? User::find()->where(['id' => $id])->one() : new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->status = $this->type;
        $user->name = $this->name;
        $user->surname = $this->surname;
        $user->active_from = $this->active_from;
        $user->active_to = $this->active_to;
        $user->authority_certificate = $this->authority_certificate;
        $user->body_data = $this->body_data;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        return $user->save() ? $user : null;
    }

    public function customDateTimeValidate($attribute){
        $date = date_create($this->$attribute);
        if(!$date){
            $this->addError($attribute, 'False date specified');
        }
    }

    public function customDateTimeCompare($attribute){
        $active_from = $date = date_create($this->active_from);
        $active_to = $date = date_create($this->active_to);

        if($active_from && $active_to){
            $active_from = date_format($active_from, 'U');
            $active_to = date_format($active_to, 'U');
            $this->active_from = $active_from;
            $this->active_to = $active_to;

            if($active_from >= $active_to){
                $this->addError($attribute, 'Active from date must be < active to date');
            }
        }
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'username' => 'Имя пользователя',
            'password' => 'Пароль',
            'email' => 'Email',
            'authority_certificate' => 'Аттестат лаборатории',
            'body_data' => 'Данные лаборатории',
            'active_from' => 'Действителен с',
            'active_to' => 'Действителен по',
            'type' => 'Тип'
        ];
    }
}
