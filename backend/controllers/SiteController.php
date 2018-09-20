<?php
namespace backend\controllers;

use common\models\LoginForm;
use common\models\User;
use common\models\SignupForm;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use kartik\form\ActiveForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['create-user', 'update-user', 'users-list', 'delete-user', 'ajax-validation'],
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            if(!Yii::$app->user->isGuest){
                                return Yii::$app->user->identity->can(Yii::$app->controller->id,'');
                            }
                        }
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionUsersList(){
        $dataProvider = new ActiveDataProvider([
            'query' => User::find()->where(['!=', 'id',  Yii::$app->user->id]),
        ]);

        return $this->render('users-list', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect('/c_admin/settings/index');
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionCreateUser()
    {
        $model = new SignupForm();
        $model->scenario = 'insert';
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->redirect(['users-list']);
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionUpdateUser($id){

        $user = User::find()->where(['id' => $id])->one();
        $model = new SignupForm();
        $model->scenario = 'update';
        $model->username = $user->username;
        $model->name = $user->name;
        $model->surname = $user->surname;
        $model->type = $user->status;
        $model->email = $user->email;
        $model->active_from = $user->active_from;
        $model->active_to = $user->active_to;
        $model->authority_certificate = $user->authority_certificate;
        $model->body_data = $user->body_data;
        $model->password = '';

        if ($model->load(Yii::$app->request->post())) {
          //  if ($user = $model->signup($id)) {
           //     if (Yii::$app->getUser()->login($user)) {
                    return $this->redirect(['users-list']);
             //   }
           // }
        }

        return $this->render('signup', compact('model'));
    }

    public function actionDeleteUser($id){
        $user = User::find()->where(['id' => $id])->one();

        if($user->delete()){
            return $this->redirect('/c_admin/site/users-list');
        }
    }

    public function actionAjaxValidation()
    {
        $post = Yii::$app->request->post();
        $action = $post['SignupForm']['action'];
        $model = new SignupForm();
        $model->scenario = $action;

        $model->load($post);

        $array = ActiveForm::validate($model);

        return json_encode($array);
    }
}
