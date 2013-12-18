<?php
/* @var $this VotoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Votos',
);

$this->menu=array(
	array('label'=>'Create Voto', 'url'=>array('create')),
	array('label'=>'Manage Voto', 'url'=>array('admin')),
);
?>

<h1>Votos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
