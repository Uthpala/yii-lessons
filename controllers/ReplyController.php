<?php

namespace app\controllers;

use Yii;
use app\models\Reply;
use app\models\ReplySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Threads;
use yii\helpers\Json;
use yii\httpclient\Client;
/**
 * ReplyController implements the CRUD actions for Reply model.
 */
class ReplyController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Reply models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReplySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionReplies(){
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
            $threadId = empty($ids[0]) ? null : $ids[0];
            $commentId = empty($ids[1]) ? null : $ids[1];
            if ($threadId != null) {
               $replies = Reply::find()->where(['thread_id' => $threadId, 'comment_id' => $commentId ])->all();
               foreach( $replies as $reply ){
                   $out[] = ['id'=> $reply->id, 'name' => $reply->reply];
               }
               return Json::encode(['output'=> $out, 'selected'=>'']);
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']); 
    }

    public function actionCountry(){
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl('https://restcountries.eu/rest/v2/all')
            ->send();
        if ($response->isOk) {
            foreach($response->data as $data){
                echo $data['name'];
                echo '<br/>';
            }
            die();
        }
    }

    public function actionChart(){
        $searchModel = new ReplySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $models = $dataProvider->getModels();
        $labels = [];
        $data = [];
        foreach( $models as $model ){
            $labels[] = $model->comment->body;
            $data[] = $model->comment->getReplies()->count();
        }

        return $this->render('chart', 
            [
                'labels' => $labels,
                'data' => $data,
                'searchModel' => $searchModel 
            ]
        );

    }


    /**
     * Displays a single Reply model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Reply model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Reply();
        $threads = Threads::find()->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'threads' => $threads
            ]);
        }
    }

    /**
     * Updates an existing Reply model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Reply model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Reply model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Reply the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Reply::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
