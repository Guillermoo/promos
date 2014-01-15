<?php if(YII_RUTAS == true) echo __FILE__; ?>
<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Profile");?>

<h1><?php echo UserModule::t('Tu perfil'); ?></h1>
<?php if(UserModule::isCompany()){
	if($model->status == 2):?>
    <div class="alert alert-warning">
        <b>No se ha verificado el pago de la suscripción.</b> Si ya ha efectuado el pago, por favor, <?php echo CHtml::link('contacte con el administrador','site/contact'); ?>
    </div>
<?php endif; 
if($model->status == 1):?>
    <div class="alert alert-warning">
        <b>Debe rellenar los datos de su perfil.</b> Esto es IMPRESCINDIBLE para ponder realizar ventas
    </div>
<?php endif; 
	$this->renderPartial('_form', array('model'=>$model));
}elseif(UserModule::isBuyer()){
     $this->renderPartial('_form', array('model'=>$model));
}else{
    echo "No accesible";
}
?>
 	
