<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "thread_images".
 *
 * @property integer $id
 * @property string $image_path
 * @property integer $thread_id
 *
 * @property Threads $thread
 */
class ThreadImages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'thread_images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['thread_id'], 'integer'],
            [['image_path'], 'string', 'max' => 255],
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
            'image_path' => 'Image Path',
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
}
