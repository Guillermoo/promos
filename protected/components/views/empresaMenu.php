
<?php $this->beginWidget('zii.widgets.CPortlet');
?>
            
<?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'list',
    'items'=>array(
        array('label'=>'Datos empresa', 'url'=>array('site/index')),
        // 'Products' menu item will be selected no matter which tag parameter value is since it's not specified.         
        array('label'=>'Mis proemociones', 'url'=>array('site/login')),
        array('label'=>'Nueva proemoción', 'url'=>array('site/login')),
        array('label'=>'Suscripción', 'url'=>array('site/login')),
        /*
    	array('url'=>Yii::app()->getModule('user')->profileUrl, 'label'=>Yii::app()->getModule('user')->t("Profile"), 'visible'=>!Yii::app()->user->isGuest),
    	array('url'=>Yii::app()->getModule('user')->logoutUrl, 'label'=>Yii::app()->getModule('user')->t("Logout").' ('.Yii::app()->user->name.')', 'visible'=>!Yii::app()->user->isGuest),
        array('label'=>'LIST HEADER'),
        array('label'=>'Datos Empresa', 'icon'=>'book', 'url'=>'empresa', 'active'=>true, 'visible'=>Yii::app()->authManager->checkAccess('empresa', Yii::app()->user->id)),
        array('label'=>'Proemociones', 'icon'=>'home', 'url'=>'#', 'active'=>true),
        array('label'=>'Suscripción', 'url'=>'#','active'=>true);*/
        /*array('label'=>'Library', 'icon'=>'book', 'url'=>'#'),
        array('label'=>'Application', 'icon'=>'pencil', 'url'=>'#'),
        array('label'=>'ANOTHER LIST HEADER'),
        array('label'=>'Profile', 'icon'=>'user', 'url'=>'#'),
        array('label'=>'Settings', 'icon'=>'cog', 'url'=>'#'),
        array('label'=>'Help', 'icon'=>'flag', 'url'=>'#'),*/
    ),
)); ?>

<?php $this->endWidget(); ?>