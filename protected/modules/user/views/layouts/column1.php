<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="span12">
	<div id="content">
		<?php if(YII_RUTAS == true) echo __FILE__; ?>
		<?php 		
		echo $content; ?>
	</div><!-- content -->
</div>
<?php $this->endContent(); ?>