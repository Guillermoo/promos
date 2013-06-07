<?php echo __FILE__; ?>
<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Profile");
/*$this->breadcrumbs=array(
	UserModule::t("Profile"),
);*/
?><h1><?php echo UserModule::t('Your company'); ?></h1>

<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
<div class="success">
	<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
</div>
<?php endif; ?>

<fieldset>
	<div class="row">
    	<?php $this->renderPartial('_form',array('model'=>$model,'categorias'=>$categorias, 'cuentas'=>$cuentas, 'image'=>$image) );?>
	</div>
	
</fieldset>

<?php $this->endWidget(); ?>

