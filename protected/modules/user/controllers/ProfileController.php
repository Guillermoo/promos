<?php

class ProfileController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='column2';
    //public $layout='//layouts/column2';
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
		return CMap::mergeArray(parent::filters(),array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		));
	}
	
	public function actionError(){
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','edit','profile','updateAjax','home'),
				'users'=>array('@'),
			),
			/*array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),*/
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	/*  	
	 * (G)De momento abrimos home que no hay nada pensado en que se mostrará.
	 * Dejo el código comentado por si hace falta.
	 * */
	public function actionHome(){
		
		$model = $this->loadUser();

		$this->render('profile',array(
	    	'model'=>$model
	    ));
	}

	/**
	 * Shows a particular model.
	 */
	public function actionProfile()
	{
		//$this->layout = 'column1';
		$model = $this->loadUser();
		//$this->debug(Yii::app()->controller->module->user());
		/*$this->debug($model->attributes);
		$this->debug(Yii::app()->controller->module->user()->id);*/
		$this->render('profile', array('model'=>$model));
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
		$this->_model=new Profile;

		if(isset($_POST['Profile'])){
			$this->_model->attributes=$_POST['Profile'];
			if($this->_model->save())
				$this->redirect(array('view','id'=>$this->_model->user_id));
		}

		//$this->debug($this->_model);

		$this->render('create',array(
			'model'=>$this->_model,
		));

	}
    
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	/*public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}*/
	
	public function actionUpdate(){
		
		$model = $this->loadUser();
		
		$profile=$model->profile;
		$profile->scenario = "paraValidar";
		
		// ajax validator
		$this->performAjaxValidation(array($profile));
		
		
		if(isset($_POST['Profile'])){
			$profile->attributes=$_POST['Profile'];
			
			if($profile->validate()) {
				if ($profile->save()){
					//Yii::app()->user->updateSession();
					Yii::app()->user->setFlash('success',UserModule::t("Changes are saved."));
					$this->redirect(array('/user/profile'));	
				};
			} else $profile->validate();
		}
		$this->render('edit',array(
			'model'=>$model,
		));
	}
	
	/**
	* Comprobar que la cuenta anterior no era la gratuita para que no la pueda coger otra vez
	*/
	public function actionPuedeTrial($id){
		//si el status del usuario es 1 es que está utilizando la cuenta trial (gratuita)

		$model=Empresa::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		if($model->status == 1)
				$this->render('trial');
		else
				$this->render('notrial');
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
				
		}else{
			//$this->debug( "Model Nonulll");
		}
		return $this->_model;
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='profile-form')
		{
			echo UActiveForm::validate($model);
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
    
    /********CODIGO COMENTADO *************/
    
    /*public function getTabularFormTabs($model,$categorias,$cuentas)
	{
		
	    $tabs = array();
	    $count = 0;
	    
	    Yii::import("xupload.models.XUploadForm");
        $image = new XUploadForm;

	    if(UserModule::isCompany()){
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
	}*/
}
