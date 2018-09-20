<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $name;
    public $surname;
    public $email;
    public $password;
    public $type;

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['insert'] = ['username', 'name', 'surname', 'password', 'email', 'type'];
        $scenarios['update'] = ['username', 'name', 'surname', 'password', 'email', 'type'];
        return $scenarios;
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'name', 'surname', 'email', 'password', 'type'], 'safe', 'on' => ['insert', 'update']],
            [['type', 'name', 'surname', 'email', 'password', 'type'], 'required', 'on' => ['insert', 'update']],
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

//        echo '<pre>';
//        print_r('Username '.$this->username.' Email '.$this->email.' Type'.$this->type); die;
        
        $user = $id ? User::find()->where(['id' => $id])->one() : new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->status = $this->type;
        $user->name = $this->name;
        $user->surname = $this->surname;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
}
