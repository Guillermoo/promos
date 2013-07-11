<?php $this->beginWidget('zii.widgets.CPortlet');
?>
            
<?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'list',
    'items'=>array(
        array('label'=>'Opciones usuario'),
        array('label'=>'Datos personales', 'url'=>array('site/index')),
        // 'Products' menu item will be selected no matter which tag parameter value is since it's not specified.
        array('label'=>'Historial de compras', 'url'=>array('product/index')),        
        array('label'=>'Darse de baja', 'url'=>array('site/login')),
    ),
)); ?>

<?php $this->endWidget(); ?>