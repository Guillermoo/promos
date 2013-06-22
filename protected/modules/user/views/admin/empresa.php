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
			'value' => 'CHtml::link(UHtml::markSearch($data,"nombre"),array("admin/update","id"=>$data->user_id))',
		),
		array(
			'name'=>'cif',
			'type'=>'raw',
		),
		/*array(
			'name'=>'create_at',
			'type'=>'raw',
			//'value' => Yii::app()->format->date(strtotime($model->create_at)),
			//'value' => Yii::app()->dateFormatter->formatDateTime(CDateTimeParser::parse($model->create_at, 'yyyy-MM-dd'),'medium',null),
			//'value' => date("yy/mm/dd",strtotime($model->create_at)),
			'filter'=>$this->widget('zii.widgets.jui.CJuiDatepicker', 
				array(
					'model'=>$model, 
					'attribute'=>'create_at', 
					'htmlOptions' => array('id' => 'create_at_search'), 
					'options' => array(
							'dateFormat' => 'yy-mm-dd',
							'constrainInput' => 'true',
							//'showButtonPanel' => 'true',
							'duration'=>'fast',
							'showAnim'=>'fold','changeMonth'=>'true', 
	    					'changeYear'=>'true',)), true)
	    ),

		//'lastvisit_at',
		array(
			'name'=>'lastvisit_at',
			'type'=>'raw',
			'filter'=>$this->widget('zii.widgets.jui.CJuiDatepicker', 
				array(
					'model'=>$model, 
					'attribute'=>'lastvisit_at', 
					'htmlOptions' => array('id' => 'lastvisit_at_search'), 
					'options' => array(
							'dateFormat' => 'yy-mm-dd',
							'showAnim'=>'fold','changeMonth'=>'true', 
	    					'changeYear'=>'true',)), true)
	    ),
		array(
			'name'=>'superuser',
			'value'=>'User::itemAlias("AdminStatus",$data->superuser)',
			'filter'=>User::itemAlias("AdminStatus"),
		),
		array(
			'name'=>'status',
			'value'=>'User::itemAlias("UserStatus",$data->status)',
			'filter' => User::itemAlias("UserStatus"),
		),*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{view} {update}',
			'htmlOptions'=>array('style'=>'width: 50px'),
		),
	),
)); ?>
