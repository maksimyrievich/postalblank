<?php

use yii\db\Migration;

/**
 * Handles adding firstname to table `user`.
 */
class m170717_191638_add_firstname_column_to_keys_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('keys_user', 'firstname', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('keys_user', 'firstname');
    }
}
