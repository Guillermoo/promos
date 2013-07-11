<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="span3 last">
	<div id="sidebar">
		<div class="categoriasizda">
			<?php
			//ejecuto el componente que me muestra un menú lateral u otro según el tipo de usuario que sea 
			$this->widget('UserMenu');
			?>
		</div><!-- categoriasizda -->
	</div><!-- sidebar -->
</div>
<div class="span8">
	<div id="content">
		<?php if(YII_RUTAS == true) echo __FILE__; ?>
		<?php 		
		echo $content; ?>
	</div><!-- content -->
</div>
<?php $this->endContent(); ?>