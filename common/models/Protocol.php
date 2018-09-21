<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "protocol".
 *
 * @property int $id
 * @property string $sds
 * @property string $number_protocol
 * @property string $issue_date
 * @property string $testing_laboratory_info
 * @property string $product_information
 * @property string $manufacturer_information
 * @property string $applicant_information
 * @property int $is_valid
 * @property int $user_id
 */
class Protocol extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'protocol';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['testing_laboratory_info', 'product_information', 'manufacturer_information', 'applicant_information'], 'string'],
            [['sds', 'issue_date','user_id'], 'safe'],
            [['is_valid'], 'integer'],
            [['number_protocol'], 'string', 'max' => 255],
        ];
    }
    public function beforeValidate()
    {
        if (is_array($this->sds)) {
            $this->sds = serialize($this->sds);
        }
        return parent::beforeValidate();
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sds' => 'СДС   ',
            'number_protocol' => 'Номер протокола',
            'issue_date' => 'Дата выдачи протокола',
            'testing_laboratory_info' => 'Сведения об испытательной лаборатори',
            'product_information' => 'Сведения о продукции',
            'manufacturer_information' => 'Информация о изготовителе',
            'applicant_information' => 'Информация о заявителе',
            'is_valid' => 'Соответствует требованиям',
            'user_id' => 'Клиент',
        ];
    }

    public function afterFind()
    {
        $this->sds = unserialize($this->sds);
        return parent::afterFind();
    }

    public function beforeSave($insert)
    {
        $this->user_id = Yii::$app->user->id;
        return parent::beforeSave($insert);
    }
}
