<?php
/* @var $this CuentasController */
/* @var $data Cuentas */
?>
<div class="plan-name-<?php echo CHtml::encode($data->titulo); ?>">
<h2>Cuenta <strong><?php echo CHtml::encode($data->titulo); ?></strong></h2>
  <p>Esta suscripción le ofrece:
</div>
    <table class="table table-hover" align="center">
      <tr>
        <th>Característica</th>
        <th>Cantidad</th>
        <th>Descripción</th>
      </tr>
      <tr>
        <td>Promos activas</td>
        <td  align="center"><span class="badge badge-inverse"><?php echo CHtml::encode($data->prom_activ); ?></span></td>
        <td>Las promociones activas son las que aparecen en la oferta de promociones cuando un visitante entra a nuestra página...</td>
      </tr>
      <tr>
        <td>Promos en stock</td>
        <td align="center"><span class="badge badge-inverse"><?php echo CHtml::encode($data->prom_stock); ?></span></td>
        <td>Las promociones en stock son las que están ya configuradas y disponibles para estar activas...</td>
      </tr>
      <tr>
        <td>Promos destacadas</td>
        <td align="center"><span class="badge badge-inverse"><?php echo CHtml::encode($data->prom_dest); ?></span></td>
        <td>Las promociones destacadas son las que tendrán prioridad al aparecer en la oferta de promociones general...</td>
      </tr>
    </table>
    </p>
    <div class="clearfix">&nbsp;</div>
    <p>
      <div class="alert alert-success">
    <h3>Precio: <strong><?php echo CHtml::encode($data->precio); ?> €/mes</strong></h3>
    </div>
    </p>
    <p> 
      El pago se debe realizar a través de paypal. Una vez que el pago se haya realizado su suscripción a esta cuenta se activará automáticamente.
      <div class="botonpaypal"><center>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
      'buttonType'=>'button',
      'type'=>'success',
      'size'=>'large',
      'label'=>'Pago por paypal',
      'loadingText'=>'cargando...',
      'url'=>'#',
      'icon'=>'shopping-cart',
      'htmlOptions'=>array('id'=>'buttonStateful'),
    )); ?>
    </center></div>
    </p>