<?php if(YII_RUTAS == true) echo __FILE__; ?>
<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Profile");?>

<h1><?php echo UserModule::t('Tu perfil'); ?></h1>
<?php if(UserModule::isCompany()){
	$this->renderPartial('_form', array('model'=>$model));
}elseif(UserModule::isBuyer()){
     $this->renderPartial('_form', array('model'=>$model));
}else{
    echo "No accesible";
}
?>
 	
