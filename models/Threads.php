<?php

namespace app\models;

use Yii;

use app\models\ThreadImages;
use app\models\Comments;
/**
 * This is the model class for table "threads".
 *
 * @property integer $id
 * @property string $title
 * @property string $body
 */
class Threads extends \yii\db\ActiveRecord
{
    public $threadImages;
    public $comment;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'threads';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title','body'],'required'],
            [['body'], 'string'],
            [['threadImages'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 4],
            [['title','user_id'], 'string', 'max' => 255],
        ];
    }

    public function getImages()
    {
        return $this->hasMany(ThreadImages::className(), ['thread_id' => 'id']);
    }

    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['thread_id' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => Yii::t('app','Title'),
            'body' => 'Body',
        ];
    }

    public function upload()
    {
        if ($this->validate()) { 
            foreach ($this->threadImages as $file) {
                $imagePath = 'uploads/' . uniqid() . '.' . $file->extension;
                $file->saveAs($imagePath);
                // save this to the thread images tables 
                $threadImageModel = new ThreadImages();
                $threadImageModel->thread_id = $this->id;
                $threadImageModel->image_path = $imagePath;
                $threadImageModel->save();
            }
            return true;
        } else {
            return false;
        }
    }

    public function belongsToLoggedInUser(){
        if( $this->user_id === Yii::$app->user->identity->id ){
            return true;
        }
        return false;
    }

    public static function getFirstThread($id){
        return  Threads::findOne($id);
    }

}
