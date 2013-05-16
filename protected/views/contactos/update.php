<?php
/* @var $this ContactosController */
/* @var $model Contactos */

$this->breadcrumbs=array(
	'Contactoses'=>array('index'),
	$model->user_id=>array('view','id'=>$model->user_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Contactos', 'url'=>array('index')),
	array('label'=>'Create Contactos', 'url'=>array('create')),
	array('label'=>'View Contactos', 'url'=>array('view', 'id'=>$model->user_id)),
	array('label'=>'Manage Contactos', 'url'=>array('admin')),
);
?>

<h1>Update Contactos <?php echo $model->user_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>