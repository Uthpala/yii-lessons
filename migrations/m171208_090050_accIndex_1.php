<?php

use yii\db\Migration;

class m171208_090050_accIndex_1 extends Migration
{
    public function up()
    {
       
        $this->createTable('general', [
            'gen_id' => $this->primaryKey(),
            'acc_desc' => $this->varchar(40),
            'acc_type' => $this->integer(1)
        ]);
        
        $this->createTable('assistant', [
            'ass_id' => $this->primaryKey(),
            'gen_id' => $this->integer(),
            'ass_desc' => $this->varchar(40),
        ]); 
        
        $this->createTable('analytical', [
            'analys_id' => $this->primaryKey(),
            'gen_id' => $this->integer(),
            'ass_id' => $this->integer(),
            'analys_desc' => $this->varchar(40),
        ]);

    }

    public function down()
    {
        $this->dropTable('general');     
        $this->dropTable('assistant'); 
        $this->dropTable('analytical'); 
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171208_090050_accIndex_1 cannot be reverted.\n";

        return false;
    }
    */
}
