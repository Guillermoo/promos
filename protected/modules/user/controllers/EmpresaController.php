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
	public $layout='column2';
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
	
	/*  	
	 * (G)De momento abrimos home que no hay nada pensado en que se mostrará.
	 * Dejo el código comentado por si hace falta.
	 * */
	public function actionHome(){
		$model = $this->loadUser();
		
		/*$respuesta = UserModule::compruebaStatus($model);
		
		if ($respuesta != true){
			$model->status = User::STATUS_ACTIVE;//Si por alguna posibilidad le falta algún campo.
			$model->save(false);
		};
		$this->debug($respuesta);*/
		
		$this->render('home',array(
	    	'model'=>$model
	    ));
	}
	
	/*  
	 * (G)De momento abrimos home que no hay nada pensado en que se mostrará.
	 * Dejo el código comentado por si hace falta.
	 * */
	public function actionEmpresa()
	{
		$_model = $this->loadUser();
		//Obtenemos todas las categorías con nivel 2(suponiendo que no hay subcategorías
		/*$cat_model = Category::getCategorias();
		$categorias = CHtml::listData($cat_model,'id', 'name');
		
		$cuentas = Cuenta::getCuentas();
		$cuentfas_list = CHtml::listData($cuentas,'id', 'nombre');
		*/
		//Para cargar/gestionar el logo
		Yii::import("xupload.models.XUploadForm");
        $image = new XUploadForm;
		
		/*$this->render('empresa',array(
	    	'model'=>$_model,
			'empresa'=>$_model->empresa,
	    	'contacto'=>$_model->empresa->contacto,
			'categorias'=>$categorias,
			'cuentas'=>$cuentas_list,
			'logo'=>$logo,
	    ));*/
	    $this->render('empresa',array(
	    	'model'=>$_model,
			/*'empresa'=>$_model->empresa,
	    	'contacto'=>$_model->empresa->contacto,
			'categorias'=>$categorias,
			'cuentas'=>$cuentas_list,*/
			'image'=>$image,
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
		    'condition'=>'empresa_id='.$model->empresa->empresa_id,
		));
		
		foreach($categorias as $cat){
			//$listCat = array('label'=>$cat);
			array_push($listCat, $cat);
		}
		
	 	/*$ids=array();
        foreach($misCat2 as $c)
                $ids[]=$c->categoria->id;*/
                //$ids[]=$c->id;
        //return $ids;
        
	 	//$this->debug($misCat);
	 	//$this->debug($model);
	 	$this->debug($misCat);
	 	//$this->debug($misCat[1]->attributes);
	 	
		$this->render( 'misdebugs', array(
	        'model' => $model,
			'misCat' => $misCat[0],
			'listCat' => $listCat,
			'categorias' => $categorias,
	    ) );
	    
	}

	public function actionEdit()
		{
			$model = $this->loadUser();
			$empresa=$model->empresa;
			
			$empresa->scenario ="paraValidar";
			
			$cuentas = Cuenta::getCuentas();
			$cuentas_list = CHtml::listData($cuentas,'id', 'nombre');
			
			//Para cargar/gestionar el logo
		 	Yii::import("xupload.models.XUploadForm");
	        $logo = new XUploadForm;
			// ajax validator
			if(isset($_POST['ajax']) && $_POST['ajax']==='empresa-form')
			{
				echo UActiveForm::validate(array($model,$empresa));
				Yii::app()->end();
			}
			
			if(isset($_POST['Empresa']))
			{
				$empresa->attributes=$_POST['Empresa'];
				if($empresa->validate()) {
					$empresa->save();
					//(G)Se supone que si ha poddio guardar es porque ha rellenado los campos mínimos.
					//$contacto->save();
	                Yii::app()->user->updateSession();
					Yii::app()->user->setFlash('empresaMessage',UserModule::t("Changes is saved."));
					$this->redirect(array('/user/empresa'));
				} else {
					$empresa->validate();
				}
			}
			$this->render('empresa',array(
				'model'=>$model,
				'empresa'=>$empresa,
				'cuentas'=>$cuentas,
				'image'=>$logo,
			));
		}

	public function actionActualizacontacto(){
		
		$model = $this->loadUser();
		$empresa=$model->empresa;
		$profile = $model->profile;
		//Habría que crear unas reglas especiales para esta validación
		$empresa->scenario = 'paraValidar';
		$profile->scenario = 'paraValidar';
			
		if(isset($_POST['ajax']) && $_POST['ajax']==='empresa-form'){
			echo UActiveForm::validate(array($empresa,$profile));
			Yii::app()->end();
		}
		//Si es dándole al botoncico de next
		if(isset($_POST['Empresa']))
		{
			$empresa->attributes=$_POST['Empresa'];
			$profile->attributes=$_POST['Profile'];
				
			$empresa->save();
			$profile->save();
			Yii::app()->user->updateSession();
			Yii::app()->user->setFlash('empresaMessage',UserModule::t("Changes is saved."));
			//Aquí habría que mirar si es trial y mandarlo al dashboard, o al resto a paypal.
			if ($model->profile->tipocuenta=0){
				$this->redirect(array('home'));
			}else{
				//(G)El siguiente paso tendría que ser que pagara. Se podría poner un botón que pusiese pagar ya y otro que ponga pagar mas adelante. Se piensa
				$this->redirect(array('paypalasd'));
			}
		}
		//$model->save();
		//$empresa->modificado = NOW();

		/*$this->render('empresa',array(
			'model'=>$model,
			'empresa'=>$empresa,
			//'contacto'=>$contacto,
			'cuentas'=>$cuentas,
			'logo'=>$logo,
		));*/
		
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
	public function loadModel($id)
	{
		$model=Profile::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

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
