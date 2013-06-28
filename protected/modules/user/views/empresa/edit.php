<?php if(UserModule::isCompany()):?>
    <h1><?php echo UserModule::t('Your company'); ?></h1>
	<?php //$this->renderPartial('_form', array('empresa'=>$model->empresa,'image'=>$image));?>
	<?php /*$this->widget('bootstrap.widgets.TbTabs', array(
	    'tabs'=>$this->getTabularFormTabs($model,$categorias,$cuentas),
	));*/ ?>
<?php else: ?>
    <h1><?php echo UserModule::t('Edit commpany'); ?></h1>
<?php endif;?>

<?php
    echo $this->renderPartial('_form', array('action'=>'_form','empresa'=>$model->empresa,'image'=>$image));
?>