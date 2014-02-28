<?php
/* @var $this UsersCuentasController */
/* @var $model UsersCuentas */

$this->breadcrumbs=array(
	'Users Cuentases'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UsersCuentas', 'url'=>array('index')),
	array('label'=>'Create UsersCuentas', 'url'=>array('create')),
	array('label'=>'Update UsersCuentas', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UsersCuentas', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UsersCuentas', 'url'=>array('admin')),
);
?>

<h1>View UsersCuentas #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_usuario',
		'id_cuenta',
		'fecha_inicio',
		'fecha_fin',
		'cant_pagado',
		'estado',
	),
)); ?>
