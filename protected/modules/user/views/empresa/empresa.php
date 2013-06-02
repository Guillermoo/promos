<?php echo __FILE__; ?>
<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Profile");
/*$this->breadcrumbs=array(
	UserModule::t("Profile"),
);*/
?><h1><?php echo UserModule::t('Your company'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'empresa'=>$empresa,'contacto'=>$contacto,'cuentas'=>$cuentas,'logo'=>$logo)); ?>

