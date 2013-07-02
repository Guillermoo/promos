<?php if(YII_RUTAS == true) echo __FILE__; ?>
<h2>Disponemos de los siguientes tipos de cuentas:</h2>
<div class="row-fluid pricing-table pricing-three-column">
<?php if ($model->status == 1):?>
	<?php echo "Ud. está usando la cuenta gratuita. No cree que es un poco rancio?" ?>
<?php endif; ?>

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