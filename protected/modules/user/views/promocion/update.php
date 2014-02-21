
<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Promotion");?>

<h1>Actualizar promoción "<?php echo $model->titulo; ?>"</h1>
<?php //$this->debug($promosDest);
	//$this->debug($maxDest);
	$numPromos = Promocion::model()->countByAttributes(array(
            'user_id'=> Yii::app()->user->id
        ));
	$numPromosActivas = Promocion::model()->countByAttributes(array(
            'user_id'=> Yii::app()->user->id, 'estado'=>1
        ));
	$numPromosStock = Promocion::model()->countByAttributes(array(
            'user_id'=> Yii::app()->user->id, 'estado'=>0
        ));	

	$profile = Profile::model()->find('user_id=:user_id',array(':user_id'=>Yii::app()->user->id));
	$cuenta = Cuenta::model()->find('id=:id',
		array(':id'=>$profile->tipocuenta
		));
 ?>

<?php echo $this->renderPartial('_form', array('model'=>$model,'image'=>$image, 'promosDest'=>$promosDest, 'maxDest'=>$maxDest, 'maxActivas'=> $cuenta->prom_activ,'promoActivas'=>$numPromosActivas)); ?>


