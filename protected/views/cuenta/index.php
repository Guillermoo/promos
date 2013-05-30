<?php
/* @var $this CuentaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cuentas',
);

$this->menu=array(
	array('label'=>'Create Cuenta', 'url'=>array('create')),
	array('label'=>'Manage Cuenta', 'url'=>array('admin')),
);
?>

<h1>Cuentas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
