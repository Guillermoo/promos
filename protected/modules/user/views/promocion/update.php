
<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Promotion");?>

<h1><?echo UserModule::t('Update Promotion ');?> <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>