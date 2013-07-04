<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="span-5">
	<div class="categoriasizda">
		<h4>Categorías:</h4>
		<?php 
		$this->widget('zii.widgets.CMenu', array(
    'items'=>array(
        // Important: you need to specify url as 'controller/action',
        // not just as 'controller' even if default acion is used.
        array('label'=>'Salud y belleza', 'url'=>array('site/index')),
        // 'Products' menu item will be selected no matter which tag parameter value is since it's not specified.
        array('label'=>'Calzado', 'url'=>array('product/index')),        
        array('label'=>'Bodas', 'url'=>array('site/login')),
        array('label'=>'Visutería', 'url'=>array('site/login')),
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
	<?php if(Yii::app()->user->isGuest){ ?>
	<div class="logindcha">		
		<h4>Login:</h4>
		<?php 
		$this->widget('zii.widgets.CMenu', array(
    'items'=>array(        
        array('label'=>'Logueo', 'url'=>array('user/login'), 'visible'=>Yii::app()->user->isGuest),            
    ),
));	
		?>
	</div>
	<?php }else{
		?>
		<div class="logindcha">
			<?php echo "<h4>Hola ".Yii::app()->user->getName()."</h4>"; ?>
		</div>
		<?php
	} ?>
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