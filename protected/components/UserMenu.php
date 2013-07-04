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
		if (UserModule::isAdmin() || UserModule::isSuperAdmin())
			$this->render('adminMenu');
		elseif(UserModule::isCompany())
			$this->render('empresaMenu');//He creado un menú como el que tenías(está en components/views/empresaNavMenu
		else
			$this->render('usuarioMenu');
	}
}