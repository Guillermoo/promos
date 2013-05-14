<!-- <ul>
	<li><?php //echo CHtml::link('Create New Post',array('post/create')); ?></li>
	<li><?php //echo CHtml::link('Manage Posts',array('post/admin')); ?></li>
	<li><?php //echo CHtml::link('Logout',array('site/logout')); ?></li>
</ul> -->

<?php $this->beginWidget('zii.widgets.CPortlet', array(
                'title'=>'Admin Operations',
            ));
?>
<?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'list',
    'items'=>array(
		array('label'=>UserModule::t('Create User'), 'icon'=>'home', 'url'=>array('/user/admin/create')),
		array('label'=>UserModule::t('Manage Users'), 'url'=>array('/user/admin')),
    	array('label'=>'Roles', 'url'=>array('/rights'), 'visible'=>Yii::app()->authManager->checkAccess('superadmin', Yii::app()->user->id)),
		array('label'=>UserModule::t('List User'), 'url'=>array('/user')),
    	//array('url'=>Yii::app()->getModule('user')->profileUrl, 'label'=>Yii::app()->getModule('user')->t("Profile"), 'visible'=>!Yii::app()->user->isGuest),
		array('label'=>UserModule::t('Update User'), 'url'=>array('profile/edit','id'=>Yii::app()->user->id)),
		//array('label'=>UserModule::t('Delete User'), 'url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>Yii::app()->id),'confirm'=>UserModule::t('Are you sure to delete this item?'))),
		array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('/user/profileField/admin'), 'visible'=>Yii::app()->authManager->checkAccess('superadmin', Yii::app()->user->id)),
		array('label'=>UserModule::t('Create Profile Field'), 'url'=>array('/user/profileField/create'), 'visible'=>Yii::app()->authManager->checkAccess('superadmin', Yii::app()->user->id)),
        array('label'=>'LIST HEADER'),
    	array('url'=>Yii::app()->getModule('user')->logoutUrl, 'label'=>Yii::app()->getModule('user')->t("Logout").' ('.Yii::app()->user->name.')', 'visible'=>!Yii::app()->user->isGuest),
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

<?php $this->endWidget(); ?>