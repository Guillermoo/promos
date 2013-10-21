<div id="mainmenu">		
	<!-- navbar de bootstrap -->
	<?php $this->widget('bootstrap.widgets.TbNavbar', array(
	    'type'=>'', // null or 'inverse'
	    'brand'=>CHtml::image(Yii::app()->theme->getBaseUrl().'/img/logo.png').CHtml::link('Salir',array('/user/logout'),
	    'brandUrl'=>Yii::app()->baseUrl,
	    'collapse'=>true, // requires bootstrap-responsive.css
	    'items'=>array(
	        array(
	            'class'=>'bootstrap.widgets.TbMenu',
	            'items'=>array(
	                array('url'=>Yii::app()->getModule('user')->listaUsuarios, 'label'=>Yii::app()->getModule('user')->t("Usuarios"), 'visible'=>!Yii::app()->user->isGuest, 'active'=>(Yii::app()->controller->action->id=='admin')),
	                array('url'=>Yii::app()->getModule('user')->listaCategorias, 'label'=>Yii::app()->getModule('user')->t("Categorias"), 'visible'=>!Yii::app()->user->isGuest,'active'=>(Yii::app()->controller->id=='category')),
			        //array('label'=>'Promociones', 'icon'=>'home', 'url'=>'#', 'active'=>true),
	                array('url'=>Yii::app()->getModule('user')->logoutUrl,'icon' => 'off', 'label'=>Yii::app()->getModule('user')->t("Logout").' ('.Yii::app()->user->name.')', 'visible'=>!Yii::app()->user->isGuest),               
	            ),
	        ),              
	    ),
	)); ?>
</div> <!-- mainmenu -->	