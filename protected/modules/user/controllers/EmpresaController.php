<?php

class EmpresaController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	public $defaultAction = 'empresa';
	
	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;
	
	
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
	 * Lists all models.
	 */
	public function actionEmpresa()
	{
		$model = $this->loadUser();
		
		//$this->debug($model->empresa);
		$this->render('empresa',array(
	    	'model'=>$model,
			'empresa'=>$model->empresa,
	    	'contacto'=>$model->empresa->contacto,
	    ));
	    
		/*$dataProvider=new CActiveDataProvider('Empresa', array(
			'criteria'=>array(
		        'condition'=>'id>'.$model->id. ''
		    ),
				
			/*'pagination'=>array(
				'pageSize'=>Yii::app()->controller->module->user_page_size,
			),
		));*/

		//$this->redirect(array('empresa/view','id'=>$model->id));
	}
	
	

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	/*public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}*/

	public function actionEdit()
		{
			$model = $this->loadUser();
			$empresa=$model->empresa;
			$contacto=$model->empresa->contacto;
			
			// ajax validator
			if(isset($_POST['ajax']) && $_POST['ajax']==='empresa-form')
			{
				echo UActiveForm::validate(array($model,$empresa,$contacto));
				Yii::app()->end();
			}
			
			if(isset($_POST['Empresa']))
			{
				//$model->attributes=$_POST['User'];
				$empresa->attributes=$_POST['Empresa'];
				$contacto->attributes=$_POST['Contacto'];
				
				if($empresa->validate()) {
					//$model->save();
					//$empresa->modificado = NOW();
					$empresa->save();
					$contacto->save();
	                Yii::app()->user->updateSession();
					Yii::app()->user->setFlash('empresaMessage',UserModule::t("Changes is saved."));
					$this->redirect(array('/user/empresa'));
				} else $empresa->validate();
			}
	
			$this->render('empresa',array(
				'model'=>$model,
				'empresa'=>$empresa,
				'contacto'=>$contacto,
			));
		}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Empresa');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the primary key value. Defaults to null, meaning using the 'id' GET variable
	 */
	public function loadUser()
	{
		if($this->_model===null)
		{
			if(Yii::app()->user->id)
				$this->_model=Yii::app()->controller->module->user();
			if($this->_model===null)
				$this->redirect(Yii::app()->controller->module->loginUrl);
		}
		return $this->_model;
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Profile the loaded model
	 * @throws CHttpException
	 */
	/*public function loadModel($id)
	{
		$model=Profile::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}*/

	/**
	 * Performs the AJAX validation.
	 * @param Profile $model the model to be validated
	 */
	/*(G) Debería validar contacto y profile*/
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='empresa-form')
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
