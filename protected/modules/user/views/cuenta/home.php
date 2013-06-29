<?php if(YII_RUTAS == true) echo __FILE__; ?>
<br>
<h2>Página de información sobre la cuenta del usuario</h2>

<?php //(G)Si el usuario no ha rellenado los campos mínimos para poder vender, le apareceŕa?>
<?php //Hay que mirar que si es ?>
<?php if ($model->status == 1):?>
	<?php echo "Ud. está usando la cuenta gratuita. No cree que es un poco rancio?"?>
<?php elseif($model->status == 2) :?>
	<?php echo "Ud. ha elegido un tipo de cuenta de pago"; ?>
	<?php if($model->profile->tipocuenta != 3):?>
		<?php echo "Ko, paga!!, que no has pagao aún";?>
	<?php endif;?>
	<!-- Lo que tenga que salir de normal -->
<?php endif;?>

<?php $this->beginWidget('bootstrap.widgets.TbModal', 
	array(
		'id'=>'myModal',
		'htmlOptions'=>array(
			'style'=>'width:600px',	
		),
	)); ?>
 
<?php $this->endWidget(); ?>

<script>

//$(document).ready(function() {
//	   $('#btn_show').trigger("click");
//	});
	
</script>