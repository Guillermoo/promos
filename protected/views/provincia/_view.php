<?php
/* @var $this ProvinciaController */
/* @var $data Provincia */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idprovincia')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idprovincia), array('view', 'id'=>$data->idprovincia)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('provincia')); ?>:</b>
	<?php echo CHtml::encode($data->provincia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('provinciaseo')); ?>:</b>
	<?php echo CHtml::encode($data->provinciaseo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('provincia3')); ?>:</b>
	<?php echo CHtml::encode($data->provincia3); ?>
	<br />


</div>