<?php

namespace app\controllers;

use Yii;
use app\models\TimerActivities;
use app\models\TimerActivitiesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TimerActivitiesController implements the CRUD actions for TimerActivities model.
 */
class TimerActivitiesController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all TimerActivities models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TimerActivitiesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TimerActivities model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TimerActivities model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TimerActivities();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    /*------------------------------------The Magic Starts Here------------------------------------------------------------------*/
    public function actionCreateFromCurrentTime()
    {
        $model = new TimerActivities();
        if (Yii::$app->request->isAjax) {
            $model->activity_description = Yii::$app->request->post('activity_description');
            $model->activity_time = date("y-m-d") ." ". Yii::$app->request->post('activity_time');
            if($model->save())           
            {
            return 1;
            }
        }
        return 0;
    }
    
    public function actionCreateManually()
    {
        $model = new TimerActivities();
        if (Yii::$app->request->isAjax) {
            $model->activity_description = Yii::$app->request->post('activity_description');
            $model->activity_time = Yii::$app->request->post('activity_time');
            if($model->save())           
            {
            return true;
            }
        }
        return false;
    }
    
    /*------------------------------------The Magic Ends Here :(------------------------------------------------------------------*/

    /**
     * Updates an existing TimerActivities model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TimerActivities model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TimerActivities model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TimerActivities the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TimerActivities::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
