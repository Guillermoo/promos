<?php
/* @var $this CuentaController */
/* @var $model Cuenta */

$this->breadcrumbs=array(
	'Cuentas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Cuenta', 'url'=>array('index')),
	array('label'=>'Create Cuenta', 'url'=>array('create')),
	array('label'=>'View Cuenta', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Cuenta', 'url'=>array('admin')),
);
?>

<h1>Update Cuenta <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>