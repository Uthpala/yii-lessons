<?php

use yii\db\Migration;

/**
 * Handles the creation of table `threads`.
 */
class m171202_044232_create_threads_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('threads', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('threads');
    }
}
