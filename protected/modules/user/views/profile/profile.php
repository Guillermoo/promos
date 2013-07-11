<?php if(YII_RUTAS == true) echo __FILE__; ?>
<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Profile");?>

<h1><?php echo UserModule::t('Tu perfil'); ?></h1>
<?php if(UserModule::isCompany()):?>
	<?php $this->renderPartial('_form', array('model'=>$model));?>
<?php else:?>
	<?php echo "Is not company"?>
<?php endif;?>
 	
