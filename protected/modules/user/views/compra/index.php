<?php
/* @var $this CompraController */
/* @var $dataProvider CActiveDataProvider */

/*$this->menu=array(
	array('label'=>'Create Compra', 'url'=>array('create')),
	array('label'=>'Manage Compra', 'url'=>array('admin')),
);*/
?>

<h1>Promociones que has comprado</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
