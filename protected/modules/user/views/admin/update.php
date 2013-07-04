
<h1><?php echo  UserModule::t('Update User')." ".$model->username; ?></h1>

<?php
	echo $this->renderPartial('_form', array('action'=>'update','model'=>$model,'image'=>$image));
?>



