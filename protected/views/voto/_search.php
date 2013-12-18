<?php
/* @var $this VotoController */
/* @var $model Voto */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'votos_cantidad'); ?>
		<?php echo $form->textField($model,'votos_cantidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'votos_media'); ?>
		<?php echo $form->textField($model,'votos_media',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'votos_suma'); ?>
		<?php echo $form->textField($model,'votos_suma'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->