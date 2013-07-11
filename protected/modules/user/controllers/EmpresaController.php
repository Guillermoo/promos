<?php

class EmpresaController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//hugo--------------
		//$this->layout = '_contacto';
	//------------------
	public $layout='column1';
        //public $layout='//layouts/column2';
	//public $defaultAction = 'view';
	
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
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','empresa','edit','DeleteItem','view'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>UserModule::getAdmins(),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
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
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	
	/*  
	 * (G)De momento abrimos home que no hay nada pensado en que se mostrará.
	 * Dejo el código comentado por si hace falta.
	 * */
	/*public function actionEmpresa()
	{
            $this->debug("Empresa");
            
            $_model = $this->loadUser();
            //Obtenemos todas las categorías con nivel 2(suponiendo que no hay subcategorías
            /*$cat_model = Category::getCategorias();
            $categorias = CHtml::listData($cat_model,'id', 'name');

            $cuentas = Cuenta::getCuentas();
            $cuentfas_list = CHtml::listData($cuentas,'id', 'nombre');
            */
            //Para cargar/gestionar el logo
           /* Yii::import("xupload.models.XUploadForm");
            $image = new XUploadForm;

            $this->performAjaxValidation(array($_model->empresa));
            
            /*if(isset($_POST['Empresa'])){
                
                if (UserModule::isCompany()){
                    $model = $this->loadUser();
                    $empresa = $model->empresa;
                    $redirect = "/user/empresa";
                }  else 
                    $redirect = "/user/empresa/view/".$empresa->id;
                
                $empresa->attributes=$_POST['Empresa'];
                if($empresa->validate()) {
                    try {
                        if ($empresa->save()){
                                Yii::app()->user->setFlash('success',UserModule::t("Changes is saved."));
                                $this->redirect(array($redirect));
                        }else{
                                Yii::app()->user->setFlash('error',UserModule::t("Error saving the changes."));
                                //$this->redirect(array('/user/empresa'));

                        };
                    }
                    // we are looking for specific exception here
                    catch (CException $e)
                    {
                        echo $e;
                    }
                    /*if ($empresa->save(false)){
                            //(G)Se supone que si ha podido guardar es porque ha rellenado los campos mínimos.
           // Yii::app()->user->updateSession();
                            Yii::app()->user->setFlash('success',UserModule::t("Changes is saved."));
                            $this->redirect(array('/user/empresa'));
                    }else $this->debug($empresa->getErrors());*/
                /*} else $empresa->validate();
            }*/
            
	    /*$this->render('edit',array(
	    	'empresa'=>$_model->empresa,
                'image'=>$image,
	    ));
	    
	}*/
        
        /**
	 * Manages all models.
	 */
	public function actionAdmin(){
            $model=new Empresa('search');
            $model->unsetAttributes();  // clear any default values

            if(isset($_GET['Empresa']))
                    $model->attributes=$_GET['Empresa'];

            $this->render('admin',array(
                'model'=>$model,
            ));
	}
	
	public function actionDeleteItem($id){
		//Here we check if we are deleting and uploaded file
		if(Yii::app()->request->isAjaxRequest)
		{    
	        if( isset( $id )) {
	        	Item::deleteItemFromDisk($id);
				Item::deteleItemFromDB($id);
				Yii::import( "xupload.models.XUploadForm" );
				$image = new XUploadForm;
				
				echo $this->renderPartial('../layouts/_itemupload', array(
					'image' => $image,'idform'=>'empresa-form'));
	        }
		}
	}

	public function actionForm( ) {
	    $model = new Item;
	    Yii::import( "xupload.models.XUploadForm" );
	    $photos = new XUploadForm;
	    //Check if the form has been submitted
	    if( isset( $_POST['Item'] ) ) {
	        //Assign our safe attributes
	        $model->attributes = $_POST['Item'];
	        //Start a transaction in case something goes wrong
	        $transaction = Yii::app( )->db->beginTransaction( );
	        try {
	            //Save the model to the database
	            if($model->save()){
	                $transaction->commit();
	            }
	        } catch(Exception $e) {
	            $transaction->rollback( );
	            Yii::app( )->handleException( $e );
	        }
	    }
	    $this->render( 'form', array(
	        'model' => $model,
	        'photos' => $photos,
	    ) );
	}
	
	/*public function actionForm( ) {
	    /*$model = new SomeModel;
	    Yii::import( "xupload.models.XUploadForm" );
	    $photos = new Item;
	    //Check if the form has been submitted
	    if( isset( $_POST['Item'] ) ) {
	        //Assign our safe attributes
	        $photos->attributes = $_POST['Item'];
	        //Start a transaction in case something goes wrong
	        $transaction = Yii::app( )->db->beginTransaction( );
	        try {
	            //Save the model to the database
	            if($photos->save()){
	                $transaction->commit();
	            }
	        } catch(Exception $e) {
	            $transaction->rollback( );
	            Yii::app( )->handleException( $e );
	        }
	    }
	    $this->render( 'form', array(
	        //'model' => $model,
	        'photos' => $photos,
	    ) );
	}*/
	
	public function actionMisdebugs(){
		
		$model = $this->loadUser();
	 	
		$cat_model = Category::getCategorias();
		$categorias = CHtml::listData($cat_model,'id', 'name');
		$listCat = array();
		
		foreach($categorias as $cat){
			//$listCat = array('label'=>$cat);
			array_push($listCat, $cat);
		}
		//$this->debug($listCat);
	 	//$misCat = $model->empresa->categoria;
	 	$misCat = $model->empresa->empCat;
	 	//$misCat = Empresa::getEmpCategories();
	 	
	 	$list = new CList();
	    foreach($misCat as $c)
	        $list->add($c->categoria_id);
	        //$ids[]=$c->id;
	        
	    $col = new CAttributeCollection();
		// $col->add('name','Alexander');
		foreach($misCat as $c)
			$col->categoria_id=$c->categoria_id;   
		
	    $this->debug($col);	
	    
	 	$misCat2=EmpCat::model()->findAll(array(
		    'condition'=>'empresa_id='.$model->empresa->id,
		));
		
		foreach($categorias as $cat){
			//$listCat = array('label'=>$cat);
			array_push($listCat, $cat);
		}
		
		$this->render( 'misdebugs', array(
	        'model' => $model,
			'misCat' => $misCat[0],
			'listCat' => $listCat,
			'categorias' => $categorias,
	    ) );
	    
	}
        
        private function actualizaEmpresa($id=null){
            
            if (UserModule::isAdmin()){
                $empresa = $this->loadModel($id);
                $redirectOkEmpresa = 'empresa/edit/id/'.$empresa->id;
            }else{
                $empresa = $this->loadUser()->empresa;
                $redirectOkEmpresa = '/user/empresa';
            }
            
            // ajax validator   
            $this->performAjaxValidation(array($empresa));
            
            //Para cargar/gestionar el logo
            Yii::import("xupload.models.XUploadForm");
            $imageForm = new XUploadForm;
            if(isset($_POST['Empresa'])){
                $empresa->attributes=$_POST['Empresa'];
                if($empresa->validate()) {
                    try {
                        if ($empresa->save())
                            Yii::app()->user->setFlash('success',UserModule::t("Changes is saved."));
                        else
                            Yii::app()->user->setFlash('error',UserModule::t("Error saving the changes."));
                        
                        $this->redirect(array($redirectOkEmpresa));
                    }
                    // we are looking for specific exception here
                    catch (CException $e)
                    {
                        echo $e;
                    }
                } else $empresa->validate();
            }
            $this->render('edit',array(
                    'empresa'=>$empresa,
                    'image'=>$imageForm,
            ));
        }
        
        //Cuando es empresa
        public function actionEmpresa(){
            $this->actualizaEmpresa();
        }
        
        //Cuando es admin
        public function actionEdit($id=null){
            $this->actualizaEmpresa($id);
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
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($validate)
	{
		// ajax validator
		if(isset($_POST['ajax']) && $_POST['ajax']==='empresa-form')
		{
			echo UActiveForm::validate($validate);
			Yii::app()->end();
		}
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Profile the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Empresa::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Profile $model the model to be validated
	 */
	/*(G) Debería validar contacto y profile*/
	/*protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='empresa-form')
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
