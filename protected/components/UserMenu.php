<?php

Yii::import('zii.widgets.CPortlet');

class UserMenu extends CPortlet
{
	public function init()
	{
		$this->title=CHtml::encode(Yii::app()->user->name);
		parent::init();
	}

	protected function renderContent()
	{
		if (Yii::app()->authManager->checkAccess('admin', Yii::app()->user->id) || Yii::app()->authManager->checkAccess('superadmin', Yii::app()->user->id))
			$this->render('adminMenu');
		else
			$this->render('empresaMenu');
	}
}