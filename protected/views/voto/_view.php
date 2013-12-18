<?php
/* @var $this VotoController */
/* @var $data Voto */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('votos_cantidad')); ?>:</b>
	<?php echo CHtml::encode($data->votos_cantidad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('votos_media')); ?>:</b>
	<?php echo CHtml::encode($data->votos_media); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('votos_suma')); ?>:</b>
	<?php echo CHtml::encode($data->votos_suma); ?>
	<br />


</div>