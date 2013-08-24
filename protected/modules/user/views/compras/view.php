<?php
/* @var $this ComprasController */
/* @var $model Compras */

$this->breadcrumbs=array(
	'Comprases'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Compras', 'url'=>array('index')),
	array('label'=>'Create Compras', 'url'=>array('create')),
	array('label'=>'Update Compras', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Compras', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Compras', 'url'=>array('admin')),
);
?>

<h1>View Compras #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_usuario',
		'id_promo',
		'fecha_compra',
		'estado',
	),
)); ?>
