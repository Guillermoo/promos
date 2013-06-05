<?php
/* @var $this EmpresaController */
/* @var $model Empresa */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'empresa-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'usuario_id'); ?>
		<?php echo $form->textField($model,'usuario_id'); ?>
		<?php echo $form->error($model,'usuario_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'contacto_id'); ?>
		<?php echo $form->textField($model,'contacto_id'); ?>
		<?php echo $form->error($model,'contacto_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'categoria_id'); ?>
		<?php echo $form->textField($model,'categoria_id'); ?>
		<?php echo $form->error($model,'categoria_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'logo_id'); ?>
		<?php echo $form->textField($model,'logo_id'); ?>
		<?php echo $form->error($model,'logo_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cif'); ?>
		<?php echo $form->textField($model,'cif',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'cif'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'web'); ?>
		<?php echo $form->textField($model,'web',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'web'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'twitter'); ?>
		<?php echo $form->textField($model,'twitter',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'twitter'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'facebook'); ?>
		<?php echo $form->textField($model,'facebook',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'facebook'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'urlTienda'); ?>
		<?php echo $form->textField($model,'urlTienda',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'urlTienda'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'creado'); ?>
		<?php echo $form->textField($model,'creado'); ?>
		<?php echo $form->error($model,'creado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'modificado'); ?>
		<?php echo $form->textField($model,'modificado'); ?>
		<?php echo $form->error($model,'modificado'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->