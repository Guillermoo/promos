
<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Promotion");?>

<h1>Actualizar promoción "<?php echo $model->titulo; ?>"</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'image'=>$image)); ?>


