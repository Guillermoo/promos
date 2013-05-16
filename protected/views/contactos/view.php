<?php
/* @var $this ContactosController */
/* @var $model Contactos */

$this->breadcrumbs=array(
	'Contactoses'=>array('index'),
	$model->user_id,
);

$this->menu=array(
	array('label'=>'List Contactos', 'url'=>array('index')),
	array('label'=>'Create Contactos', 'url'=>array('create')),
	array('label'=>'Update Contactos', 'url'=>array('update', 'id'=>$model->user_id)),
	array('label'=>'Delete Contactos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->user_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Contactos', 'url'=>array('admin')),
);
?>

<h1>View Contactos #<?php echo $model->user_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'user_id',
		'telefono',
		'fax',
		'cp',
		'barrio',
		'direccion',
		'poblacion_id',
	),
)); ?>
