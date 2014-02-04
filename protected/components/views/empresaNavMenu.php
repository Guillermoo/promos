<div id="mainmenu">	
		<!-- navbar de bootstrap -->
		<?php $this->widget('bootstrap.widgets.TbNavbar', array(
    'type'=>'', // null or 'inverse'
    'brand'=>CHtml::image(Yii::app()->theme->getBaseUrl().'/img/logo.png')." Proemoción",
    'brandUrl'=>Yii::app()->getBaseUrl(true),
    'collapse'=>true, // requires bootstrap-responsive.css
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
                /*array('url'=>Yii::app()->getModule('user')->homeUrl, 'label'=>Yii::app()->getModule('user')->t("Home"), 'visible'=>!Yii::app()->user->isGuest, 'active'=>(Yii::app()->controller->action->id=='home' && Yii::app()->controller->id=='profile'), 'icon'=>'home'),*/
                array('url'=>Yii::app()->getModule('user')->profileUrl, 'label'=>Yii::app()->getModule('user')->t("Profile"), 'visible'=>!Yii::app()->user->isGuest, 'icon'=>'user', 'active'=>(Yii::app()->controller->id=='profile') 
                    ),
		    	array('url'=>Yii::app()->getModule('user')->empresaUrl, 'label'=>Yii::app()->getModule('user')->t("Company"), 'visible'=>!Yii::app()->user->isGuest, 'icon'=>'briefcase','active'=>Yii::app()->controller->id=='empresa'),
		    	array('label'=>'Mis promociones', 'url'=>Yii::app()->getModule('user')->promocionesUrl, 'icon'=>'gift','active'=>Yii::app()->controller->id=='promocion' , 'items'=>array(
                    array('label'=>Yii::app()->getModule('user')->t("Create"), 'url'=>Yii::app()->getModule('user')->crearPromocionUrl),
                    array('label'=>Yii::app()->getModule('user')->t("Administrate"), 'url'=>Yii::app()->getModule('user')->promocionesUrl),
                )),
                array('url'=>Yii::app()->getModule('user')->ventasUrl, 'label'=>'Mis ventas', 'visible'=>!Yii::app()->user->isGuest, 'icon'=>'star','active'=>Yii::app()->controller->id=='compra' || Yii::app()->controller->action->id == 'verDatos'),                
		        //array('label'=>'Datos Empresa', 'icon'=>'book', 'url'=>'empresa', 'active'=>true, 'visible'=>Yii::app()->authManager->checkAccess('empresa', Yii::app()->user->id)),
		        //array('label'=>'Promociones', 'icon'=>'home', 'url'=>'#', 'active'=>true),

                array('label'=>'Suscripción', 'url'=>Yii::app()->getModule('user')->cuentaUrl,'icon'=>'shopping-cart', 'active'=>Yii::app()->controller->id=='cuentas'),
                array('label'=>Yii::app()->getModule('user')->t("Contact"), 'url'=>Yii::app()->getModule('user')->contactoEmpresaUrl,'icon'=>'envelope', 'active'=>Yii::app()->controller->id=='site')
                //array('label'=>'Baja', 'url'=>Yii::app()->getModule('user')->bajaUrl,'icon' => 'remove-circle'),
                //array('label'=>'Debug', 'url'=>'empresa/misdebugs','active'=>false),           
            ),
        ),              
    ),
)); ?>
</div>