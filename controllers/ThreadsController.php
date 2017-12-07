<?php

namespace app\controllers;

use Yii;
use app\models\Threads;
use app\models\Comments;
use app\models\ThreadsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ThreadsController implements the CRUD actions for Threads model.
 */
class ThreadsController extends Controller
{
    /**
     * @inheritdoc
     */
     public $enableCsrfValidation = false;

     public static function allowedDomains() {
         return [
             '*',
             'http://localhost:3000'
         ];
     }

    public function behaviors()
    {
      return array_merge(parent::behaviors(), [
          'corsFilter'  => [
              'class' => \yii\filters\Cors::className(),
              'cors'  => [
                  'Origin'                           => static::allowedDomains(),
                  'Access-Control-Request-Method'    => ['POST'],
                  'Access-Control-Allow-Credentials' => true,
                  'Access-Control-Max-Age'           => 3600,                 // Cache (seconds)
              ],
          ],

      ]);
    }

    /**
     * Lists all Threads models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ThreadsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Threads model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $comments = new Comments();
        $comments->thread_id = $id;


        return $this->render('view', [
            'model' => $this->findModel($id),
            'comments' => $comments
        ]);
    }

    /**
     * Creates a new Threads model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if( Yii::$app->user->can('createThread') ){
            $model = new Threads();
            if ($model->load(Yii::$app->request->post())) {
                $model->user_id = Yii::$app->user->identity->id;
                $model->threadImages = UploadedFile::getInstances($model, 'threadImages');
                $model->save();
                $model->upload();
                return $this->redirect(['index']);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }else{
            die('you cant do this');
        }

    }

    /**
     * Updates an existing Threads model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (\Yii::$app->user->can('updateThread', ['thread' => $model])) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }

        die('you are not allowed to update this thread');
    }

    /**
     * Deletes an existing Threads model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if( Yii::$app->user->identity->id === $model->user_id ){
            $model->delete();
            return $this->redirect(['index']);
        }else{
            die('You are not allowed to delete this');
        }
    }

    /**
     * Finds the Threads model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Threads the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Threads::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
