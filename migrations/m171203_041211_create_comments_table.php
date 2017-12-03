<?php

use yii\db\Migration;

/**
 * Handles the creation of table `comments`.
 */
class m171203_041211_create_comments_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('comments', [
            'id' => $this->primaryKey(),
            'body' => $this->text(),
            'thread_id' => $this->integer()
        ]);

        $this->createIndex(
            'idx-thread_comments_id',
            'comments',
            'thread_id'
        );

        // add foreign key for table `post`
        $this->addForeignKey(
            'fk-comment_id',
            'comments',
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
        $this->dropTable('comments');
    }
}
