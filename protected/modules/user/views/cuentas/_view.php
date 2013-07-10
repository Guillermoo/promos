<?php
/* @var $this CuentasController */
/* @var $data Cuentas */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('titulo')); ?>:</b>
	<?php echo CHtml::encode($data->titulo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('precio')); ?>:</b>
	<?php echo CHtml::encode($data->precio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prom_activ')); ?>:</b>
	<?php echo CHtml::encode($data->prom_activ); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prom_stock')); ?>:</b>
	<?php echo CHtml::encode($data->prom_stock); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prom_dest')); ?>:</b>
	<?php echo CHtml::encode($data->prom_dest); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('desc_trim')); ?>:</b>
	<?php echo CHtml::encode($data->desc_trim); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desc_sem')); ?>:</b>
	<?php echo CHtml::encode($data->desc_sem); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desc_ano')); ?>:</b>
	<?php echo CHtml::encode($data->desc_ano); ?>
	<br />

	*/ ?>

</div>