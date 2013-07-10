<?php
class CuentaController extends Controller{

	public $layout = 'column2';
	public $defaultAction = 'home';

	private $model;
	private $cuentas;

		public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('home'),
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

	public function actionHome(){
		$model = $this->loadUser();
		
		$this->render('home',array('model'=>$model,));
	}

	public function actionVercuentas(){
		$model = $this->loadUser();

		$this->render('cuentas',array('model'=>$model));
	}

	public function loadUser()
	{
		if($this->model===null)
		{
			if(Yii::app()->user->id)
				$this->model=Yii::app()->controller->module->user();
			if($this->model===null)
				$this->redirect(Yii::app()->controller->module->loginUrl);
		}
		return $this->model;
	}

}
?>