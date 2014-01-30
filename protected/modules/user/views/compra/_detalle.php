<?php
/* @var $this CompraController */
/* @var $data Compra */
?>
<div class="view well">
<li>	
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
<?php echo CHtml::link('Información del comprador',array('profile/verDatos/id/'.$data->id_usuario),array('class'=>'btn btn-success')); ?>
<div class="row-fluid"><?php echo CHtml::link('Crea un pdf', array('compra/comprobarCompra/id/'.$data->id_promo)); ?></div>
<div class="row-fluid"><?php echo CHtml::link('Crea un pdf', array('compra/creaPdf/id/'.$data->id_promo)); ?></div>
</div>

