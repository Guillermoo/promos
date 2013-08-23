<?php
/* @var $this ComprasController */
/* @var $model Compras */

$this->breadcrumbs=array(
	'Comprases'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Compras', 'url'=>array('index')),
	array('label'=>'Manage Compras', 'url'=>array('admin')),
);
?>

<h1>Create Compras</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>