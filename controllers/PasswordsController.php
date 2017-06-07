<?php

namespace app\controllers;

use Yii;
use app\models\Passwords;
use app\models\PasswordsSearch;
use app\models\User;
use app\forms\ValidateForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * PasswordsController implements the CRUD actions for Passwords model.
 */
class PasswordsController extends Controller
{
    public $enableCsrfValidation = false;
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
		    'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['create','view','index','update','unlock'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Passwords models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PasswordsSearch(['fkuser'=>Yii::$app->user->id]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Passwords model.
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
     * Creates a new Passwords model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Passwords();

        if ($model->load(Yii::$app->request->post())) {
            $user = User::findOne(Yii::$app->user->id);
			$model->password  = base64_encode(Yii::$app->getSecurity()->encryptByPassword($model->password, $user->password_hash));
            $model->creado_en = date('Y-m-d H:m:s');
            $model->actualizado_en = date('Y-m-d H:m:s');
            $model->fkuser = $user->id;
			$model->save();
            Yii::$app->session->setFlash('success','Se creó el registro con éxito');
            return $this->redirect(['view', 'id' => $model->pkpassword]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Passwords model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $user = User::findOne(Yii::$app->user->id);
            $model->password = base64_encode(Yii::$app->getSecurity()->encryptByPassword($model->password, $user->password_hash));
            $model->actualizado_en = date('Y-m-d H:m:s');
            $model->save();
            Yii::$app->session->setFlash('success','Se actualizó el registro con éxito');
            return $this->redirect(['view', 'id' => $model->pkpassword]);
        } else {
            $model->password = '';
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Passwords model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        /*$this->findModel($id)->delete();

        return $this->redirect(['index']);*/
    }

    /**
     * Función para desbloquear un password
     * @param integer $id Recibe el id del password
     * @return Retorna el password
     */
    public function actionUnlock($id)
    {
        $model = $this->findModel($id);

        $form = new ValidateForm();

        $pass = '';

        if($form->load(Yii::$app->request->post()))
        {
            $user = User::findOne(Yii::$app->user->id);
            if(Yii::$app->security->validatePassword($form->password, $user->password_hash))
            {
                $pass = Yii::$app->getSecurity()->decryptByPassword(base64_decode($model->password), $user->password_hash);
                Yii::$app->session->setFlash('success','Su contraseña se desencripto');
                echo "asdasd";
            }
            else
            {
                Yii::$app->session->setFlash('error','Contraseña Equivocada');
                $pass = '';
            }
        }
        return $this->render('unlock', [
            'model' => $form,
            'pass' => $pass,
            'title' => $model->descripcion,
        ]);
    }

    /**
     * Finds the Passwords model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Passwords the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Passwords::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
