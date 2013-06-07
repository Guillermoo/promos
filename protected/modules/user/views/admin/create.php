<h1><?php echo UserModule::t("Create User"); ?></h1>

<?php
	echo $this->renderPartial('_form', array('action'=>'admin/create','model'=>$model,'categorias'=>$categorias,'esEmpresa'=>$esEmpresa,'cuentas'=>$cuentas));
?>