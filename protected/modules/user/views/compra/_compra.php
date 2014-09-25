<?php
/* @var $this CompraController */
/* @var $data Compra */
?>
<?php //$this->debug($data); ?>
<div class="view well">
<li>	
	Comprador: <b><?php echo CHtml::link($data->usuario->email,array('user/verUsuario/id/'.$data->usuario->id)); ?></b>
	<br/>
	<b><?php echo CHtml::encode($data->getAttributeLabel('referencia')); ?>:</b>
	<span class="label label-info"><?php echo CHtml::encode($data->referencia); ?></span>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_compra')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_compra); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado')); ?>:</b>
	<?php if($data->estado == 1): ?>
			<span >Compra realizada </span>
	<?php else: ?>
			<span class="label label-warning"> En proceso </span>
	<?php endif; ?>
	<div class ="clearfix">&nbsp;</div>
</li>
<span><?php 
	echo CHtml::link('Ver Cupón',array('compra/view/id/'.$data->id),array('class'=>'btn btn-success')); ?></span>
</div>

