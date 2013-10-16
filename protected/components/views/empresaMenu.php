<?php /*$this->beginWidget('zii.widgets.CPortlet', array(
                'title'=>'Admin Operations',
            ));*/
?>
<div class="widget_heading"><h4>Menú Promociones</h4></div>
<div class="widget_container">            
<?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'list',
    'items'=>array(
    	array('url'=>Yii::app()->getModule('user')->promosActivas, 'label'=>'Mis promos activas'),
        array('url'=>Yii::app()->getModule('user')->promosStock, 'label'=>'Mis promos en stock'),
        array('url'=>Yii::app()->getModule('user')->promosDestacadas, 'label'=>'Mis promos destacadas'),
    ),
)); ?>
</div>
<?php //$this->endWidget(); ?>