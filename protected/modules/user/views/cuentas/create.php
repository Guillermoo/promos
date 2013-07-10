<?php
/* @var $this CuentasController */
/* @var $model Cuentas */

$this->breadcrumbs=array(
	'Cuentases'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Cuentas', 'url'=>array('index')),
	array('label'=>'Manage Cuentas', 'url'=>array('admin')),
);
?>

<h1>Create Cuentas</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>