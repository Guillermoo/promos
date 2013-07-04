<?php if(YII_RUTAS == true) echo __FILE__; ?>
<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Company");?>
<h1><?php //echo UserModule::t('Your profile'); ?></h1>

<?php if(UserModule::isCompany()):?>
    <h1><?php echo UserModule::t('Your company'); ?></h1>
	<?php $this->renderPartial('_form', array('empresa'=>$model->empresa,'image'=>$image));?>
	<?php /*$this->widget('bootstrap.widgets.TbTabs', array(
	    'tabs'=>$this->getTabularFormTabs($model,$categorias,$cuentas),
	));*/ ?>
<?php else: ?>
    <h1><?php echo UserModule::t('Edit commpany'); ?></h1>
<?php endif;?>
 	
