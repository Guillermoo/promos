<?php
/* @var $this VotoController */
/* @var $model Voto */

$this->breadcrumbs=array(
	'Votos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Voto', 'url'=>array('index')),
	array('label'=>'Create Voto', 'url'=>array('create')),
	array('label'=>'Update Voto', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Voto', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Voto', 'url'=>array('admin')),
);
?>

<h1>View Voto #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'votos_cantidad',
		'votos_media',
		'votos_suma',
	),
)); ?>
