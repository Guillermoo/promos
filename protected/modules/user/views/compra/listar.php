<h1>Listado de ventas</h1>
<h3>Total ventas:  <span class="label label-warning"><?php echo $dataProvider->getTotalItemCount(); ?></span></h3>
<div class="row-fluid">
	<div class="span12">
		<ul class="thumbnails product-list-inline-small">
			<?php $this->widget('zii.widgets.CListView', array(
				'dataProvider'=>$dataProvider,
				'itemView'=>'_compra',
			)); ?>
		</ul>
	</div>
</div>