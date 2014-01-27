<h1>Listado de ventas</h1>
<div class="row-fluid"><?php echo CHtml::link('Crea un pdf', array('compra/creaPdf')); ?></div>
<div class="row-fluid">
	<div class="span12">
		<ul class="thumbnails product-list-inline-small">
			<?php $this->widget('zii.widgets.CListView', array(
				'dataProvider'=>$dataProvider,
				'itemView'=>'_detalle',
			)); ?>
		</ul>
	</div>
</div>