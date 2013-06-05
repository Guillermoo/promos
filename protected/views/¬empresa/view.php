<?php
/* @var $this EmpresaController */
/* @var $model Empresa */

$this->breadcrumbs=array(
	'Empresas'=>array('index'),
	$model->empresa_id,
);

$this->menu=array(
	array('label'=>'List Empresa', 'url'=>array('index')),
	array('label'=>'Create Empresa', 'url'=>array('create')),
	array('label'=>'Update Empresa', 'url'=>array('update', 'id'=>$model->empresa_id)),
	array('label'=>'Delete Empresa', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->empresa_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Empresa', 'url'=>array('admin')),
);
?>

<h1>View Empresa #<?php echo $model->empresa_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'empresa_id',
		'user_id',
		'contacto_id',
		'categoria_id',
		'logo_id',
		'cif',
		'web',
		'twitter',
		'facebook',
		'urlTienda',
		'creado',
		'modificado',
	),
)); ?>
