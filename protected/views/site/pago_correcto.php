<?php $this->pageTitle=Yii::app()->name . ' - Correcto'; ?>
<div class="row-fluid print-show">
	<div class="span12">
		Proemoción - Tu web de promociones
	</div>
</div>			

<div class="row-fluid">
	<div class="span12">
		<h2>¡Correcto!</h2>
		<div class="alert alert-success"><strong>El pago se ha realizado correctamente.</strong> ¡Gracias por confiar en Proemoción!</div>
	</div>
</div>

<div class="row-fluid">
	<div class="span12">
		<center><?php 
			$this->widget('bootstrap.widgets.TbButton', array(
    				'label'=>'Ver más promociones',
    				'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    				'size'=>'large', // null, 'large', 'small' or 'mini'
    				'icon'=>' icon-gift icon-white',
    				'url'=>array('/')
			));
		?></center>
	</div>
</div>
<div class="clearfix">&nbsp;</div>
<div class="row-fluid">
	<div class="span12">
		Puedes ver tus compras realizadas en el <?php echo CHtml::link ('panel de usuario', Yii::app()->getModule('user')->profileUrl); ?>
	</div>
</div>
<div class="clearfix">&nbsp;</div>