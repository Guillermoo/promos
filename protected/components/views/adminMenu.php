<?php if(YII_RUTAS == true) echo __FILE__; ?>
<div class="widget_heading"><h4>Menú Administrador</h4></div>
<div class="widget_container">
<?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'list',
    'items'=>array(
		//array('label'=>UserModule::t('Create User'), 'icon'=>'home', 'url'=>array('/user/admin/create')),
		array('label'=>'Administrar Usuarios', 'url'=>Yii::app()->getModule('user')->adminUrl),
		array('label'=>'Administrar Empresas', 'url'=>Yii::app()->getModule('user')->adminEmpresaUrl),
        //array('label'=>UserModule::t('Rols'), 'url'=>array('/rights'), 'visible'=>UserModule::isSuperAdmin()),
		array('label'=>'Administrar Promociones', 'url'=>Yii::app()->getModule('user')->adminPromocionesUrl),
    	//array('url'=>Yii::app()->getModule('user')->profileUrl, 'label'=>Yii::app()->getModule('user')->t("Profile"), 'visible'=>!Yii::app()->user->isGuest),
		//array('label'=>UserModule::t('Edit User'), 'url'=>array('/user/profile')),
		//array('url'=>Yii::app()->getModule('user')->profileUrl, 'label'=>Yii::app()->getModule('user')->t("Profile"), 'visible'=>!Yii::app()->user->isGuest),
		//array('label'=>UserModule::t('Delete User'), 'url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>Yii::app()->id),'confirm'=>UserModule::t('Are you sure to delete this item?'))),
		//array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('/user/profileField/admin'), 'visible'=>UserModule::isSuperAdmin()),
		//array('label'=>UserModule::t('Create Profile Field'), 'url'=>array('/user/profileField/create'), 'visible'=>UserModule::isSuperAdmin()),
		array('label'=>UserModule::t('Administrar categorías'), 'url'=>array('/categoria/admin'), 'visible'=>UserModule::isSuperAdmin()),
        //array('label'=>'LIST HEADER'),
    	//array('url'=>Yii::app()->getModule('user')->logoutUrl, 'label'=>Yii::app()->getModule('user')->t("Logout").' ('.Yii::app()->user->name.')', 'visible'=>!Yii::app()->user->isGuest),
    	/*array('url'=>Yii::app()->getModule('user')->loginUrl, 'label'=>Yii::app()->getModule('user')->t("Login"), 'visible'=>Yii::app()->user->isGuest),
    	array('url'=>Yii::app()->getModule('user')->registrationUrl, 'label'=>Yii::app()->getModule('user')->t("Register"), 'visible'=>Yii::app()->user->isGuest),*/
        /*array('label'=>'Home', 'icon'=>'home', 'url'=>'#', 'active'=>true),
        array('label'=>'Library', 'icon'=>'book', 'url'=>'#'),
        array('label'=>'Application', 'icon'=>'pencil', 'url'=>'#'),
        array('label'=>'ANOTHER LIST HEADER'),
        array('label'=>'Profile', 'icon'=>'user', 'url'=>'#'),
        array('label'=>'Settings', 'icon'=>'cog', 'url'=>'#'),
        array('label'=>'Help', 'icon'=>'flag', 'url'=>'#'),*/
    ),
)); ?>
</div>

