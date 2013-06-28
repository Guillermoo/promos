<?php
/* @var $this PromocionesController */
/* @var $model Promociones */

?>

<h1><?php echo UserModule::t("Manage Promotions"); ?></h1>

<p><?php echo UserModule::t("You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done."); ?></p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('application.extensions.flash.Flash', array(
    'keys'=>array('success','error'), 
    'htmlOptions'=>array('id'=>'flash'),
)); ?><!-- flashes -->

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'user-grid',
	'ajaxUpdate' => 'flash',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'type'=>'striped',
	'enableSorting' => true,
	'columns'=>array(
		array(
			'name' => 'id',
			'type'=>'raw',
			'visible'=> YII_DEBUG,
		),
		'estado',
		array(
			'name' => 'titulo',
			'type'=>'raw',
			'value' => 'CHtml::link(UHtml::markSearch($data,"titulo"),array("promocion/update","id"=>$data->id))',
		),
		'resumen',
		/*
		'descripcion',
		'descripcion_html',*/
		'fecha_inicio',
		'fecha_fin',
		'fechaCreacion',
		'destacado',
		'precio',
		/*'rebaja',
		'condiciones',
		'stock',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{view} {update} {delete}',
			'htmlOptions'=>array('style'=>'width: 50px'),
		),
	),
)); ?>

<?php 
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
