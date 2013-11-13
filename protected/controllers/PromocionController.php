<?php

class PromocionController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';
	public $defaultAction = 'index'; 
	
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			/*array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin','delete'),
				'users'=>array(Yii::app()->getModule('user')->user()->username),
			),*/
			/*array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(),
				'users'=>array(Yii::app()->getModule('user')->user()->username),
			),*/
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($title_slug='')
	{
		//$dataProvider=new CActiveDataProvider('Promocion');
		
		if (isset($title_slug)){
			
			$promocion=Promocion::model()->findByAttributes(array('titulo_slug'=>$title_slug));

			if (isset($promocion)){
				$this->render('view',array(
					'model'=>$promocion,
				));
				Yii::app()->end();
			}
		}

		$this->render('error');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$criteria=new CDbCriteria;
        $criteria->with = array( 'item');

        $criteria->limit = 4;
        $criteria->compare('estado',Promocion::STATUS_ACTIVA);
        $criteria->select = 'titulo,titulo_slug,resumen,precio';
        $criteria->order = 'RAND()';
        //$criteria->addCondition('exp_d > "'.$now.'" ');

		$promociones = Promocion::model()->findAll($criteria);
		
		$this->render('index',array(
			'model'=>$promociones,
		));
	}
	
	public function actionPromosEmpresa($id){
		$dataProvider = new CActiveDataProvider('Promocion', array(
				'pagination'=>array(
				'pageSize'=>10,
			),
			'criteria'=>array(
				'condition'=>'estado='.Promocion::STATUS_ACTIVA,
				//'params'=>array('estado'=>Promocion::STATUS_ACTIVA),
			),
			'sort'=>array(
				//Hay que poner que sea aleatorio como segunda opcion y que sean de distintas categorias
				'defaultOrder'=> array('destacado'=>Promocion::IS_DESTACADA),
			)
		));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
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
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Promocion the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$this->_model=Promocion::model()->findByPk($id);
		if($this->_model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $this->_model;
	}
	
	public function loadUser()
	{
		if(Yii::app()->user->id)
			$user=Yii::app()->controller->module->user();
			
		return $user;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Promocion $model the model to be validated
	 */
	/*protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='promociones-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}*/
	
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
		
		$js = "
			$('#buttonStateful').click(function() {
			    var btn = $(this);
			    btn.button('loading'); // call the loading function
			    setTimeout(function() {
			        btn.button('reset'); // call the reset function
		    }, 3000);
		    
		    function loading() {
			}
			
			"
	    ;
	}

	
	
}
