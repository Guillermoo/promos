<?php echo __FILE__; ?>
<?php

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});	
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('user-grid', {
        data: $(this).serialize()
    });
    return false;
});
");

?>
<h1><?php echo UserModule::t("Manage Companys"); ?></h1>

<p><?php echo UserModule::t("You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done."); ?></p>

<?php echo CHtml::link(UserModule::t('Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_searchcompany',array(
    'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('application.extensions.flash.Flash', array(
    'keys'=>array('success','error'), 
    'htmlOptions'=>array('id'=>'flash'),
)); ?><!-- flashes -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'empresa-grid',
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
		array(
			'name' => 'user_id',
			'type'=>'raw',
                        'value' => 'CHtml::link(UHtml::encode($data->usuario->username,"user_id"),array("admin/update","id"=>$data->user_id))',
                        //'value' => 'CHtml::link(CHtml::encode($data->usuario->empresa->nombre),array("admin/update","id"=>$data->user_id))',
			'visible'=> YII_DEBUG,
		),
		/*array(
			'name' => 'username',
			'value' => Empresa::getNombreUsuario(),
			'type'=>'raw',
			'visible'=> YII_DEBUG,
		),*/
		array(
			'name' => 'nombre',
			'type'=>'raw',
			'value' => 'CHtml::link(UHtml::markSearch($data,"nombre"),array("empresa/edit/id/".$data->id))',
		),
		array(
			'name'=>'cif',
			'type'=>'raw',
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{view} {update} {delete}',
                        'buttons'=>array(
                            'view' => array(
                                'label'=>'Ver',
                                //'imageUrl'=>Yii::app()->request->baseUrl.'/images/email.png',
                                'url'=>'Yii::app()->createUrl("user/empresa/view", array("id"=>$data->id))',
                            ),
                            'update' => array(
                                'label'=>'Editar',
                                //'imageUrl'=>Yii::app()->request->baseUrl.'/images/email.png',
                                'url'=>'Yii::app()->createUrl("user/empresa/edit", array("id"=>$data->id))',
                            ),
                        'delete' => array(
                                'label'=>'Borrar',
                                //'imageUrl'=>Yii::app()->request->baseUrl.'/images/email.png',
                                'url'=>'Yii::app()->createUrl("user/empresa/delete", array("id"=>$data->id))',
                            ),
                        ),
			'htmlOptions'=>array('style'=>'width: 50px'),
		),
	),
)); ?>
