<?php
/* @var $this PromocionesController */
/* @var $model Promociones */

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

<h1><?php echo UserModule::t("Manage Promotions"); ?></h1>
<?php echo CHtml::link(UserModule::t("Advanced Search"),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php if(Yii::app()->user->hasFlash('error')):?>
    <div class="alert alert-error">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>

<?php $this->widget('application.extensions.flash.Flash', array(
    'keys'=>array('success','error'), 
    'htmlOptions'=>array('id'=>'flash'),
)); ?><!-- flashes -->

<?php if( UserModule::isAdmin() ): ?>
	<?php $this->widget('bootstrap.widgets.TbGridView', array(
		'id'=>'user-grid',
		'ajaxUpdate' => 'flash',
		'dataProvider'=>$model->search(),
		//'filter'=>$model,
		'type'=>'striped',
		'enableSorting' => true,
		'columns'=>array(
	                array( 
	                    'name'=>'id', 
	                    'visible'=>YII_DEBUG,
	                ),
			//'user_id',
	                array( 
	                    'name'=>'nbempresa', 
	                    'value'=>'CHtml::link(CHtml::encode($data->usuario->empresa->nombre),Yii::app()->createUrl("user/empresa/edit",array("id"=>$data->usuario->empresa->id)))',
	                    'filter' => Empresa::getEmpresas(),
	                    'type'=>'raw',
	                    'visible'=>!UserModule::isCompany(),
	                ),
	                array(
	                    'name'=>'estado',
	                    'value'=>'Promocion::itemAlias("PromoStatus",$data->estado)',
	                    'filter'=>'',
			),
			'titulo',
			//'titulo_slug',
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
			'stock',
			*/
			array(
				'class'=>'bootstrap.widgets.TbButtonColumn',
				'template'=>'{view} {update} {delete}',
					'buttons'=>array(
	                            'view' => array(
	                                'label'=>'Ver',
	                                //'imageUrl'=>Yii::app()->request->baseUrl.'/images/email.png',
	                                'url'=>'Yii::app()->createUrl("user/promocion/view", array("id"=>$data->id))',
	                            ),
	                            'update' => array(
	                                'label'=>'Editar',
	                                //'imageUrl'=>Yii::app()->request->baseUrl.'/images/email.png',
	                                'url'=>'Yii::app()->createUrl("user/promocion/updateAdmin", array("id"=>$data->id))',
	                            ),
	                        'delete' => array(
	                                'label'=>'Borrar',
	                                //'imageUrl'=>Yii::app()->request->baseUrl.'/images/email.png',
	                                'url'=>'Yii::app()->createUrl("user/promocion/delete", array("id"=>$data->id))',
	                            ),
	                        ),
				'htmlOptions'=>array('style'=>'width: 50px'),
			),
		),
	)); ?>
<?php else: ?>
	<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'user-grid',
	'ajaxUpdate' => 'flash',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'type'=>'striped',
	'enableSorting' => true,
	'columns'=>array(
                array( 
                    'name'=>'id', 
                    'visible'=>YII_DEBUG,
                ),
		//'user_id',
                array( 
                    'name'=>'nbempresa', 
                    'value'=>'CHtml::link(CHtml::encode($data->usuario->empresa->nombre),Yii::app()->createUrl("user/empresa/edit",array("id"=>$data->usuario->empresa->id)))',
                    'filter' => Empresa::getEmpresas(),
                    'type'=>'raw',
                    'visible'=>!UserModule::isCompany(),
                ),
                array(
                    'name'=>'estado',
                    'value'=>'Promocion::itemAlias("PromoStatus",$data->estado)',
                    'filter'=>'',
		),
		'titulo',
		//'titulo_slug',
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
		'stock',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{view} {update} {delete}',
				'buttons'=>array(
                            'view' => array(
                                'label'=>'Ver',
                                //'imageUrl'=>Yii::app()->request->baseUrl.'/images/email.png',
                                'url'=>'Yii::app()->createUrl("user/promocion/view", array("id"=>$data->id))',
                            ),
                            'update' => array(
                                'label'=>'Editar',
                                //'imageUrl'=>Yii::app()->request->baseUrl.'/images/email.png',
                                'url'=>'Yii::app()->createUrl("user/promocion/update", array("id"=>$data->id))',
                            ),
                        'delete' => array(
                                'label'=>'Borrar',
                                //'imageUrl'=>Yii::app()->request->baseUrl.'/images/email.png',
                                'url'=>'Yii::app()->createUrl("user/promocion/delete", array("id"=>$data->id))',
                            ),
                        ),
			'htmlOptions'=>array('style'=>'width: 50px'),
		),
	),
)); ?>
<?php endif; ?>