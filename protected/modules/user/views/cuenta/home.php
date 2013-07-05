<?php if(YII_RUTAS == true) echo __FILE__; ?>
<h2>Cuenta del usuario</h2>
<?php //(G)Si el usuario no ha rellenado los campos mínimos para poder vender, le apareceŕa?>
<?php //Hay que mirar que si es ?>
<?php if ($model->status == 1):?>
<div class="alert">
  <strong>Atención!</strong> Está usando la suscripción gratuita.
</div>
	
<div class="row-fluid pricing-table pricing-three-column">
        <div class="span4 plan">
          <div class="plan-name-bronze">
            <h2>Lite</h2>
            <span>8.99 € / Mes</span>
          </div>
          <ul>
            <li class="plan-feature">1 Promo activa</li>
            <li class="plan-feature">2 Promos en stock</li>
            <li class="plan-feature">0 Promos destacadas</li>
            <li class="plan-feature"><a href="#" class="btn btn-primary btn-plan-select"><i class="icon-white icon-ok"></i> Seleccionar</a></li>
          </ul>
        </div>
        <div class="span4 plan">
          <div class="plan-name-silver">
            <h2>Basic</h2>
            <span>9.99 € / Mes</span>
          </div>
          <ul>
            <li class="plan-feature">5 Promos activas</li>
            <li class="plan-feature">10 Promos en stock</li>
            <li class="plan-feature">1 Promo destacada</li>
            <li class="plan-feature"><a href="#" class="btn btn-primary btn-plan-select"><i class="icon-white icon-ok"></i> Seleccionar</a></li>
          </ul>
        </div>
        <div class="span4 plan">
          <div class="plan-name-gold">
            <h2>Advanced</h2>
            <span>15.99 € / Mes</span>
          </div>
          <ul>
            <li class="plan-feature">10 Promos activas</li>
            <li class="plan-feature">30 Promos en stock</li>
            <li class="plan-feature">1 Promo destacada</li>
            <li class="plan-feature"><a href="#" class="btn btn-primary btn-plan-select"><i class="icon-white icon-ok"></i> Seleccionar</a></li>
          </ul>
        </div>
      </div>

<?php elseif($model->status == 2) :?>
	<?php echo "Ud. ha elegido un tipo de cuenta de pago. ";?>

	<?php if($model->profile->tipocuenta != 3):?>
		<?php echo "Ko, paga!!, que no has pagao aún";?>
	<?php endif;?>
	<!-- Lo que tenga que salir de normal -->
<?php endif;?>
<div class="clearfix">&nbsp;</div>
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'=>'button',
    'type'=>'primary',
    'label'=>'Ver tipos de cuenta',
    'loadingText'=>'cargando...',
    'url'=>array('cuenta/cuentas'),
    'htmlOptions'=>array('id'=>'buttonStateful'),
)); ?>


<?php
	echo CHtml::link('Ver tipos de cuenta',array('cuenta/vercuentas'));
?>

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