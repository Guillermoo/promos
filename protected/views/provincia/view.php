<?php
/* @var $this ProvinciaController */
/* @var $model Provincia */

$this->breadcrumbs=array(
	'Provincias'=>array('index'),
	$model->idprovincia,
);

$this->menu=array(
	array('label'=>'List Provincia', 'url'=>array('index')),
	array('label'=>'Create Provincia', 'url'=>array('create')),
	array('label'=>'Update Provincia', 'url'=>array('update', 'id'=>$model->idprovincia)),
	array('label'=>'Delete Provincia', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idprovincia),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Provincia', 'url'=>array('admin')),
);
?>

<h1>View Provincia #<?php echo $model->idprovincia; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idprovincia',
		'provincia',
		'provinciaseo',
		'provincia3',
	),
)); ?>
