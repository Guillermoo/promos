<?php if(YII_RUTAS == true) echo __FILE__; ?>
<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Profile");?>

<?php if(UserModule::isCompany()):?>
    <h1>Perfil de empresa</h1>
<?php else: ?>
    <h1><?php echo UserModule::t('Edit commpany'); ?></h1>
<?php endif;?>
<p>&nbsp;</p>
<p>Si introduce los datos del perfil de empresa, los clientes potenciales podrán ver la siguiente información.</p>
<?php $user = User::model()->find('user_id=:user_id',array(':user_id'=>$empresa->user_id)); ?>

<?php if(UserModule::isAdmin()): ?>
	<h4>Datos del usuario:</h4>
	<div class="row well">
		<div class="span3">E-mail: <strong><?php echo $user->email; ?></strong></div>
		<div class="span3">
			Nombre: 
			<strong><?php echo $user->profile->username." ".$user->profile->lastname; ?></strong>
		</div>
		<div class="span3">
			Bono:
			<strong><?php echo $user->profile->tipocuenta; ?></strong>
		</div>
		<div class="span3">
			PayPal id:
			<strong><?php echo $user->profile->paypal_id; ?></strong>
		</div>
		<div class="span3">
			Teléfono:
			<strong><?php echo $user->profile->telefono; ?></strong>
		</div>
		<div class="span3">
			Dirección:
			<strong><?php echo $user->profile->direccion; ?></strong>
		</div>
	</div>
	<div class="row">
		<?php $this->widget(
    		'bootstrap.widgets.TbButton',
    		array(
        		'label' => 'Asignar Bono',
        		'type' => 'primary',

        		'url' => array('cuentas/usuarioCuenta/user_id/'.$user->id),
    		)
		); ?>
	</div>
	<div class="clearfix">&nbsp;</div>
<?php endif; ?>
<?php
    echo $this->renderPartial('_form', array('action'=>'_form','empresa'=>$empresa,'image'=>$image));
?>