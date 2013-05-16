<?php
/* @var $this ContactosController */
/* @var $model Contactos */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contactos-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telefono'); ?>
		<?php echo $form->textField($model,'telefono',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'telefono'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fax'); ?>
		<?php echo $form->textField($model,'fax',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'fax'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cp'); ?>
		<?php echo $form->textField($model,'cp',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'cp'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'barrio'); ?>
		<?php echo $form->textField($model,'barrio'); ?>
		<?php echo $form->error($model,'barrio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'direccion'); ?>
		<?php echo $form->textField($model,'direccion',array('size'=>60,'maxlength'=>120)); ?>
		<?php echo $form->error($model,'direccion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'poblacion_id'); ?>
		<?php echo $form->textField($model,'poblacion_id'); ?>
		<?php echo $form->error($model,'poblacion_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->