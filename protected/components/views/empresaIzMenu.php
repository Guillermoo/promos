<div class="span-5 last">
	<div id="sidebar">
		<div class="categoriasizda">
	<?php
	//Aquí lo mismo, te creas un menú y lo cargas
	echo "<h4>Menú de usuario</h4>";
	$this->widget('zii.widgets.CMenu', array(
    'items'=>array(
        // Important: you need to specify url as 'controller/action',
        // not just as 'controller' even if default acion is used.
        array('label'=>'Datos personales', 'url'=>array('site/index')),
        // 'Products' menu item will be selected no matter which tag parameter value is since it's not specified.
        array('label'=>'Historial de compras', 'url'=>array('product/index')),        
        array('label'=>'Darse de baja', 'url'=>array('site/login')),
    ),
	));
			$this->widget('zii.widgets.CMenu', array(
				'items'=>$this->menu,
				'htmlOptions'=>array('class'=>'operations'),
			));
		
	?>
		</div><!-- categoriasizda -->
	</div><!-- sidebar -->
</div>