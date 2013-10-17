<div id="mainmenu">	
		<!-- navbar de bootstrap -->
		<?php $this->widget('bootstrap.widgets.TbNavbar', array(
    'type'=>'', // null or 'inverse'
    'brand'=>'',
    'brandUrl'=>Yii::app()->baseUrl,
    'collapse'=>true, // requires bootstrap-responsive.css
    'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('label'=>'Promociones', 'url'=>array('/promociones')),
				array('label'=>'Empresas', 'url'=>array('/empresas')),
				/*array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)*/
				array('url'=>Yii::app()->getModule('user')->loginUrl, 'label'=>Yii::app()->getModule('user')->t("Login"), 'visible'=>Yii::app()->user->isGuest),
				array('url'=>Yii::app()->getModule('user')->registrationUrl, 'label'=>Yii::app()->getModule('user')->t("Register Usuario"), 'visible'=>Yii::app()->user->isGuest),
				array('url'=>Yii::app()->getModule('user')->registrationCompanyUrl, 'label'=>Yii::app()->getModule('user')->t("Register Empresa"), 'visible'=>Yii::app()->user->isGuest),
				array('url'=>Yii::app()->getModule('user')->homeUrl, 'label'=>Yii::app()->getModule('user')->t("User Panel"), 'visible'=>!Yii::app()->user->isGuest),
				array('url'=>Yii::app()->getModule('user')->homeAdminUrl, 'label'=>Yii::app()->getModule('user')->t("Home Admin"), 'visible'=>UserModule::isAdmin()),
				array('url'=>Yii::app()->getModule('user')->logoutUrl, 'label'=>Yii::app()->getModule('user')->t("Logout").' ('.Yii::app()->user->name.')', 'visible'=>!Yii::app()->user->isGuest),
			),             
    ),
)); ?>
</div>