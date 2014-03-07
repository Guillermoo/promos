<h1>Asignar un Bono a una empresa</h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cuenta-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'titulo'); ?>
		<?php echo $form->textField($model,'id'); ?>
		<?php echo $form->error($model,'titulo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->