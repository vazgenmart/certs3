<?php

namespace frontend\controllers;

use common\models\Certificate;
use common\models\Organizations;
use common\models\Protocol;
use common\models\Settings;
use frontend\models\Search;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use common\models\SignupForm;
use frontend\models\ContactForm;

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
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'new';
        $model = new Search();
        $text = Settings::find()->where(['key' => 'Text'])->one();
        return $this->render('index',['model' => $model,'text' => $text]);
    }

    public function actionSearch()
    {
      $model = new Search();
      if($model->load(Yii::$app->request->post()) && $model->validate()){
          $res = Protocol::find()->where(['number_protocol'=>$model->term])->andWhere(['issue_date' =>$model->date])->all();
        return $this->renderAjax('_table',['res' => $res]);
      }

    }


}
