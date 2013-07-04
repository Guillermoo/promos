<?php
/* @var $this PromocionesController */
/* @var $model Promociones */

$this->breadcrumbs=array(
	'Promociones'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Promociones', 'url'=>array('index')),
	array('label'=>'Create Promociones', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#promociones-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Promociones</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'promociones-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'user_id',
		'estado',
		'titulo',
		'slug',
		'resumen',
		/*
		'descripcion',
		'descripcion_html',
		'fecha_inicio',
		'fecha_fin',
		'fechaCreacion',
		'destacado',
		'precio',
		'rebaja',
		'condiciones',
		'agotado',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
