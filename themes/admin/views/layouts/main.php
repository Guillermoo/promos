<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/cierzodevs.css" />
	<link media="screen" rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css"  />
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/_bootstrap.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/_bootstrap-responsive.min.css">
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<?php Yii::app()->bootstrap->register(); ?>
</head>

<body>
	<!-- DEBUG -->
	<?php if(!empty(Yii::app()->params['debugContent'])):?>
		<?php echo Yii::app()->params['debugContent'];?>
	<?php endif;?>
	<!-- END DEBUG -->
<?php /*$this->widget('bootstrap.widgets.TbNavbar',array(
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
                array('label'=>'Home', 'url'=>array('/site/index')),
                array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
                array('label'=>'Contact', 'url'=>array('/site/contact')),
                array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
            ),
        ),
    ),
));*/ ?>

<div class="container" id="page">
	<!-- menu horizontal -->
	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),				
				array('label'=>'Contact', 'url'=>array('/site/contact')),
				/*array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)*/	
				array('url'=>Yii::app()->getModule('user')->profileUrl, 'label'=>Yii::app()->getModule('user')->t("Profile"), 'visible'=>!Yii::app()->user->isGuest),
				array('url'=>Yii::app()->getModule('user')->logoutUrl, 'label'=>Yii::app()->getModule('user')->t("Logout").' ('.Yii::app()->user->name.')', 'visible'=>!Yii::app()->user->isGuest),
			),
		)); ?>
	</div><!-- mainmenu -->
	<!-- --------------- -->
	<?php //if(isset($this->breadcrumbs)):?>
		<?php /*$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		));*/ ?><!-- breadcrumbs -->
	<?php //endif?>
	<?php echo __FILE__; ?>

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
