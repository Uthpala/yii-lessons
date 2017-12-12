<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comments".
 *
 * @property integer $id
 * @property string $body
 * @property integer $thread_id
 *
 * @property Threads $thread
 */
class Comments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['body'], 'string'],
            [['thread_id'], 'integer'],
            [['thread_id'], 'exist', 'skipOnError' => true, 'targetClass' => Threads::className(), 'targetAttribute' => ['thread_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'body' => 'Body',
            'thread_id' => 'Thread ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getThread()
    {
        return $this->hasOne(Threads::className(), ['id' => 'thread_id']);
    }

    public function getReplies()
    {
        return $this->hasMany(Reply::className(), ['comment_id' => 'id']);
    }

}
