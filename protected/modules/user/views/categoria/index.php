<?php
/* @var $this CategoriaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Categorias',
);

$this->menu=array(
	array('label'=>'Create Categoria', 'url'=>array('create')),
	array('label'=>'Manage Categoria', 'url'=>array('admin')),
);
?>

<h1>Categorias</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
