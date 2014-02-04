<?php if(YII_RUTAS == true) echo __FILE__; ?>
<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Profile");?>

<h1><?php echo UserModule::t('Tu perfil'); ?></h1>

<?php if(Yii::app()->user->hasFlash('success')): ?>
    <div class="alert alert-success">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>
<?php //$this->debug($model->profile); ?>
<?php if(UserModule::isCompany()){
    if(!isset($model->profile)): ?>
        <div class="alert alert-warning">
        <b>Debe rellenar los datos de su perfil.</b> Esto es IMPRESCINDIBLE para poder realizar ventas
    </div>
<?php endif;
	if($model->status == 2):?>
    <div class="alert alert-warning">
        <b>No se ha verificado el pago de la suscripción.</b> Si ya ha efectuado el pago, por favor, <?php echo CHtml::link('contacte con el administrador','site/contact'); ?>
    </div>
<?php endif; 
	$this->renderPartial('_form', array('model'=>$model));
}else{   
    if(!isset($model->profile)): ?>
        <div class="alert alert-warning">
            <b>Debe rellenar los datos de su perfil.</b> Esto es IMPRESCINDIBLE para poder comprar promociones.
        </div>
    <?php endif;
     $this->renderPartial('_form', array('model'=>$model));    
}
?>
 	
