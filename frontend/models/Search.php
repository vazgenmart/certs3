<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class Search extends Model
{
    public $term;
    public $date;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['term', 'date'], 'required','message' => "{attribute} Не Заполнин"],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'term' => 'Номер',
            'date' => 'Дата',
        ];
    }


}
