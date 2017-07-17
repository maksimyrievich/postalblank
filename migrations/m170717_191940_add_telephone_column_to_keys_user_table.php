<?php

use yii\db\Migration;

/**
 * Handles adding telephone to table `user`.
 */
class m170717_191940_add_telephone_column_to_keys_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('keys_user', 'telephone', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('keys_user', 'telephone');
    }
}
