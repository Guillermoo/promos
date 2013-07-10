<?php
/* @var $this CuentasController */
/* @var $model Cuentas */

$this->breadcrumbs=array(
	'Cuentases'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Cuentas', 'url'=>array('index')),
	array('label'=>'Create Cuentas', 'url'=>array('create')),
	array('label'=>'View Cuentas', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Cuentas', 'url'=>array('admin')),
);
?>

<h1>Update Cuentas <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>