<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="span5">
	<div>
		<?php 
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Operations',
		));
		$this->endWidget();
		?>
	</div>
</div>

<div class="span14">
	<div id="content">
		<?php echo $content; ?>
	</div>
</div>

<div class="span5">
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