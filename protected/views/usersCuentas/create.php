<?php
/* @var $this UsersCuentasController */
/* @var $model UsersCuentas */

$this->breadcrumbs=array(
	'Users Cuentases'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UsersCuentas', 'url'=>array('index')),
	array('label'=>'Manage UsersCuentas', 'url'=>array('admin')),
);
?>

<h1>Create UsersCuentas</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>