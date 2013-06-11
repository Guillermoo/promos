<?php

class DefaultController extends Controller
{
	/* hugo */
	public $layout = "column2";
	/* ----- */
	/**
	 * Lists all models.
	 */
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