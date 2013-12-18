<?php
/* @var $this VotoController */
/* @var $model Voto */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'voto-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'votos_cantidad'); ?>
		<?php echo $form->textField($model,'votos_cantidad'); ?>
		<?php echo $form->error($model,'votos_cantidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'votos_media'); ?>
		<?php echo $form->textField($model,'votos_media',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'votos_media'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'votos_suma'); ?>
		<?php echo $form->textField($model,'votos_suma'); ?>
		<?php echo $form->error($model,'votos_suma'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->