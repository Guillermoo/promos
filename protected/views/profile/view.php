<?php
/* @var $this ProfileController */
/* @var $model Profile */

$this->breadcrumbs=array(
	'Profiles'=>array('index'),
	$model->user_id,
);

$this->menu=array(
	array('label'=>'List Profile', 'url'=>array('index')),
	array('label'=>'Create Profile', 'url'=>array('create')),
	array('label'=>'Update Profile', 'url'=>array('update', 'id'=>$model->user_id)),
	array('label'=>'Delete Profile', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->user_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Profile', 'url'=>array('admin')),
);
?>

<h1>View Profile #<?php echo $model->user_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'user_id',
		'username',
		'lastname',
		'contacto_id',
		'paypal_id',
		'tipocuenta',
		'fecha_creacion',
		'fecha_fin',
		'fecha_pago',
	),
)); ?>
