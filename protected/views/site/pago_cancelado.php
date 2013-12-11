<?php $this->pageTitle=Yii::app()->name . ' - Cancelado'; ?>
<div class="row-fluid print-show">
	<div class="span12">
		Proemoción - Tu web de promociones
	</div>
</div>			

<div class="row-fluid">
	<div class="span12">
		<div class="alert alert-warning"><strong>El pago ha sido cancelado</strong></div>
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