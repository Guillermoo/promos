<?php
/* @var $this CompraController */
/* @var $dataProvider CActiveDataProvider */

/*$this->menu=array(
	array('label'=>'Create Compra', 'url'=>array('create')),
	array('label'=>'Manage Compra', 'url'=>array('admin')),
);*/
?>

<h1>Promociones compradas por el usuario</h1>
<div class="row-fluid">
	<div class="span12">
		<ul class="thumbnails product-list-inline-small">
			<?php $this->widget('zii.widgets.CListView', array(
				'dataProvider'=>$dataProvider,
				'itemView'=>'_view',
			)); ?>
		</ul>
	</div>
</div>



