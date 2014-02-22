<?php
/* @var $this CompraController */
/* @var $data Compra */
?>
<?php 
	$promo = Promocion::model()->find('id=:id',array(':id'=>$data->id_promo));
?>
<div class="view well">
<li>
	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::encode($data->id); ?>
	<br />

	<b><?php echo CHtml::encode($promo->getAttributeLabel('titulo')); ?>:</b>
	<?php echo CHtml::encode($promo->titulo); ?>
	<br />

	<b><?php echo CHtml::encode($promo->getAttributeLabel('resumen')); ?>:</b>
	<?php echo CHtml::encode($promo->resumen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_compra')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_compra); ?>
	<br />
	
	<div class ="clearfix">&nbsp;</div>
</li>

<?php
if($data->votado == 0 && $data->estado == 1): ?>
		<div class="alert alert-info">Puede votar la promoción <strong><?php echo CHtml::link('haciendo click aquí',array('promocion/votar/id/'.$data->id_promo)); ?></strong></div>
	<?php else: ?>
		<div class="alert alert-success">Ha votado esta promocion. Su valoracion: <strong><?php echo $data->votado ?></strong></div>
<?php endif; ?>
</div>
