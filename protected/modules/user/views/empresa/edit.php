<?php if(YII_RUTAS == true) echo __FILE__; ?>
<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Profile");?>

<?php if(UserModule::isCompany()):?>
    <h1><?php echo UserModule::t('Your company'); ?></h1>
<?php else: ?>
    <h1><?php echo UserModule::t('Edit commpany'); ?></h1>
<?php endif;?>

<?php
    echo $this->renderPartial('_form', array('action'=>'_form','empresa'=>$empresa,'image'=>$image));
?>