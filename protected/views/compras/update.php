<?php
/* @var $this ComprasController */
/* @var $model Compras */

$this->breadcrumbs=array(
	'Comprases'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Compras', 'url'=>array('index')),
	array('label'=>'Create Compras', 'url'=>array('create')),
	array('label'=>'View Compras', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Compras', 'url'=>array('admin')),
);
?>

<h1>Update Compras <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>