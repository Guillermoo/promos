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
		//comprobamos el tipo de usuario y su estado para cargar un menú personalizado, tanto para el usuario como para su estado (tipo de cuenta o estado de la misma, etc...)		
		if (Yii::app()->authManager->checkAccess('admin', Yii::app()->user->id) || Yii::app()->authManager->checkAccess('superadmin', Yii::app()->user->id))
			$this->render('adminMenu');
		else{			
			if(Yii::app()->authManager->checkAccess('comprador', Yii::app()->user->id)){
				$this->render('usuarioMenu');
			}else{		
				$this->render('empresaMenu');
			}
		}
	}
}