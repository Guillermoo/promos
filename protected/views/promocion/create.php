<?php
/* @var $this PromocionesController */
/* @var $model Promociones */

$this->breadcrumbs=array(
	'Promociones'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Promociones', 'url'=>array('index')),
	array('label'=>'Manage Promociones', 'url'=>array('admin')),
);
?>

<h1>Create Promociones</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>