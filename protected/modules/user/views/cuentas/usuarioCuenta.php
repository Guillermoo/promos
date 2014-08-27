<h1>Asignar un Bono a una empresa</h1>
<div class="clearfix">&nbsp;</div>
<?php if(Yii::app()->user->hasFlash('success')):?>
	<div class="alert alert-success">
		<?php echo Yii::app()->user->getFlash('success'); ?>
	</div>
<?php endif; ?>
<?php if(Yii::app()->user->hasFlash('success')):?>
	<div class="alert alert-error">
		<?php echo Yii::app()->user->getFlash('error'); ?>
	</div>
<?php endif; ?>
<div class="row">
	<p>Usuario beneficiario: <strong><?php echo $model->username." ".$model->lastname; ?></strong></p>
	<p>Fecha de caducidad del Bono: <strong><?php echo $model->fecha_fin; ?></strong></p>	
</div>
<div class="form">	
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cuenta-form',
	'enableAjaxValidation'=>false,
	'method'=>'post',
	)); ?>
	<?php echo $form->hiddenField($model, 'user_id'); ?>
	<div class="clearfix">&nbsp;</div>
	<div class="row">
		<?php echo $form->label($model,'Bono'); ?>
		<?php echo $form->dropDownList($model,'tipocuenta',CHtml::listData(Cuentas::model()->findAll(), 'id', 'titulo'));
		?>		
	</div>
	<div class="clearfix">&nbsp;</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Guardar',array('class' => 'btn btn-primary btn-large')); ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- form -->