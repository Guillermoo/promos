<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="span-5">
	<div class="categoriasizda">
		<h4>Menú Empresa:</h4>
		<?php 
		$this->widget('zii.widgets.CMenu', array(
    'items'=>array(
        // Important: you need to specify url as 'controller/action',
        // not just as 'controller' even if default acion is used.
        array('label'=>'Mis productos', 'url'=>array('site/index')),
        // 'Products' menu item will be selected no matter which tag parameter value is since it's not specified.
        array('label'=>'Mis ventas', 'url'=>array('product/index')),        
        array('label'=>'Mi suscripción', 'url'=>array('site/login'))        
    	),
		));	
		?>
	</div>
</div>

<div class="span-13">
	<div id="content">
		<?php echo $content; ?>
	</div>
</div>

<div class="span-5">
	<div class="logindcha">
			<?php echo "<h4>Hola ".Yii::app()->user->getName()."</h4>"; ?>
	</div>
	<div class="tagsdcha">
		<h4>Mis promociones:</h4>
		<?php 
		$this->widget('zii.widgets.CMenu', array(
    'items'=>array(        
        array('label'=>'Nueva promoción', 'url'=>array('site/index')),        
        array('label'=>'Promociones activas', 'url'=>array('product/index')),        
        array('label'=>'Promociones inactivas', 'url'=>array('site/login'))        
    	),
		));	
		?>
	</div>
<?php $this->endContent(); ?>