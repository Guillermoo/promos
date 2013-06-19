<h1><?php echo UserModule::t("Registration Company - Step 2"); ?></h1>
<h2><?php echo UserModule::t("These information is necesary to be able to sell promotions"); ?></h2>
<?php if(Yii::app()->user->hasFlash('registration')): ?>
	<div class="success">
	<?php echo Yii::app()->user->getFlash('registration'); ?>
	</div>
<?php else: ?>

<div class="form">
	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'empresa-form',
		'enableAjaxValidation'=>true,
		'action'=>'empresa/actualizacontacto',
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
		'htmlOptions' => array('enctype'=>'multipart/form-data'),
	)); ?>

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
	
	<?php echo $form->errorSummary(array($model)); ?>
	
	<div class="row">
	<?php echo $form->labelEx($model->empresa,'nombre'); ?>
	<?php echo $form->textField($model->empresa,'nombre'); ?>
	<?php echo $form->error($model->empresa,'nombre'); ?>
	</div>
	
	<div class="row">
	<?php echo $form->labelEx($model->empresa,'cif'); ?>
	<?php echo $form->textField($model->empresa,'cif'); ?>
	<?php echo $form->error($model->empresa,'cif'); ?>
	</div>
	
	<div class="row">
	<?php echo $form->labelEx($model->profile,'direccion'); ?>
	<?php echo $form->textField($model->profile,'direccion'); ?>
	<?php echo $form->error($model->profile,'direccion'); ?>
	</div>
	
	<div class="row">
	<?php echo $form->labelEx($model->profile,'cp'); ?>
	<?php echo $form->textField($model->profile,'cp'); ?>
	<?php echo $form->error($model->profile,'cp'); ?>
	</div>
	
	<div class="row">
	<?php echo $form->labelEx($model->profile,'poblacion_id'); ?>
	<?php echo $form->textField($model->profile,'poblacion_id'); ?>
	<?php echo $form->error($model->profile,'poblacion_id'); ?>
	</div>
	
	<div class="row">
	<?php echo $form->labelEx($model->profile,'telefono'); ?>
	<?php echo $form->textField($model->profile,'telefono'); ?>
	<?php echo $form->error($model->profile,'telefono'); ?>
	</div>
	
	<div class="row submit">
		<?php echo CHtml::submitButton(UserModule::t("Next")); ?>
	</div>
	
	<?php $this->endWidget(); ?>

	


</div><!-- form -->
<?php endif; ?>