<?php

use yii\db\Migration;

/**
 * Handles adding user_role to table `keys_user`.
 */
class m171108_193319_add_user_role_column_to_keys_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('keys_user', 'role', $this->string(64));
        $this->update('keys_user', ['role' => 'user']);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('keys_user', 'role');
    }
}
