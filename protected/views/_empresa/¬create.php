<?php
/* @var $this EmpresaController */
/* @var $model Empresa */

$this->breadcrumbs=array(
	'Empresas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Empresa', 'url'=>array('index')),
	array('label'=>'Manage Empresa', 'url'=>array('admin')),
);
?>

<h1>Create Empresa</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>