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

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'empresa-form',
	'enableAjaxValidation'=>true,
	'action'=>'empresa/edit',
	'htmlOptions' => array('enctype'=>'multipart/form-data')
));
?>

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
	
	<?php if (Yii::app()->authManager->checkAccess('empresa', Yii::app()->user->id) ):?>
		<?php //echo $form->errorSummary(array($model,$empresa,$contacto)); ?>
	<?php endif;?>

	<div class="row">
		<?php echo $form->labelEx($model->empresa,'categoria_id'); ?>
		<?php echo $form->textField($model->empresa,'categoria_id'); ?>
		<?php echo $form->error($model->empresa,'categoria_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model->empresa,'logo_id'); ?>
		<?php echo $form->textField($model->empresa,'logo_id'); ?>
		<?php echo $form->error($model->empresa,'logo_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model->empresa,'cif'); ?>
		<?php echo $form->textField($model->empresa,'cif',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model->empresa,'cif'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model->empresa,'web'); ?>
		<?php echo $form->textField($model->empresa,'web',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model->empresa,'web'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model->empresa,'twitter'); ?>
		<?php echo $form->textField($model->empresa,'twitter',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model->empresa,'twitter'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model->empresa,'facebook'); ?>
		<?php echo $form->textField($model->empresa,'facebook',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model->empresa,'facebook'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model->empresa,'urlTienda'); ?>
		<?php echo $form->textField($model->empresa,'urlTienda',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model->empresa,'urlTienda'); ?>
	</div>
	
	<div class="row">
    	<?php $this->renderPartial('/layouts/_contacto',array('contacto' => $model->contacto) );?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
	
	<?php $this->endWidget(); ?>	
