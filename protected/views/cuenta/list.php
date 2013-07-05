<?php
/* @var $this CuentaController */
/* @var $model Cuenta */

$this->breadcrumbs=array(
	'Cuentas'=>array('index'),
	$model->id,
);
?>
<!-- Esta es la página que podrán ver los visitantes intersados en registrarse como usuario-empresa para que vean las opciones que tienen -->
<h1>Tipos de suscripción</h1>

<?php //MOSTRAR EL PRECIO Y LAS CARACTERÍSTICAS DE LA BD ?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'nombre',
		'precio',
		'duracion',
	),
)); ?>

<div>Al registrarse como empresa tendrá disponible una suscripción GRATUITA que le permitirá ... tal tal tal...</div>

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