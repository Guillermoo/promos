<?php
/* @var $this ProvinciaController */
/* @var $model Provincia */

$this->breadcrumbs=array(
	'Provincias'=>array('index'),
	$model->idprovincia=>array('view','id'=>$model->idprovincia),
	'Update',
);

$this->menu=array(
	array('label'=>'List Provincia', 'url'=>array('index')),
	array('label'=>'Create Provincia', 'url'=>array('create')),
	array('label'=>'View Provincia', 'url'=>array('view', 'id'=>$model->idprovincia)),
	array('label'=>'Manage Provincia', 'url'=>array('admin')),
);
?>

<h1>Update Provincia <?php echo $model->idprovincia; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>