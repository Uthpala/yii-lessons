<?php

use yii\db\Migration;

/**
 * Handles the creation of table `reply`.
 */
class m171207_180748_create_reply_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('reply', [
            'id' => $this->primaryKey(),
            'comment_id' => $this->integer(), 
            'thread_id' => $this->integer(), 
            'reply' => $this->string()
        ]);

        $this->createIndex(
            'idx-reply_comment_id',
            'reply',
            'comment_id'
        );

        $this->createIndex(
            'idx-reply_thread_id',
            'reply',
            'thread_id'
        );

        $this->addForeignKey(
            'fk-reply-comment_id',
            'reply',
            'comment_id',
            'comments',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-reply-thread_id',
            'reply',
            'thread_id',
            'threads',
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
        $this->dropTable('reply');
    }
}
