<?php

namespace app\controllers;

use Yii;
use app\models\AuthItemChild;
use app\models\AuthItem;
use app\models\AuthItemChildSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * AuthItemChildController implements the CRUD actions for AuthItemChild model.
 */
class AuthItemChildController extends Controller
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
     * Lists all AuthItemChild models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AuthItemChildSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AuthItemChild model.
     * @param string $parent
     * @param string $child
     * @return mixed
     */
    public function actionView($parent, $child)
    {
        return $this->render('view', [
            'rolePermissions' => $rolePermissions,
        ]);
    }

    /**
     * Creates a new AuthItemChild model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AuthItemChild();
        if (Yii::$app->request->post()) {
            $model->child = Yii::$app->request->post()['child'];
            $model->parent = Yii::$app->request->post()['parent'];
            $model->save();
            return 'success';
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AuthItemChild model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $parent
     * @param string $child
     * @return mixed
     */
    public function actionUpdate($parent, $child)
    {
        $allAuthItems = AuthItem::find()->all(); 
        $rolePermissions = AuthItemChild::find()->where(['parent' => $parent])->all();

        $model = $this->findModel($parent, $child);
        $model->children = ArrayHelper::map($rolePermissions, 'child', 'child');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'parent' => $model->parent, 'child' => $model->child]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'allAuthItems' => $allAuthItems
            ]);
        }
    }

    /**
     * Deletes an existing AuthItemChild model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $parent
     * @param string $child
     * @return mixed
     */
    public function actionDelete($parent, $child)
    {
        $this->findModel($parent, $child)->delete();
        return 'deleted';
    }

    /**
     * Finds the AuthItemChild model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $parent
     * @param string $child
     * @return AuthItemChild the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($parent, $child)
    {
        if (($model = AuthItemChild::findOne(['parent' => $parent, 'child' => $child])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
