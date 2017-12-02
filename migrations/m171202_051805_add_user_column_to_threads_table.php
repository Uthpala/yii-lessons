<?php

use yii\db\Migration;

/**
 * Handles adding user to table `threads`.
 */
class m171202_051805_add_user_column_to_threads_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('threads', 'user_id', $this->integer());

        $this->createIndex(
            'idx-threads_user_id',
            'threads',
            'user_id'
        );

        // add foreign key for table `post`
        $this->addForeignKey(
            'fk-user_id',
            'threads',
            'user_id',
            'user',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey(
            'fk-user_id',
            'threads'
        );
        $this->dropIndex(
            'idx-threads_user_id',
            'threads',
            'user_id'
        );

        $this->dropColumn('threads', 'user_id', $this->integer());
    }
}
