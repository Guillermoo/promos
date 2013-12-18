<?php
/* @var $this VotoController */
/* @var $model Voto */

$this->breadcrumbs=array(
	'Votos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Voto', 'url'=>array('index')),
	array('label'=>'Create Voto', 'url'=>array('create')),
	array('label'=>'View Voto', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Voto', 'url'=>array('admin')),
);
?>

<h1>Update Voto <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>