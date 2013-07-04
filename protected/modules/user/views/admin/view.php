<?php echo __FILE__; ?> 

<h1><?php echo UserModule::t('View User').' "'.$model->username.'"'; ?></h1>

<?php
 
	$attributes = array(
		'id',
		'username',
		'email',
		'password',
		'activkey',
		'create_at',
		'lastvisit_at',
		array(
			'name' => 'superuser',
			'value' => User::itemAlias("AdminStatus",$model->superuser),
		),
		array(
			'name' => 'status',
			'value' => User::itemAlias("UserStatus",$model->status),
		),
	);
	
	if (Yii::app()->authManager->checkAccess('empresa', $model->id)){
		/*campos de profile y contacto*/
		array_push($attributes,
			'profile.username',
			'profile.lastname',
			'profile.paypal_id',
			'profile.cuenta.titulo',
			'profile.fecha_activacion',
			'profile.fecha_fin',
			'profile.fecha_pago',
			'profile.telefono',
			'profile.fax',
			'profile.cp',
			'profile.barrio',
			'profile.direccion',
			'profile.poblacion'
		);
	}
	
	$this->widget('bootstrap.widgets.TbDetailView', array(
		'data'=>$model,
		'attributes'=>$attributes,
	));
	

?>
