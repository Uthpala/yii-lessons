<?php
namespace app\controllers;

use yii\rest\ActiveController;

class RestController extends ActiveController {

    public $modelClass = 'app\models\Threads';

    public function actions()
    {
        $actions = parent::actions();
        return $actions;
    }

    public function actionIndex(){
        die('okay');
    }

    public function actionChart(){
        die('chart data');
    }
}