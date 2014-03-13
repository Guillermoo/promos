<h1>Asignar un Bono a una empresa</h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cuenta-form',
	'enableAjaxValidation'=>false,
	'action'=>array('cuentas/usuarioCuenta'),
)); ?>
	<div class="row">
	<?php echo $form->errorSummary($models); ?>
	
	<?php echo $form->hiddenField($user,'id'); ?>
	<?php 
  		// format models as $key=>$value with listData
		$list = CHtml::listData($models, 
                'id', 'titulo');
	?>

	<?php echo CHtml::dropDownList('idCuenta', 0, 
        	$list,
        	array('empty' => '(Elige un bono'));
    ?>
    </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->