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
    if(!isset($model->profile) || $model->status == 1): ?>
        <div class="alert alert-warning">
        <b>Debe rellenar los datos de su perfil.</b> Esto es IMPRESCINDIBLE para poder realizar ventas
    </div>
    <?php endif; ?>

    <?php if($model->profile->fecha_fin != '0000-00-00' && (strtotime($model->profile->fecha_fin) < strtotime(date('Y-m-d')))): ?>
        <div class="alert alert-error">
            <b>Su Bono ha caducado.</b> Para poder publicar promociones tienes que adquirir un nuevo bono.
        </div>
    <?php endif; ?>

    <?php if(strtotime($model->profile->fecha_fin) == strtotime(date('Y-m-d'))): ?>
        <div class="alert alert-warning">
            <b>Su Bono caduca hoy.</b> Cuando el Bono esté caducado no podrá seguir publicando promociones. Para ello tendrás que adquirir un nuevo Bono.
        </div>
    <?php endif; ?>

    <?php $this->renderPartial('_form', array('model'=>$model));
}else{   
    if(!isset($model->profile)): ?>
        <div class="alert alert-warning">
            <b>Debe rellenar los datos de su perfil.</b> Esto es IMPRESCINDIBLE para poder comprar promociones.
        </div>
    <?php endif;
     $this->renderPartial('_form', array('model'=>$model));    
}
?>
 	
