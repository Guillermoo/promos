<!-- menu horizontal -->
	<div id="mainmenu">		
		<!-- navbar de bootstrap -->
		<?php $this->widget('bootstrap.widgets.TbNavbar', array(
    'type'=>'', // null or 'inverse'
    'brand'=>'Pro(e)moción!',
    'brandUrl'=>Yii::app()->baseUrl,
    'collapse'=>true, // requires bootstrap-responsive.css
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
                array('url'=>Yii::app()->getModule('user')->homeUrl, 'label'=>Yii::app()->getModule('user')->t("Home"), 'visible'=>!Yii::app()->user->isGuest),
                array('url'=>Yii::app()->getModule('user')->profileUrl, 'label'=>Yii::app()->getModule('user')->t("Profile"), 'visible'=>!Yii::app()->user->isGuest, 'icon'=>'user'),
		    	array('url'=>Yii::app()->getModule('user')->empresaUrl, 'label'=>Yii::app()->getModule('user')->t("Company"), 'visible'=>!Yii::app()->user->isGuest),
		    	array('label'=>Yii::app()->getModule('user')->t("My Promotions"), 'url'=>Yii::app()->getModule('user')->promocionesUrl, 'items'=>array(
                    array('label'=>'Create', 'url'=>Yii::app()->getModule('user')->crearPromocionUrl),
                    array('label'=>'Administrar', 'url'=>Yii::app()->getModule('user')->promocionesUrl),
                )),
		        //array('label'=>'Datos Empresa', 'icon'=>'book', 'url'=>'empresa', 'active'=>true, 'visible'=>Yii::app()->authManager->checkAccess('empresa', Yii::app()->user->id)),
		        //array('label'=>'Promociones', 'icon'=>'home', 'url'=>'#', 'active'=>true),
                array('label'=>Yii::app()->getModule('user')->t("Subscription"), 'url'=>Yii::app()->getModule('user')->cuentaUrl,'icon'=>'shopping-cart'),
                array('label'=>'Contact', 'url'=>Yii::app()->getModule('user')->contactoUrl,'icon'=>'envelope'),
                array('label'=>'Baja', 'url'=>Yii::app()->getModule('user')->bajaUrl,'icon' => 'remove-circle'),
		        //array('label'=>'Debug', 'url'=>'empresa/misdebugs','active'=>false),
                array('url'=>Yii::app()->getModule('user')->logoutUrl,'icon' => 'off', 'label'=>Yii::app()->getModule('user')->t("Logout").' ('.Yii::app()->user->name.')', 'visible'=>!Yii::app()->user->isGuest),               
            ),
        ),              
    ),
)); ?>
		<!-- ------------------- -->
	</div><!-- mainmenu -->		