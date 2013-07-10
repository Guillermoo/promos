<?php
/* @var $this CuentasController */
/* @var $model Cuentas */

$this->breadcrumbs=array(
	'Cuentases'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Cuentas', 'url'=>array('index')),
	array('label'=>'Create Cuentas', 'url'=>array('create')),
	array('label'=>'Update Cuentas', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Cuentas', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Cuentas', 'url'=>array('admin')),
);
?>

<h1>View Cuentas #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'titulo',
		'descripcion',
		'precio',
		'prom_activ',
		'prom_stock',
		'prom_dest',
		'desc_trim',
		'desc_sem',
		'desc_ano',
	),
)); ?>
