<?php
/* @var $this UsersCuentasController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Users Cuentases',
);

$this->menu=array(
	array('label'=>'Create UsersCuentas', 'url'=>array('create')),
	array('label'=>'Manage UsersCuentas', 'url'=>array('admin')),
);
?>

<h1>Users Cuentases</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
