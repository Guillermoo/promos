<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
    <!-- <link rel="stylesheet" type="text/css" href="<?php //echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />
	<link media="screen" rel="stylesheet" type="text/css" href="<?php //echo Yii::app()->theme->baseUrl; ?>/css/main.css"  />
    <link rel="stylesheet" href="<?php //echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php //echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-responsive.min.css"> -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/cierzodevs.css" />
	<link media="screen" rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css"  />
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/_bootstrap.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/_bootstrap-responsive.min.css">
	<?php Yii::app()->bootstrap->register(); ?>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	
</head>

<body>


<div class="container" id="page">
	<?php if(YII_RUTAS == true) echo __FILE__; ?>
	<!-- menu horizontal -->
	<div id="mainmenu">		
		<!-- navbar de bootstrap -->
		<?php 
		if(UserModule::isBuyer()){
			$this->widget('bootstrap.widgets.TbNavbar', array(
    		'type'=>'inverse', // null or 'inverse'
    		'brand'=>'Pro(e)moción!',
    		'brandUrl'=>'#',
    		'collapse'=>true, // requires bootstrap-responsive.css
    		'items'=>array(
        		array(
            		'class'=>'bootstrap.widgets.TbMenu',
            		'items'=>array(
                		array('label'=>'Principal', 'url'=>'#', 'active'=>true, 'icon'=>'home'),
               			array('label'=>'Contacto', 'url'=>array('/site/contact'),'icon'=>'envelope'),
                		array('url'=>Yii::app()->getModule('user')->profileUrl, 'label'=>Yii::app()->getModule('user')->t("Profile"), 'visible'=>!Yii::app()->user->isGuest, 'icon'=>'user'),
                		array('label'=>'Baja', 'url'=>'#','icon' => 'remove-circle'),
                		array('url'=>Yii::app()->getModule('user')->logoutUrl,'icon' => 'off', 'label'=>Yii::app()->getModule('user')->t("Logout").' ('.Yii::app()->user->name.')', 'visible'=>!Yii::app()->user->isGuest),              
            		),
        		),              
    		),
			)); 
		}elseif(UserModule::isCompany()){
			$this->widget('UserMenu');
			/*if(!Yii::app()->user->isGuest) $this->widget('UserMenu'); //Esto realmente sustituiría a todo el bloque, UserMenu gestiona que menú se mostrará en función del usuario
			/*$this->widget('bootstrap.widgets.TbNavbar', array(
    			'type'=>'', // null or 'inverse'
    			'brand'=>'Pro(e)moción!',
   				'brandUrl'=>'#',
    			'collapse'=>true, // requires bootstrap-responsive.css
    			'items'=>array(
        			array(
            		'class'=>'bootstrap.widgets.TbMenu',
            		'items'=>array(
                		array('label'=>'Principal', 'url'=>'#', 'active'=>true, 'icon'=>'home'),
                		array('label'=>'Suscripción', 'url'=>'#','icon'=>'shopping-cart'),
                		array('label'=>'Contacto', 'url'=>array('/site/contact'),'icon'=>'envelope'),
                		array('url'=>Yii::app()->getModule('user')->profileUrl, 'label'=>Yii::app()->getModule('user')->t("Profile"), 'visible'=>!Yii::app()->user->isGuest, 'icon'=>'user'),
                		array('label'=>'Baja', 'url'=>'#','icon' => 'remove-circle'),
                		array('url'=>Yii::app()->getModule('user')->logoutUrl,'icon' => 'off', 'label'=>Yii::app()->getModule('user')->t("Logout").' ('.Yii::app()->user->name.')', 'visible'=>!Yii::app()->user->isGuest),               
            			),
        			),              
    			),
			));*/
		}elseif(UserModule::isSuperAdmin() || UserModule::isAdmin()){

		}
?>
		<!-- ------------------- -->
	</div><!-- mainmenu -->
	<!-- --------------- -->
	<?php if(YII_RUTAS == true) echo __FILE__; ?>
	<!-- Para debugear como en cake, notcar -->
	<?php if(!empty(Yii::app()->params['debugContent'])):?>
                <?php echo Yii::app()->params['debugContent'];?>
	<?php endif;?>
	<!-- End debug -->
	
	<?php //FLASH MSG?>
	<div class="flash-notice">
		<?php $this->widget('bootstrap.widgets.TbAlert', array(
	        'alerts'=>array( // configurations per alert type
	            'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'x'), // success, info, warning, error or danger
	            'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'x'), // success, info, warning, error or danger
				'info'=>array('block'=>true, 'fade'=>true, 'closeText'=>'x'), // success, info, warning, error or danger
	        ),
	    )); ?>
	</div>
	<?php //END FLASH MSG?>

	<?php echo $content; ?>

	<div class="clearfix">&nbsp;</div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
