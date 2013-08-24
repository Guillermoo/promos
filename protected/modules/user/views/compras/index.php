<?php
/* @var $this ComprasController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Comprases',
);

$this->menu=array(
	array('label'=>'Create Compras', 'url'=>array('create')),
	array('label'=>'Manage Compras', 'url'=>array('admin')),
);
?>

<h1>Comprases</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
