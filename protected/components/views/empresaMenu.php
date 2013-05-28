<?php $this->beginWidget('zii.widgets.CPortlet', array(
                'title'=>'Admin Operations',
            ));
?>
            
<?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'list',
    'items'=>array(
    	array('url'=>Yii::app()->getModule('user')->profileUrl, 'label'=>Yii::app()->getModule('user')->t("Profile"), 'visible'=>!Yii::app()->user->isGuest),
    	array('url'=>Yii::app()->getModule('user')->logoutUrl, 'label'=>Yii::app()->getModule('user')->t("Logout").' ('.Yii::app()->user->name.')', 'visible'=>!Yii::app()->user->isGuest),
        array('label'=>'LIST HEADER'),
        array('label'=>'Datos Empresa', 'icon'=>'book', 'url'=>'empresa', 'active'=>true, 'visible'=>Yii::app()->authManager->checkAccess('empresa', Yii::app()->user->id)),
        array('label'=>'Promociones', 'icon'=>'home', 'url'=>'#', 'active'=>true),
        array('label'=>'Suscripción', 'url'=>'#','active'=>true);
        /*array('label'=>'Library', 'icon'=>'book', 'url'=>'#'),
        array('label'=>'Application', 'icon'=>'pencil', 'url'=>'#'),
        array('label'=>'ANOTHER LIST HEADER'),
        array('label'=>'Profile', 'icon'=>'user', 'url'=>'#'),
        array('label'=>'Settings', 'icon'=>'cog', 'url'=>'#'),
        array('label'=>'Help', 'icon'=>'flag', 'url'=>'#'),*/
    ),
)); ?>

<?php $this->endWidget(); ?>