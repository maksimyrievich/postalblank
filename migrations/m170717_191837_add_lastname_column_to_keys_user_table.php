<?php

use yii\db\Migration;

/**
 * Handles adding lastname to table `user`.
 */
class m170717_191837_add_lastname_column_to_keys_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('keys_user', 'lastname', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('keys_user', 'lastname');
    }
}
