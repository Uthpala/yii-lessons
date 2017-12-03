<?php

use yii\db\Migration;

/**
 * Class m171202_095234_add_image_path_url_to_thread
 */
class m171202_095234_add_image_path_url_to_thread extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('threads', 'thread_image', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m171202_095234_add_image_path_url_to_thread cannot be reverted.\n";
        $this->dropColumn('threads', 'thread_image', $this->string());
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171202_095234_add_image_path_url_to_thread cannot be reverted.\n";

        return false;
    }
    */
}
