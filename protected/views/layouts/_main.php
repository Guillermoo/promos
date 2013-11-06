
<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
	<title><?php echo CHtml::encode($this->pageTitle); ?>
</head>

<body>

				<?php if(isset($this->breadcrumbs)):?>
				<?php $this->widget('zii.widgets.CBreadcrumbs', array(
						'links'=>$this->breadcrumbs,
					)); ?><!-- breadcrumbs -->
				<?php endif?>
				<?php echo __FILE__; ?>
			</div><!-- header -->

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		<div class="row-fluid print-hide">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reservedados.<br/>
		<p>Contacto</p>
		<?php echo Yii::powered(); ?>
	</div>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
