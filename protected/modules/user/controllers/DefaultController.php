<?php

class DefaultController extends Controller
{
	
	/**
	 * Lists all models.
	 */
	//hugo-------------------
	//le digo que el layout que utilice por defecto en el dashboard sea column2
	public $layout = "column2";
	/* ---------------------------*/
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('User', array(
			'criteria'=>array(
		        'condition'=>'status>'.User::STATUS_BANNED . ' AND id!='.User::ID_SUPERADMIN,
		    ),
			'pagination'=>array(
				'pageSize'=>Yii::app()->controller->module->user_page_size,
			),
		));

		$this->render('/user/index',array(
			'dataProvider'=>$dataProvider,
		));
	}

}