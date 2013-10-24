<?php
/* @var $this CuentasController */
/* @var $data Cuentas */
?>

        <div class="span4 plan plan-name-<?php echo CHtml::encode($data->titulo); ?>">
          <div class="plan-name-<?php echo CHtml::encode($data->titulo); ?>-head">
            <h2><center><?php echo CHtml::encode($data->titulo); ?></center></h2>
            <span><?php echo CHtml::encode($data->precio); ?> € / Mes</span>
          </div>
          <ul>
            <li class="plan-feature"><?php echo CHtml::encode($data->prom_activ); ?> Promo activa</li>
            <li class="plan-feature"><?php echo CHtml::encode($data->prom_stock); ?> Promos en stock</li>
            <li class="plan-feature"><?php echo CHtml::encode($data->prom_dest); ?> Promos destacadas</li>
          </ul>
            <p><center><a href="cuentas/verCuenta?id=<?php echo $data->id ?>" class="btn btn-large btn-inverse btn-plan-select"><i class="icon-white icon-ok"></i> Seleccionar</a></center></p>      
        </div>

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('desc_trim')); ?>:</b>
	<?php echo CHtml::encode($data->desc_trim); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desc_sem')); ?>:</b>
	<?php echo CHtml::encode($data->desc_sem); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desc_ano')); ?>:</b>
	<?php echo CHtml::encode($data->desc_ano); ?>
	<br />

	*/ ?>