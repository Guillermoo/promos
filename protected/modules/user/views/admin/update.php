
<h1><?php echo  UserModule::t('Update User')." ".$model->username; ?></h1>

<?php
	echo $this->renderPartial('_form', array('model'=>$model,'profile'=>$profile,'empresa'=>$empresa,'categorias'=>$categorias,'esEmpresa'=>$esEmpresa,'cuentas'=>$cuentas,'contacto'=>$contacto,'logo'=>$logo));
?>

<?php
	echo $this->renderPartial('contacto/_form', array('model'=>$model,'esEmpresa'=>$esEmpresa,'contacto'=>$contacto));
?>