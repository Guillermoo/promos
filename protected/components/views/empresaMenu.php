<?php /*$this->beginWidget('zii.widgets.CPortlet', array(
                'title'=>'Admin Operations',
            ));*/
?>
            
<?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'list',
    'items'=>array(
    	array('url'=>'#', 'label'=>'Mis promos activas'),
        array('url'=>'#', 'label'=>'Mis promos en stock'),
        array('url'=>'#', 'label'=>'Mis promos destacadas'),
    ),
)); ?>

<?php //$this->endWidget(); ?>