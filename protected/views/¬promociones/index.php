<?php
/* @var $this PromocionesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Promociones',
);

$this->menu=array(
	array('label'=>'Create Promociones', 'url'=>array('create')),
	array('label'=>'Manage Promociones', 'url'=>array('admin')),
);
?>

<h1>Promociones</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
