<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="span-5">
	<div>
		<h4>Categorías:</h4>
		<?php 
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Operations',
		));
		$this->endWidget();
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
		<h4>Login:</h4>
	</div>
	<div class="tagsdcha">
		<h4>Tags:</h4>
	</div>
	<div>
		<?php 
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Menú usuario',
		));			
		$this->endWidget();
		?>
	</div>
</div>
<?php $this->endContent(); ?>
?>