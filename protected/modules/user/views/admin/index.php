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
<h1><?php echo UserModule::t("Manage Users"); ?></h1>

<p><?php echo UserModule::t("You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done."); ?></p>

<?php echo CHtml::link(UserModule::t('Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
    'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php /*$this->widget('application.extensions.flash.Flash', array(
    'keys'=>array('success','error'), 
    'htmlOptions'=>array('id'=>'flash'),
));*/ ?><!-- flashes -->
    
<?php $this->widget('bootstrap.widgets.TbGridView',array(
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
			'value' => 'CHtml::link(CHtml::encode($data->id),array("admin/update","id"=>$data->id))',
			'visible'=> YII_DEBUG,
		),
		array(
			'name' => 'username',
			'type'=>'raw',
                        'value' => 'CHtml::link(CHtml::encode($data->username),array("update","id"=>$data->id))',
			//'value' => 'CHtml::link(CHtml::encode($data,"username"),array("admin/update","id"=>$data->id))',
		),
		/*
		 * Para visualizar la empresa hay que añadir la relación en el CDbCriteria de User(search())
		 * */
		array(
			'name' => 'empresa',
			'type'=>'raw',
			'value' => 'CHtml::link(UHtml::markSearch($data->empresa,"nombre"),array("empresa/update","id"=>$data->empresa->id))',
			//'visible'=> UserModule::isCompany($model->id),
			'visible'=> false,	
		),
		array(
			'name'=>'email',
			'type'=>'raw',
			'value'=>'CHtml::link(UHtml::markSearch($data,"email"), "mailto:".$data->email)',
		),
		array(
			'name'=>'create_at',
			'type'=>'raw',
			//'value' => Yii::app()->format->date(strtotime($model->create_at)),
			//'value' => Yii::app()->dateFormatter->formatDateTime(CDateTimeParser::parse($model->create_at, 'yyyy-MM-dd'),'medium',null),
			//'value' => date("yy/mm/dd",strtotime($model->create_at)),
            /*'filter'=>$this->widget('zii.widgets.jui.CJuiDatepicker', 
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
	    					'changeYear'=>'true',)), true)*/
	    ),

		//'lastvisit_at',
		/*array(
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
	    ),	*/
		array(
			'name'=>'superuser',
			'value'=>'User::itemAlias("AdminStatus",$data->superuser)',
			'filter'=>User::itemAlias("AdminStatus"),
		),
		array(
			'name'=>'status',
			'value'=>'User::itemAlias("UserStatus",$data->status)',
			'filter' => User::itemAlias("UserStatus"),
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{view} {update} {delete}',
			'htmlOptions'=>array('style'=>'width: 50px'),
		),
	),
)); ?>
