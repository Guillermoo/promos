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
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
		array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','create','updateAjax','update','view'),
				'users'=>UserModule::getAdmins(),
		),
		array('deny',  // deny all users
				'users'=>array('*'),
		),
		);
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
	/*public function actionView()
	{
		$model = $this->loadModel();

		$this->render('view',array(
			'model'=>$model,
		));
	}*/

	/**
	 * Crea un nuevo usuario desde el menú administrador. Puede crear compradores, empresas y admins.
	 */
	public function actionCreate()
	{
		$model=new User;

		$this->performAjaxValidation(array($model));

		if(isset($_POST['User']))
		{
			/*Desde el menú de admin el admin sólo podrá crear usuarios
			 con la información mínima(tabla tbl_user)*/
			$model->attributes=$_POST['User'];
			$model->activkey=Yii::app()->controller->module->encrypting(microtime().$model->password);

			if($model->validate()) {
				$model->password=Yii::app()->controller->module->encrypting($model->password);
				if($model->save()) {
					//Asignamos el rol dinámicamente
					$model->setRole();
					$esEmpresa = Yii::app()->authManager->checkAccess('empresa', $model->id);
						
					if($esEmpresa)//(G)Creamos contacto, profile, empresa(si es usuario empresa)
						$model->crearModelosRelacionados();
				}
				$this->redirect(array('admin'));
			} else {
				//	$model->profile->validate();
				//	$contacto->validate();
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'categorias'=>null,
			'esEmpresa'=>false,
			'cuentas'=>null,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$this->_model=$this->loadModel();

		$esEmpresa = Yii::app()->authManager->checkAccess('empresa', $this->_model->id);

		if(isset($_POST['User'])){

			$this->_model->attributes=$_POST['User'];
				
			if ($esEmpresa){
				
				$profile=$this->_model->profile;
				$empresa=$this->_model->empresa;
				$contacto=$this->_model->contacto;
				$this->performAjaxValidation(array($this->_model,$profile,$empresa,$contacto));

				$profile->attributes=$_POST['Profile'];
				$empresa->attributes=$_POST['Empresa'];
				$contacto->attributes=$_POST['Contacto'];
			}else{
				$this->performAjaxValidation(array($this->_model));
			}
				
			if($this->_model->validate()) {
				$old_password = User::model()->notsafe()->findByPk($this->_model->id);
				if ($old_password->password!=$this->_model->password) {
					$this->_model->password=Yii::app()->controller->module->encrypting($this->_model->password);
					$this->_model->activkey=Yii::app()->controller->module->encrypting(microtime().$this->_model->password);
				}
				$this->_model->save();
				if ($esEmpresa){
					$profile->save();
					$empresa->save();
					$contacto->save();
				}
				$this->redirect(array('update', 'id'=>$this->_model->id));
			} else {
				$profile->validate();
			}
		}

		$this->renderParaUsuario();
	}

	private function renderParaUsuario(){

		$esEmpresa = Yii::app()->authManager->checkAccess('empresa', $this->_model->id);

		if($esEmpresa)
			$this->renderParaEmpresa();
		else
			$this->renderParaComprador();
	}

	private function renderParaEmpresa(){

		$cat_model = Category::getCategorias();
		$categorias = CHtml::listData($cat_model,'id', 'name');

		$cuentas = Cuenta::getCuentas();
		$cuentas_list = CHtml::listData($cuentas,'id', 'nombre');

		//Para cargar/gestionar el logo
		Yii::import("xupload.models.XUploadForm");
		$image = new XUploadForm;

		$this->render('update',array(
	    	'model'=>$this->_model,
			'categorias'=>$categorias,
			'esEmpresa'=>true,
			'cuentas'=>$cuentas_list,
			'image'=>$image,
		));
	}

	private function renderParaComprador(){
		
		//Para cargar/gestionar el logo
		Yii::import("xupload.models.XUploadForm");
		$image = new XUploadForm;
		
		$this->render('update',array(
	    	'model'=>$this->_model,
			'categorias'=>null,
			'esEmpresa'=>false,
			'cuentas'=>null,
			'image'=>$image,
		));
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
			$model = $this->loadModel();
				
			if (Yii::app()->authManager->checkAccess('admin', $model->id) || Yii::app()->authManager->checkAccess('superadmin', $model->id)){
				 Yii::app()->user->setFlash('error',"It's not allowed to delete admin users");
			}else{
				try{
					$model->delete();
				    if(!isset($_GET['ajax']))
				        Yii::app()->user->setFlash('success','Normal - Deleted Successfully');
				    else
				        echo "<div class='flash-success'>Ajax - Deleted Successfully</div>";
					}catch(CDbException $e){
					    if(!isset($_GET['ajax']))
					        Yii::app()->user->setFlash('error','Normal - error message');
					    else
					        echo "<div class='flash-error'>Ajax - error message</div>"; //for ajax
					}
					
					// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
					if(!isset($_POST['ajax']))
						$this->redirect(array('/user/admin'));
			}
		}
		else
		throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	public function actionUpdateAjax()
	{
		/*$data = array();
		$data["myValue"] = "Content updated in AJAX";

		$this->renderPartial('_ajaxAdminContent', $data, false, true);*/
	}
	
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($validate)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($validate);
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