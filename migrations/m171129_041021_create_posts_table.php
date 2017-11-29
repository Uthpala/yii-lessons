<?php

use yii\db\Migration;

/**
 * Handles the creation of table `posts`.
 */
class m171129_041021_create_posts_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('posts', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'content' => $this->text(),
            'author_id' => $this->integer()->notNull()
        ]);

        $this->addForeignKey(
            'fk-posts-author_id',
            'posts',
            'author_id',
            'users',
            'id'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('posts');
    }
}
