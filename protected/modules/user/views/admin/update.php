
<h1><?php echo  UserModule::t('Update User')." ".$model->username; ?></h1>

<?php
	echo $this->renderPartial('_form', array('action'=>'admin/update','model'=>$model,'categorias'=>$categorias,'esEmpresa'=>$esEmpresa,'cuentas'=>$cuentas,'image'=>$image));
?>

