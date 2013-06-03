<?php echo __FILE__; ?> 
<?php
$this->breadcrumbs=array(
	UserModule::t('Users')=>array('admin'),
	$model->username,
);

?>
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
			'profile.tipocuenta',
			'profile.fecha_activacion',
			'profile.fecha_fin',
			'profile.fecha_pago',
			'empresa.contacto.telefono',
			'empresa.contacto.fax',
			'empresa.contacto.cp',
			'empresa.contacto.barrio',
			'empresa.contacto.direccion',
			'empresa.contacto.poblacion'
		);
	}
	
	/*array(
			'name' => 'user',
			'type' => 'raw',
			'value' => $model->user !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->user)), array('users/view', 'id' => GxActiveRecord::extractPkValue($model->user, true))) : null,
			),*/
			
	
	/*$profileFields=Profile::model()->paraAdmin()->sort()->findAll();
	if ($profileFields) {
		foreach($profileFields as $field) {
			array_push($attributes,array(
					'label' => UserModule::t($field->title),
					'name' => $field->varname,
					'type'=>'raw',
					'value' => (($field->widgetView($model->profile))?$field->widgetView($model->profile):(($field->range)?Profile::range($field->range,$model->profile->getAttribute($field->varname)):$model->profile->getAttribute($field->varname))),
				));
		}
	}*/
	
	$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>$attributes,
	));
	

?>
