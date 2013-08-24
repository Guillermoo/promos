<div id="mainmenu">		
		<!-- navbar de bootstrap -->
		<?php $this->widget('bootstrap.widgets.TbNavbar', array(
    'type'=>'inverse', // null or 'inverse'
    'brand'=>'',
    'brandUrl'=>Yii::app()->baseUrl,
    'collapse'=>true, // requires bootstrap-responsive.css
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
                array('url'=>Yii::app()->getModule('user')->homeUrl, 'label'=>Yii::app()->getModule('user')->t("Home"), 'visible'=>!Yii::app()->user->isGuest, 'active'=>(Yii::app()->controller->action->id=='home' && Yii::app()->controller->id=='profile'), 'icon'=>'home'),
                array('url'=>Yii::app()->getModule('user')->profileUrl, 'label'=>Yii::app()->getModule('user')->t("Profile"), 'visible'=>!Yii::app()->user->isGuest, 'icon'=>'user', 'active'=>(Yii::app()->controller->id=='profile' && Yii::app()->controller->action->id!='home') ),		    	
                array('label'=>'Contact', 'url'=>Yii::app()->getModule('user')->contactoEmpresaUrl,'icon'=>'envelope', 'active'=>Yii::app()->controller->action->id=='contact'),
                array('url'=>Yii::app()->getModule('user')->logoutUrl,'icon' => 'off', 'label'=>Yii::app()->getModule('user')->t("Logout").' ('.Yii::app()->user->name.')', 'visible'=>!Yii::app()->user->isGuest),               
            ),
        ),              
    ),
)); ?>
</div><!-- mainmenu -->		