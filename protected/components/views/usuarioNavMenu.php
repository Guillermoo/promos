<div id="mainmenu">		
		<!-- navbar de bootstrap -->
		<?php $this->widget('bootstrap.widgets.TbNavbar', array(
    'type'=>'', // null or 'inverse'
    'brand'=>CHtml::image(Yii::app()->theme->getBaseUrl().'/img/logo.png')." Proemoción",
    'brandUrl'=>Yii::app()->baseUrl,
    'collapse'=>true, // requires bootstrap-responsive.css
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
                array('url'=>Yii::app()->getModule('user')->profileUrl, 'label'=>Yii::app()->getModule('user')->t("Profile"), 'visible'=>!Yii::app()->user->isGuest, 'icon'=>'user', 'active'=>Yii::app()->controller->action->id=='profile'),	
                array('label'=>'Contacto', 'url'=>Yii::app()->getModule('user')->contactoEmpresaUrl,'visible'=>!Yii::app()->user->isGuest,'icon'=>'envelope', 'active'=>Yii::app()->controller->action->id=='contact'),
                 array('label'=>'Mis compras', 'url'=>Yii::app()->getModule('user')->historialcompras,'visible'=>!Yii::app()->user->isGuest,'icon'=>'envelope', 'active'=>Yii::app()->controller->action->id=='historialCompras')         
            ),
        ),              
    ),
)); ?>
</div><!-- mainmenu -->		