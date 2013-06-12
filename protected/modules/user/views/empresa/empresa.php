<?php echo __FILE__; ?>
<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Company");?>
<h1><?php //echo UserModule::t('Your profile'); ?></h1>

<h1><?php echo UserModule::t('Your company'); ?></h1>

<?php if(Yii::app()->user->hasFlash('companyMessage')): ?>
<div class="success">
	<?php echo Yii::app()->user->getFlash('companyMessage'); ?>
</div>
<?php endif; ?>

<?php if(UserModule::isCompany()):?>
	<?php $this->renderPartial('_form', array('model'=>$model,'image'=>$image));?>
	<?php /*$this->widget('bootstrap.widgets.TbTabs', array(
	    'tabs'=>$this->getTabularFormTabs($model,$categorias,$cuentas),
	));*/ ?>
<?php endif;?>
 	
