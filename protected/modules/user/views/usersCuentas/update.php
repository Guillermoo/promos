<?php
/* @var $this UsersCuentasController */
/* @var $model UsersCuentas */

$this->breadcrumbs=array(
	'Users Cuentases'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UsersCuentas', 'url'=>array('index')),
	array('label'=>'Create UsersCuentas', 'url'=>array('create')),
	array('label'=>'View UsersCuentas', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UsersCuentas', 'url'=>array('admin')),
);
?>

<h1>Update UsersCuentas <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>