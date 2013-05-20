<?php
/* @var $this ProvinciaController */
/* @var $model Provincia */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'provincia-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'provincia'); ?>
		<?php echo $form->textField($model,'provincia',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'provincia'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'provinciaseo'); ?>
		<?php echo $form->textField($model,'provinciaseo',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'provinciaseo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'provincia3'); ?>
		<?php echo $form->textField($model,'provincia3',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'provincia3'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->