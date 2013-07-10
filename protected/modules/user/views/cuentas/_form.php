<?php
/* @var $this CuentasController */
/* @var $model Cuentas */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cuentas-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'titulo'); ?>
		<?php echo $form->textField($model,'titulo',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'titulo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'descripcion'); ?>
		<?php echo $form->textField($model,'descripcion',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'descripcion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'precio'); ?>
		<?php echo $form->textField($model,'precio',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'precio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'prom_activ'); ?>
		<?php echo $form->textField($model,'prom_activ',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'prom_activ'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'prom_stock'); ?>
		<?php echo $form->textField($model,'prom_stock',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'prom_stock'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'prom_dest'); ?>
		<?php echo $form->textField($model,'prom_dest',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'prom_dest'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'desc_trim'); ?>
		<?php echo $form->textField($model,'desc_trim',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'desc_trim'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'desc_sem'); ?>
		<?php echo $form->textField($model,'desc_sem',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'desc_sem'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'desc_ano'); ?>
		<?php echo $form->textField($model,'desc_ano',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'desc_ano'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->