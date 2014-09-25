<?php echo __FILE__; ?>
<?php
$this->breadcrumbs=array(
	UserModule::t('Users')=>array('index'),
	$model->username,
);
$this->menu=array(
    array('label'=>UserModule::t('List User'), 'url'=>array('index')),
);
?>
<h2><?php echo $profile->username; ?></h2>
<div class="well">
<div class="row-fluid">Nombre: <b><?php echo $profile->username ." ".$profile->lastname; ?></b></div>
<div class="row-fluid">Email: <b><?php echo $model->email; ?></b></div>
<div class="row-fluid">Teléfono: <b><?php echo $profile->telefono; ?></b></div>
<div class="row-fluid">Dirección: <b><?php echo $profile->direccion; ?></b></div>
<div class="row-fluid">Población: <b><?php echo $profile->poblacion_id; ?></b></div>
</div>
