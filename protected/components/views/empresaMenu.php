<?php /*$this->beginWidget('zii.widgets.CPortlet', array(
                'title'=>'Admin Operations',
            ));*/
?>
            
<?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'list',
    'items'=>array(
    	array('url'=>Yii::app()->getModule('user')->promosActivas, 'label'=>'Mis promos activas'),
        array('url'=>Yii::app()->getModule('user')->promosStock, 'label'=>'Mis promos en stock'),
        array('url'=>Yii::app()->getModule('user')->promosDestacadas, 'label'=>'Mis promos destacadas'),
    ),
)); ?>

<?php //$this->endWidget(); ?>