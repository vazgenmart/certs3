<?php

use yii\db\Migration;

/**
 * Handles the creation of table `organizations`.
 */
class m180917_113728_create_protocol_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('protocol', [
            'id' => $this->primaryKey(),
            'sds' => $this->text(),
            'number_protocol' => $this->string(),
            'issue_date' => $this->date(),
            'testing_laboratory_info' => $this->text(),
            'product_information' => $this->text(),
            'manufacturer_information' => $this->text(),
            'applicant_information' => $this->text(),
            'is_valid' => $this->boolean()->defaultValue(false)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('protocol');
    }
}
