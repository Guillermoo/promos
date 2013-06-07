<?php

class ProfileController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	public $defaultAction = 'profile';
	
	public $stateVariable = 'xuploadFiles';
	
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
	 * Shows a particular model.
	 */
	public function actionProfile()
	{
		$this->_model = $this->loadUser();
		
		if (UserModule::isAdmin())
			$this->renderParaAdmin();
		else
		 	$this->renderParaUsuario();
	}
	
	
	
	public function actionError()
	{
	 if($error=Yii::app()->errorHandler->error)
	 {
	        if(Yii::app()->request->isAjaxRequest)
	                echo $error['message'];
	        else
	        $this->render('error', $error);
	 }
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','updateAjax','profile'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','edit'),
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
		$model=new Profile;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Profile']))
		{
			$model->attributes=$_POST['Profile'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->user_id));
		}

		$this->render('create',array(
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
	
	public function actionEdit()
		{
			$_model = $this->loadUser();
			$profile=$_model->profile;
			
			// ajax validator
			if(isset($_POST['ajax']) && $_POST['ajax']==='profile-form')
			{
				echo UActiveForm::validate(array($profile));
				Yii::app()->end();
			}
			
			if(isset($_POST['Profile']))
			{
				//$model->attributes=$_POST['User'];
				$profile ->attributes=$_POST['Profile'];
				if($profile ->validate()) {
					$profile ->save();
	                Yii::app()->user->updateSession();
					Yii::app()->user->setFlash('profileMessage',UserModule::t("Changes is saved."));
					$this->redirect(array('/user/profile'));
				} else $profile ->validate();
			}
	
			$this->render('profile',array(
				'model'=>$_model,
				'profile'=>$profile ,
			));
		}
		
		
public function getTabularFormTabs($model,$categorias,$cuentas)
	{
		
	    $tabs = array();
	    $count = 0;
	    
	    Yii::import("xupload.models.XUploadForm");
        $image = new XUploadForm;

	    if(Yii::app()->authManager->checkAccess('empresa', Yii::app()->user->id)){
	        $tabs[0] = array(
	            'active'=>1,
	            'label'=>'Welcome',
	            'content'=>$this->renderPartial('/layouts/_welcome', array(), true),
	        );
	    	$tabs[1] = array(
	            'active'=>0,
	            'label'=>'Profile',
	            'content'=>$this->renderPartial('_form', array('model'=>$model, 'profile'=>$model->profile), true),
	        );
	        $tabs[2] = array(
	            'active'=>0,
	            'label'=>'Company',
	            'content'=>$this->renderPartial('/empresa/_form', array('model'=>$model,'categorias'=>$categorias, 'cuentas'=>$cuentas, 'image'=>$image), true),
	        );
	        $tabs[3] = array(
	            'active'=>0,
	            'label'=>'Promotions',
	            'content'=>$this->renderPartial('/layouts/_welcome', array('model'=>$model,'categorias'=>$categorias, 'cuentas'=>$cuentas, 'image'=>$image), true),
	        );
	    }
	    return $tabs;
	}
	
	private function renderParaAdmin(){
		$this->render('profile',array(
	    	'model'=>$this->_model,
			//'profile'=>$this->_model->profile,
	    ));
	}
	
	private function renderParaUsuario(){
		
		$esEmpresa = Yii::app()->authManager->checkAccess('empresa', Yii::app()->user->id);
		
		if($esEmpresa)
			$this->renderParaEmpresa();
		else
			$this->renderParaComprador();
	}
	
	private function getImage($img,$logo){
			
			//$img = new XUploadForm;
			//$img->model = $logo->tipo;
			$img->name = $logo->name;
	        $img->mime_type = $logo->tipo;
	        //$img->type = $logo->mime_type;
	        $img->file = $logo->path;
	        
	        //$img->url = $logo->path;
	        $img->filename = $logo->filename;
	        $img->size = $logo->size;
	        //$img->delete_type = 'POST';
	        /*0: {name:1920x1080_HD_Wallpaper_124_zixpkcom.jpg, type:image/jpeg, size:127936,…}
			delete_type: "POST"
			delete_url: "/promos/item/upload?_method=delete&file=5c8081f28c55d6da66ed22feca2d8bcd.jpg"
			name: "1920x1080_HD_Wallpaper_124_zixpkcom.jpg"
			size: 127936
			thumbnail_url: "/promos/uploads/images/tmp/thumbs/5c8081f28c55d6da66ed22feca2d8bcd.jpg"
			type: "image/jpeg"
			url: "/promos/uploads/images/tmp/5c8081f28c55d6da66ed22feca2d8bcd.jpg"*/

	        return $img;
	        
		}
	
	private function renderParaEmpresa(){
		
		$cuentas = Cuenta::getCuentas();
		$cuentas_list = CHtml::listData($cuentas,'id', 'nombre');
		
		//Obtenemos todas las categorías con nivel 2(suponiendo que no hay subcategorías
		$cat_model = Categoria::getCategorias();
		$categorias = CHtml::listData($cat_model,'id', 'name');

		/*$myImg = $this->setImage();
		
		Yii::import("xupload.models.XUploadForm");
        $image = new XUploadForm;*/
		$image = new Item;
        
		$this->render('profile',array(
	    	'model'=>$this->_model,
			'categorias'=>$categorias,
			'cuentas'=>$cuentas,
			'image'=>$image,
			//'myImg'=>$myImg,
	    ));
	}
	
	private function renderParaComprador(){
		$this->render('profile',array(
	    	'model'=>$this->_model,
			'profile'=>null,
			'empresa'=>null,
			'categorias'=>null,
			'cuentas'=>null,
	    	'contacto'=>null,
			'logo'=>null,
	    ));
	}

	/**
	 * Lists all models.
	 */
	/*public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Profile');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}*/

	/**
	 * Manages all models.
	 */
	/*public function actionAdmin()
	{
		$model=new Profile('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Profile']))
			$model->attributes=$_GET['Profile'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}*/
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the primary key value. Defaults to null, meaning using the 'id' GET variable
	 */
	public function loadUser()
	{
		if($this->_model===null)
		{
			if(Yii::app()->user->id){
				$this->_model=Yii::app()->controller->module->user();
			}
			if($this->_model===null){
				$this->redirect(Yii::app()->controller->module->loginUrl);
			}
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
	/*protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='profile-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}*/
	
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
