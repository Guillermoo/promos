<?php
/* @var $this CuentasController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cuentases',
);

$this->menu=array(
	array('label'=>'Create Cuentas', 'url'=>array('create')),
	array('label'=>'Manage Cuentas', 'url'=>array('admin')),
);
?>

<h1>Cuentases</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
