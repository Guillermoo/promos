<?php
/* @var $this EmpresaController */
/* @var $model Empresa */

/*$this->breadcrumbs=array(
	'Empresas'=>array('empresa'),
	$model->nombre,
);*/

/*$this->menu=array(
	array('label'=>'List Empresa', 'url'=>array('index')),
	array('label'=>'Create Empresa', 'url'=>array('create')),
	array('label'=>'Update Empresa', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Empresa', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->empresa_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Empresa', 'url'=>array('admin')),
);*/
?>

<h1><?php echo $model->nombre; ?></h1>


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'nombre',
		'web',
		'twitter',
		'facebook',
		'urlTienda',
		'modificado',
	),
)); ?>
<h3> Promociones de <?php echo $model->nombre; ?>:</h3>

