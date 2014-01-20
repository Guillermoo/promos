<?php
/* @var $this CompraController */
/* @var $data Compra */
?>
<div class="view well">
<li>
	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::encode($data->id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_promo')); ?>:</b>
	<?php echo CHtml::encode($data->id_promo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_compra')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_compra); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado')); ?>:</b>
	<?php if($data->estado == 1): ?>
			<span class="label label-success">Compra realizada </span>
	<?php else: ?>
			<span class="label label-warning"> En proceso </span>
	<?php endif; ?>
	<div class ="clearfix">&nbsp;</div>
</li>

<?php
if($data->votos_suma==0): ?>
		<div class="alert alert-info">Todavía no se ha valorado esta promoción</strong></div>
	<?php else: ?>
		<div class="alert alert-success">Esta promoción ha sido valorada con una media de: <strong><?php echo $data->votos_media ?></strong> entre <strong><?php echo $data->votos_suma ?></strong> votos.</div>
<?php endif; ?>
</div>

<?php //Datos del usuario que ha realizado la compra: ?>
