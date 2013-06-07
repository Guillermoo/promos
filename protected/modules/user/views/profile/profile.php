<?php echo __FILE__; ?>
<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Profile");
/*$this->breadcrumbs=array(
	UserModule::t("Profile"),
);*/
?><h1><?php //echo UserModule::t('Your profile'); ?></h1>

<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
<div class="success">
	<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
</div>
<?php endif; ?>

<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
<div class="success">
	<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
</div>
<?php endif; ?>

<?php /** @var TbActiveForm $form */
	/*$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	    'id'=>'profile-form',
		'enableAjaxValidation'=>true,
		'htmlOptions' => array('enctype'=>'multipart/form-data'),
	    'type'=>'horizontal'
	));*/?>
	<?php if(Yii::app()->authManager->checkAccess('empresa', Yii::app()->user->id)):?>
		<?php $this->widget('bootstrap.widgets.TbTabs', array(
		    'tabs'=>$this->getTabularFormTabs($model,$categorias,$cuentas),
		)); ?>
 	<?php endif;?>
 	
