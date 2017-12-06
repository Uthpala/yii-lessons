<?php
namespace app\rbac;

use yii\rbac\Rule;
use app\models\Comment;

/**
 * Checks if authorID matches user passed via params
 */
class CommenterRule extends Rule
{
    public $name = 'isCommenter';

    /**
     * @param string|int $user the user ID.
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return bool a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
        return isset($params['comment']) ? $params['comment']->user_id == $user : false;
    }
}
