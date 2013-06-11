<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/user_main'); ?>
<div class="span-5 last">
	<div id="sidebar">
		<div class="categoriasizda">
	<?php
	echo "<h4>Menú de usuario</h4>";
	$this->widget('zii.widgets.CMenu', array(
    'items'=>array(
        // Important: you need to specify url as 'controller/action',
        // not just as 'controller' even if default acion is used.        
        // 'Products' menu item will be selected no matter which tag parameter value is since it's not specified.
        array('label'=>'Historial de compras', 'url'=>array('product/index')),        
    ),
	));
			/*$this->widget('zii.widgets.CMenu', array(
				'items'=>$this->menu,
				'htmlOptions'=>array('class'=>'operations'),
			));*/
		
	?>
		</div><!-- categoriasizda -->
	</div><!-- sidebar -->
</div>
<div class="span-26">
	<div id="content">
		<?php 		
		echo $content; ?>
	</div><!-- content -->
</div>
<?php $this->endContent(); ?>