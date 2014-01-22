<?php

class CompraController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(		
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('comprado','historialCompras','view','index'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','create','update',),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Compra;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Compra']))
		{
			$model->attributes=$_POST['Compra'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionComprado($idPromo)
	{
		$model=new Compra;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($idPromo) && !empty($idPromo))
		{
			//comprobar que el id de la promo existe
			$model->id_usuario = Yii::app()->user->id;
			$model->id_promo = $idPromo;
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('error');
	}
	public function actionHistorialCompras()
	{
		$dataProvider=new CActiveDataProvider('Compra',array(
                    'criteria'=>array(
                    'condition'=>'id_usuario ='.Yii::app()->user->id
		)));

		//$this->debug($dataProvider);

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Compra']))
		{
			$model->attributes=$_POST['Compra'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$id = Yii::app()->user->id;		
		$dataProvider=new CActiveDataProvider('Compra',
			array(
    			'criteria'=>array(
        		'condition'=>'id_promo IN (select id from tbl_promociones WHERE user_id = '.Yii::app()->user->id.')',       		
    			)
    		)
		);
		$data=$dataProvider->getData();		
		$this->render('listaCompras',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Compra('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Compra']))
			$model->attributes=$_GET['Compra'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Compra the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Compra::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Compra $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='compra-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}


	/* Used to debug variables*/
    protected function Debug($var){
        $bt = debug_backtrace();
        $dump = new CVarDumper();
        $debug = '<div style="display:block;background-color:gold;border-radius:10px;border:solid 1px brown;padding:10px;z-index:10000;"><pre>';
        $debug .= '<h4>function: '.$bt[1]['function'].'() line('.$bt[0]['line'].')'.'</h4>';
        $debug .=  $dump->dumpAsString($var);
        $debug .= "</pre></div>\n";
        Yii::app()->params['debugContent'] .=$debug;
    }
    
}
