<?php
/* @var $this PromocionesController */
/* @var $model Promociones */

$this->breadcrumbs=array(
	'Promociones'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar Promociones', 'url'=>array('index')),
	array('label'=>'Crear Promoción', 'url'=>array('create')),
	array('label'=>'Actualizar Promoción', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Borrar Promoción', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'¿Estás seguro de que quieres borrar esta promoción?')),
	array('label'=>'Manage Promociones', 'url'=>array('admin')),
);
?>

<h1>Ver promoción '<?php echo $model->titulo; ?>'</h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'estado',
		'titulo',
		'titulo_slug',
		'resumen',
                array(
                    'name'=>'descripcion_html',                 
                    'type'=>'raw',                 
                    'label'=>'Descripción',
                ),
		'fecha_inicio',
		'fecha_fin',
		'fechaCreacion',
		'destacado',
		'precio',
		'rebaja',
		'condiciones',
		'stock',
	),
)); ?>
