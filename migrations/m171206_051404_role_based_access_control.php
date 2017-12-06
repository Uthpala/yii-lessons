<?php

use yii\db\Migration;

/**
 * Class m171206_051404_role_based_access_control
 */
class m171206_051404_role_based_access_control extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $createThread = $auth->createPermission('createThread');
        $createThread->description = 'Create a thread';
        $auth->add($createThread);

        $updateThread = $auth->createPermission('updateThread');
        $updateThread->description = 'Update thread';
        $auth->add($updateThread);

        $createComment = $auth->createPermission('createComment');
        $createComment->description = 'create Comment';
        $auth->add($createComment);

        $updateComment = $auth->createPermission('updateComment');
        $updateComment->description = 'Update Comment';
        $auth->add($updateComment);

        $author = $auth->createRole('author');
        $auth->add($author);
        $auth->addChild($author, $createThread);

        $commenter = $auth->createRole('commenter');
        $auth->add($commenter);
        $auth->addChild($commenter, $createComment);

        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $updateThread);
        $auth->addChild($admin, $updateComment);
        $auth->addChild($admin, $author);
        $auth->addChild($admin, $commenter);

        $auth->assign($author, 2);
        $auth->assign($admin, 3);
        $auth->assign($commenter, 4);

        $rule = new \app\rbac\AuthorRule;
        $auth->add($rule);
        
        $updateOwnThread = $auth->createPermission('updateOwnThread');
        $updateOwnThread->description = 'Update own thread';
        $updateOwnThread->ruleName = $rule->name;
        $auth->add($updateOwnThread);
        
        $auth->addChild($updateOwnThread, $updateThread);
        $auth->addChild($author, $updateOwnThread);
        
        // Create the commenter rule 
        $ruleCommenter = new \app\rbac\CommenterRule;
        $auth->add($ruleCommenter); 

        $updateOwnComment = $auth->createPermission('updateOwnComment');
        $updateOwnComment->description = 'Update own Comment';
        $updateOwnComment->ruleName = $ruleCommenter->name;
        $auth->add($updateOwnComment);

        // add updateComment as a child of updateOwnComment
        $auth->addChild($updateOwnComment, $updateComment);
        $auth->addChild($commenter, $updateOwnComment);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171206_051404_role_based_access_control cannot be reverted.\n";

        return false;
    }
    */
}
