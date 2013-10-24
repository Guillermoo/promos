<?php

Yii::import('zii.widgets.CPortlet');

class UserNav extends CPortlet
{
	public function init()
	{
		$this->title=CHtml::encode(Yii::app()->user->name);
		parent::init();
	}

	protected function renderContent()
	{
		if (UserModule::isAdmin() || UserModule::isSuperAdmin()){
			$this->render('adminNavMenu');
		}
		else{
			if(UserModule::isCompany()){
				$this->render('empresaNavMenu');
			}else{
				$this->render('usuarioNavMenu');
			}
		}
	}
}