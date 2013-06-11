<?php

class PromocionController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	public $defaultAction = 'promocion';
	
	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;
	
	
/*  
	 * (G)De momento abrimos home que no hay nada pensado en que se mostrará.
	 * Dejo el código comentado por si hace falta.
	 * */
	public function actionPromocion()
	{
		$_model = $this->loadUser();
		
	    $this->render('promocion',array(
	    	'model'=>$_model,
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
	

	
}