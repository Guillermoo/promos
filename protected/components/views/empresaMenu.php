<?php /*$this->beginWidget('zii.widgets.CPortlet', array(
                'title'=>'Admin Operations',
            ));*/
?>
            
<?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'list',
    'items'=>array(
    	array('url'=>'promocion/promosActivas', 'label'=>'Mis promos activas'),
        array('url'=>'promocion/promosStock', 'label'=>'Mis promos en stock'),
        array('url'=>'promocion/promosDestacadas', 'label'=>'Mis promos destacadas'),
    ),
)); ?>

<?php //$this->endWidget(); ?>