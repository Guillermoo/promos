<?php

class AdminController extends Controller
{
	public $defaultAction = 'admin';
	public $layout='//layouts/column2';

	private $_model;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return CMap::mergeArray(parent::filters(),array(
			'accessControl', // perform access control for CRUD operations
		));
	}
	
	public function actionError(){
		if($error=Yii::app()->errorHandler->error){
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
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
                            'actions'=>array('admin','delete','create','updateAjax','update','view','home'),
                            'users'=>UserModule::getAdmins(),
			),
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
		
		//$model = $this->loadUser();

		$this->render('home',array(
	    	//'model'=>$model
	    ));
	}
        
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
            $model=new User('search');
            $model->unsetAttributes();  // clear any default values

            if(isset($_GET['User']))
                    $model->attributes=$_GET['User'];

            $this->render('index',array(
                'model'=>$model,
            ));
	}
	
	/**
	 * Displays a particular model.
	 * De momento no lo dejamos accesible
	 */
	public function actionView()
	{
		$model = $this->loadModel();

		$this->render('view',array(
			'model'=>$model,
		));
	}

	/**
	 * Crea un nuevo usuario desde el menú administrador. Puede crear compradores, empresas y admins.
	 */
	public function actionCreate()
	{
		$model=new User;

		$this->performAjaxValidation(array($model));
		
		if(isset($_POST['User'])){
			/*Desde el menú de admin el admin sólo podrá crear usuarios
			 con la información mínima(tabla tbl_user)*/
			$model->attributes=$_POST['User'];
			$model->activkey=Yii::app()->controller->module->encrypting(microtime().$model->password);

			if($model->validate()) {
				$model->password=Yii::app()->controller->module->encrypting($model->password);
				if($model->save()) {
					Yii::app()->user->setFlash('success', UserModule::t('User created.'));
				}else{
					Yii::app()->user->setFlash('error', UserModule::t('<strong>Error!</strong> There was an error creating the user.'));
				}
				$this->redirect(array('admin'));
			} 
			else
				$model->validate();
		}

		$this->render('create',array(
			'model'=>$model,
			'categorias'=>null,
			'esEmpresa'=>false,
			'cuentas'=>null,
		));
	}
	
	/*
	 * Chequea si es empresa para poner el escenario a los modelos
	 * */
	private function setScenario($model,$esEmpresa){
		
		if ( isset($model)){
			
			$model->scenario = 'admin';
			
			if ( $esEmpresa ){
				if ( isset($model->profile) && isset($model->empresa) ){
					$model->profile->scenario = 'admin';
					$model->empresa->scenario = 'admin';
				}else{
					//Si es empresa y no tiene creado estos modelos, mal vamos.
					throw new CHttpException(400,'<strong>Error!</strong> There is an error with profile and company information.');
					Yii::app()->end();			
				}
			}
		
		}
		
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate(){
		
		$model=$this->loadModel();
		$esEmpresa = UserModule::isCompany($model->id);

		$this->setScenario($model,$esEmpresa);
		
		// ajax validator
		if ($esEmpresa){
			$this->performAjaxValidation(array($model,$model->profile,$model->empresa));
		}else{
			$this->performAjaxValidation(array($model));
		}

		if(isset($_POST['User'])){
			
			$model->attributes=$_POST['User'];
			
			if($model->validate()) {
				
				//Lo comprobamos antes de que asigne las variables al modelos
				$this->compruebaCambios($model);
			
				if ($model->save()){
					
					if ($esEmpresa)
						$this->actualizaModelosRelacionados($model);
						
					Yii::app()->user->setFlash('success', UserModule::t('<strong>Well done!</strong> You successfully read this important alert message.'));	
				}else
					Yii::app()->user->setFlash('error', UserModule::t('<strong>Error!</strong> There were a error saving the user information.'));
				
				$this->redirect(array('update', 'id'=>$model->id));
			} else 
				$model->validate();
		}	
		
		$this->renderParaUsuario($esEmpresa);
	}
	
	private function actualizaModelosRelacionados($model){
		
		$model->profile->attributes=$_POST['Profile'];
		$model->empresa->attributes=$_POST['Empresa'];
		
		$model->profile->save(false);
		$model->empresa->save(false);

	}
	
	/**
	 * Comprueba cambios en el password y tipo de usuario
	 * */
	private function compruebaCambios($model){
		
		$old_model = User::model()->notsafe()->findByPk($model->id);
		if ($old_model->password!=$model->password) {
			$model->password=Yii::app()->controller->module->encrypting($model->password);
			$model->activkey=Yii::app()->controller->module->encrypting(microtime().$model->password);
		}
		//Al hacer afterSave se comprueba esta variable y cambiamos role
		if ($old_model->superuser!=$model->superuser) {
			$model->cambiaRole = true;
		}
		
		//return $model;
			
	}
	
/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			//$model = $this->loadModel();
			$model = User::model()->findbyPk($_GET['id']);
			
			if (UserModule::isAdmin($model->id) || UserModule::isSuperAdmin($model->id))
				Yii::app()->user->setFlash('error',"It's not allowed to delete admin users");
			else{
				try{
					if ($model->delete()){//Hay un beforeDelete
						if(!isset($_GET['ajax']))
					        Yii::app()->user->setFlash('success','Deleted Successfully');
					    else
					        echo "<div class='flash-success'>Ajax - Deleted Successfully</div>";
					}else{
						 Yii::app()->user->setFlash('error','Error deleting user');
					}
				}catch(CDbException $e){
				    if(!isset($_GET['ajax'])){
						hhhhh;				    	
				        Yii::app()->user->setFlash('error','Error deleting user');
				    }
				    else{
				    	sdsgh;
				    	Yii::app()->user->setFlash('success',$e);
				    	Yii::app()->end();
				       // echo "<div class='flash-error'>Ajax - error message</div>"; //for ajax
				    }
				}
					
				// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
				if(!isset($_POST['ajax']))
					$this->redirect(array('/user/admin'));
			}
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	
	private function renderParaUsuario($esEmpresa){
		
		if($esEmpresa)
			$this->renderParaEmpresa();
		else
			$this->renderParaComprador();
	}

	private function renderParaEmpresa(){

		//Para cargar/gestionar el logo
		Yii::import("xupload.models.XUploadForm");
		$image = new XUploadForm;

		$this->render('update',array(
	    	'model'=>$this->_model,
			'image'=>$image,
		));
	}

	private function renderParaComprador(){
		
		//Para cargar/gestionar el logo
		Yii::import("xupload.models.XUploadForm");
		$image = new XUploadForm;
		
		$this->render('update',array(
                    'model'=>$this->_model,
                    'image'=>$image,
		));
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($validate)
	{
		// ajax validator
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo UActiveForm::validate($validate);
			Yii::app()->end();
		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=User::model()->notsafe()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}
	
	/**
	 * Returns the data model based on the primary key given in the user session.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the primary key value. Defaults to null, meaning using the 'id' GET variable
	 */
	public function loadUser()
	{
		if($this->_model===null)
		{
			if(Yii::app()->user->id){
				$this->_model=User::model()->notsafe()->findbyPk(Yii::app()->user->id);
				//$this->_model=Yii::app()->controller->module->user();
			}
			if($this->_model===null){
				$this->redirect(Yii::app()->controller->module->loginUrl);
			}
		}
		return $this->_model;
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


	/**
	 * Register Script
	 * Esta función es para gestionar el jquery de las vistas para que se muestren los cmapos según
	 * el valor seleccionado en el combo SuperUser(tipo de usuario). Está copiado y pegado de profileFields.
	 */
	public function registerScript() {
		$basePath=Yii::getPathOfAlias('application.modules.user.views.asset');
		$baseUrl=Yii::app()->getAssetManager()->publish($basePath);
		$cs = Yii::app()->getClientScript();
		$cs->registerCoreScript('jquery');
		$cs->registerCssFile($baseUrl.'/css/redmond/jquery-ui.css');
		$cs->registerCssFile($baseUrl.'/css/style.css');
		$cs->registerScriptFile($baseUrl.'/js/jquery-ui.min.js');
		$cs->registerScriptFile($baseUrl.'/js/form.js');
		$cs->registerScriptFile($baseUrl.'/js/jquery.json.js');

		$widgets = self::getWidgets();

		$wgByTypes = ProfileField::itemAlias('field_type');
		foreach ($wgByTypes as $k=>$v) {
			$wgByTypes[$k] = array();
		}

		foreach ($widgets[1] as $widget) {
			if (isset($widget['fieldType'])&&count($widget['fieldType'])) {
				foreach($widget['fieldType'] as $type) {
					array_push($wgByTypes[$type],$widget['name']);
				}
			}
		}
		//echo '<pre>'; print_r($widgets[1]); die();
		$js = "

	var name = $('#name'),
	value = $('#value'),
	allFields = $([]).add(name).add(value),
	tips = $('.validateTips');
	
	var listWidgets = jQuery.parseJSON('".str_replace("'","\'",CJavaScript::jsonEncode($widgets[0]))."');
	var widgets = jQuery.parseJSON('".str_replace("'","\'",CJavaScript::jsonEncode($widgets[1]))."');
	var wgByType = jQuery.parseJSON('".str_replace("'","\'",CJavaScript::jsonEncode($wgByTypes))."');
	
	var fieldType = {
			'INTEGER':{
				'hide':['match','other_validator','widgetparams'],
				'val':{
					'field_size':10,
					'default':'0',
					'range':'',
					'widgetparams':''
				}
			},
			'VARCHAR':{
				'hide':['widgetparams'],
				'val':{
					'field_size':255,
					'default':'',
					'range':'',
					'widgetparams':''
				}
			},
			'TEXT':{
				'hide':['field_size','range','widgetparams'],
				'val':{
					'field_size':0,
					'default':'',
					'range':'',
					'widgetparams':''
				}
			},
			'DATE':{
				'hide':['field_size','field_size_min','match','range','widgetparams'],
				'val':{
					'field_size':0,
					'default':'0000-00-00',
					'range':'',
					'widgetparams':''
				}
			},
			'FLOAT':{
				'hide':['match','other_validator','widgetparams'],
				'val':{
					'field_size':'10.2',
					'default':'0.00',
					'range':'',
					'widgetparams':''
				}
			},
			'DECIMAL':{
				'hide':['match','other_validator','widgetparams'],
				'val':{
					'field_size':'10,2',
					'default':'0',
					'range':'',
					'widgetparams':''
				}
			},
			'BOOL':{
				'hide':['field_size','field_size_min','match','widgetparams'],
				'val':{
					'field_size':0,
					'default':0,
					'range':'1==".UserModule::t('Yes').";0==".UserModule::t('No')."',
					'widgetparams':''
				}
			},
			'BLOB':{
				'hide':['field_size','field_size_min','match','widgetparams'],
				'val':{
					'field_size':0,
					'default':'',
					'range':'',
					'widgetparams':''
				}
			},
			'BINARY':{
				'hide':['field_size','field_size_min','match','widgetparams'],
				'val':{
					'field_size':0,
					'default':'',
					'range':'',
					'widgetparams':''
				}
			}
		};
			
	function showWidgetList(type) {
		$('div.widget select').empty();
		$('div.widget select').append('<option value=\"\">".UserModule::t('No')."</option>');
		if (wgByType[type]) {
			for (var k in wgByType[type]) {
				$('div.widget select').append('<option value=\"'+wgByType[type][k]+'\">'+widgets[wgByType[type][k]]['label']+'</option>');
			}
		}
	}
		
	function setFields(type) {
		if (fieldType[type]) {
			if (".((isset($_GET['id']))?0:1).") {
				showWidgetList(type);
				$('#widgetlist option:first').attr('selected', 'selected');
			}
			
			$('div.row').addClass('toshow').removeClass('tohide');
			if (fieldType[type].hide.length) $('div.'+fieldType[type].hide.join(', div.')).addClass('tohide').removeClass('toshow');
			if ($('div.widget select').val()) {
				$('div.widgetparams').removeClass('tohide');
			}
			$('div.toshow').show(500);
			$('div.tohide').hide(500);
			".((!isset($_GET['id']))?"
			for (var k in fieldType[type].val) { 
				$('div.'+k+' input').val(fieldType[type].val[k]);
			}":'')."
		}
	}
	
	function isArray(obj) {
		if (obj.constructor.toString().indexOf('Array') == -1)
			return false;
		else
			return true;
	}
		
	$('#dialog-form').dialog({
		autoOpen: false,
		height: 400,
		width: 400,
		modal: true,
		buttons: {
			'".UserModule::t('Save')."': function() {
				var wparam = {};
				var fparam = {};
				$('#dialog-form fieldset .wparam').each(function(){
					if ($(this).val()) wparam[$(this).attr('name')] = $(this).val();
				});
				
				var tab = $('#tabs ul li.ui-tabs-selected').text();
				fparam[tab] = {};
				$('#dialog-form fieldset .tab-'+tab).each(function(){
					if ($(this).val()) fparam[tab][$(this).attr('name')] = $(this).val();
				});
				
				if ($.JSON.encode(wparam)!='{}') $('div.widgetparams input').val($.JSON.encode(wparam));
				if ($.JSON.encode(fparam[tab])!='{}') $('div.other_validator input').val($.JSON.encode(fparam)); 
				
				$(this).dialog('close');
			},
			'".UserModule::t('Cancel')."': function() {
				$(this).dialog('close');
			}
		},
		close: function() {
		}
	});


	$('#widgetparams').focus(function() {
		var widget = widgets[$('#widgetlist').val()];
		var html = '';
		var wparam = ($('div.widgetparams input').val())?$.JSON.decode($('div.widgetparams input').val()):{};
		var fparam = ($('div.other_validator input').val())?$.JSON.decode($('div.other_validator input').val()):{};
		
		// Class params
		for (var k in widget.params) {
			html += '<label for=\"name\">'+((widget.paramsLabels[k])?widget.paramsLabels[k]:k)+'</label>';
			html += '<input type=\"text\" name=\"'+k+'\" id=\"widget_'+k+'\" class=\"text wparam ui-widget-content ui-corner-all\" value=\"'+((wparam[k])?wparam[k]:widget.params[k])+'\" />';
		}
		// Validator params		
		if (widget.other_validator) {
			var tabs = '';
			var li = '';
			for (var t in widget.other_validator) {
				tabs += '<div id=\"tab-'+t+'\" class=\"tab\">';
				li += '<li'+((fparam[t])?' class=\"ui-tabs-selected\"':'')+'><a href=\"#tab-'+t+'\">'+t+'</a></li>';
				
				for (var k in widget.other_validator[t]) {
					tabs += '<label for=\"name\">'+((widget.paramsLabels[k])?widget.paramsLabels[k]:k)+'</label>';
					if (isArray(widget.other_validator[t][k])) {
						tabs += '<select type=\"text\" name=\"'+k+'\" id=\"filter_'+k+'\" class=\"text fparam ui-widget-content ui-corner-all tab-'+t+'\">';
						for (var i in widget.other_validator[t][k]) {
							tabs += '<option value=\"'+widget.other_validator[t][k][i]+'\"'+((fparam[t]&&fparam[t][k])?' selected=\"selected\"':'')+'>'+widget.other_validator[t][k][i]+'</option>';
						}
						tabs += '</select>';
					} else {
						tabs += '<input type=\"text\" name=\"'+k+'\" id=\"filter_'+k+'\" class=\"text fparam ui-widget-content ui-corner-all tab-'+t+'\" value=\"'+((fparam[t]&&fparam[t][k])?fparam[t][k]:widget.other_validator[t][k])+'\" />';
					}
				}
				tabs += '</div>';
			}
			html += '<div id=\"tabs\"><ul>'+li+'</ul>'+tabs+'</div>';
		}
		
		$('#dialog-form fieldset').html(html);
		
		$('#tabs').tabs();
		
		// Show form
		$('#dialog-form').dialog('open');
	});
	
	$('#field_type').change(function() {
		setFields($(this).val());
	});
	
	$('#widgetlist').change(function() {
		if ($(this).val()) {
			$('div.widgetparams').show(500);
		} else {
			$('div.widgetparams').hide(500);
		}
		
	});
	
	// show all function 
	$('div.form p.note').append('<br/><a href=\"#\" id=\"showAll\">".UserModule::t('Show all')."</a>');
 	$('#showAll').click(function(){
		$('div.row').show(500);
		return false;
	});
	
	// init
	setFields($('#field_type').val());
	
	";
		$cs->registerScript(__CLASS__.'#dialog', $js);
	}

}