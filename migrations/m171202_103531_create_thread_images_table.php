<?php

use yii\db\Migration;

/**
 * Handles the creation of table `thread_images`.
 */
class m171202_103531_create_thread_images_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('thread_images', [
            'id' => $this->primaryKey(),
            'image_path' => $this->string(),
            'thread_id' => $this->integer()
        ]);

        $this->createIndex(
            'idx-thread_images_id',
            'thread_images',
            'thread_id'
        );

        // add foreign key for table `post`
        $this->addForeignKey(
            'fk-thread_id',
            'thread_images',
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
        $this->dropTable('thread_images');
    }
}
