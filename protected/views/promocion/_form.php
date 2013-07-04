<?php
/* @var $this PromocionesController */
/* @var $model Promociones */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'promociones-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
		<?php echo $form->error($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'estado'); ?>
		<?php echo $form->textField($model,'estado'); ?>
		<?php echo $form->error($model,'estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'titulo'); ?>
		<?php echo $form->textField($model,'titulo',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'titulo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'slug'); ?>
		<?php echo $form->textField($model,'slug',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'slug'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'resumen'); ?>
		<?php echo $form->textField($model,'resumen',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'resumen'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'descripcion'); ?>
		<?php echo $form->textField($model,'descripcion',array('size'=>60,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'descripcion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'descripcion_html'); ?>
		<?php echo $form->textField($model,'descripcion_html',array('size'=>60,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'descripcion_html'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_inicio'); ?>
		<?php echo $form->textField($model,'fecha_inicio'); ?>
		<?php echo $form->error($model,'fecha_inicio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha_fin'); ?>
		<?php echo $form->textField($model,'fecha_fin'); ?>
		<?php echo $form->error($model,'fecha_fin'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fechaCreacion'); ?>
		<?php echo $form->textField($model,'fechaCreacion'); ?>
		<?php echo $form->error($model,'fechaCreacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'destacado'); ?>
		<?php echo $form->textField($model,'destacado'); ?>
		<?php echo $form->error($model,'destacado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'precio'); ?>
		<?php echo $form->textField($model,'precio',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'precio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rebaja'); ?>
		<?php echo $form->textField($model,'rebaja',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'rebaja'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'condiciones'); ?>
		<?php echo $form->textField($model,'condiciones',array('size'=>60,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'condiciones'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'agotado'); ?>
		<?php echo $form->textField($model,'agotado'); ?>
		<?php echo $form->error($model,'agotado'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->