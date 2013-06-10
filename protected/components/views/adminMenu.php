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
    	array('label'=>'Roles', 'url'=>array('/rights'), 'visible'=>UserModule::isSuperAdmin()),
		//array('label'=>UserModule::t('List User'), 'url'=>array('/user')),
    	//array('url'=>Yii::app()->getModule('user')->profileUrl, 'label'=>Yii::app()->getModule('user')->t("Profile"), 'visible'=>!Yii::app()->user->isGuest),
		//array('label'=>UserModule::t('Edit User'), 'url'=>array('/user/profile')),
		array('url'=>Yii::app()->getModule('user')->profileUrl, 'label'=>Yii::app()->getModule('user')->t("Profile"), 'visible'=>!Yii::app()->user->isGuest),
		//array('label'=>UserModule::t('Delete User'), 'url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>Yii::app()->id),'confirm'=>UserModule::t('Are you sure to delete this item?'))),
		//array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('/user/profileField/admin'), 'visible'=>UserModule::isSuperAdmin()),
		//array('label'=>UserModule::t('Create Profile Field'), 'url'=>array('/user/profileField/create'), 'visible'=>UserModule::isSuperAdmin()),
		array('label'=>UserModule::t('Administrar categorías'), 'url'=>array('/user/category'), 'visible'=>UserModule::isSuperAdmin()),
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

<?php /*$this->widget('bootstrap.widgets.TbNavbar', array(
    'type'=>'inverse', // null or 'inverse'
    'brand'=>'Project name',
    'brandUrl'=>'#',
    'collapse'=>true, // requires bootstrap-responsive.css
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
                array('label'=>'Home', 'url'=>'#', 'active'=>true),
                array('label'=>'Link', 'url'=>'#'),
                array('label'=>'Dropdown', 'url'=>'#', 'items'=>array(
                    array('label'=>'Action', 'url'=>'#'),
                    array('label'=>'Another action', 'url'=>'#'),
                    array('label'=>'Something else here', 'url'=>'#'),
                    '---',
                    array('label'=>'NAV HEADER'),
                    array('label'=>'Separated link', 'url'=>'#'),
                    array('label'=>'One more separated link', 'url'=>'#'),
                )),
            ),
        ),
        '<form class="navbar-search pull-left" action=""><input type="text" class="search-query span2" placeholder="Search"></form>',
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'htmlOptions'=>array('class'=>'pull-right'),
            'items'=>array(
                array('label'=>'Link', 'url'=>'#'),
                array('label'=>'Dropdown', 'url'=>'#', 'items'=>array(
                    array('label'=>'Action', 'url'=>'#'),
                    array('label'=>'Another action', 'url'=>'#'),
                    array('label'=>'Something else here', 'url'=>'#'),
                    '---',
                    array('label'=>'Separated link', 'url'=>'#'),
                )),
            ),
        ),
    ),
));*/ ?>

<?php $this->endWidget(); ?>