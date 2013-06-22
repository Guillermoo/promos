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
	                array('url'=>Yii::app()->getModule('user')->homeAdminUrl, 'label'=>Yii::app()->getModule('user')->t("Home"), 'visible'=>!Yii::app()->user->isGuest),
			        //array('label'=>'Promociones', 'icon'=>'home', 'url'=>'#', 'active'=>true),
	                array('url'=>Yii::app()->getModule('user')->logoutUrl,'icon' => 'off', 'label'=>Yii::app()->getModule('user')->t("Logout").' ('.Yii::app()->user->name.')', 'visible'=>!Yii::app()->user->isGuest),               
	            ),
	        ),              
	    ),
	)); ?>
</div> <!-- mainmenu -->	