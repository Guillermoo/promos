
<h1>Create Promociones</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

<?php 
 	$user = User::model()->findByPk(7);
	echo $user->profile->tipocuenta; 
	//echo $user->profile->cuentas->prom_stock;

?>