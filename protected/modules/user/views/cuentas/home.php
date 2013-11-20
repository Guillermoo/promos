<?php if(YII_RUTAS == true) echo __FILE__; ?>
<h2>Cuenta del usuario</h2>
<?php //(G)Si el usuario no ha rellenado los campos mínimos para poder vender, le apareceŕa?>
<?php //Hay que mirar que si es ?>
<?php if ($model->status == 1):?>
<div class="alert alert-success">
  <strong>Atención!</strong> Está usando la suscripción gratuita.
</div>
	
<div class="row-fluid pricing-table pricing-three-column">
  <?php $this->widget('zii.widgets.CListView', array(
  'dataProvider'=>$dataProvider,
  'itemView'=>'_view',
)); ?>
</div>

<?php elseif($model->status == 2) :?>
	<?php echo "Ud. ha elegido un tipo de cuenta de pago. "; ?>

	<?php if($model->profile->tipocuenta != 3):?>
		<?php echo "Todavía no se ha realizado el pago";?>
	<?php endif;?>
	<?php // cancelación de la suscripción ?>
	<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_subscr-find&alias=CJRD44LCAZWBY">
	<img src="https://www.paypalobjects.com/es_ES/ES/i/btn/btn_unsubscribe_SM.gif" border="0">
	</a>

	<!-- Lo que tenga que salir de normal -->
	<?php $this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'=>'button',
    'type'=>'primary',
    'label'=>'Ver tipos de cuenta',
    'loadingText'=>'cargando...',    
    'htmlOptions'=>array('id'=>'buttonStateful'),
)); ?>
<?php endif;?>
<div class="clearfix">&nbsp;</div>

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