<?php
/* @var $this CuentaController */
/* @var $model Cuenta */

$this->breadcrumbs=array(
	'Cuentas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Cuenta', 'url'=>array('index')),
	array('label'=>'Manage Cuenta', 'url'=>array('admin')),
);
?>

<h1>Create Cuenta</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>