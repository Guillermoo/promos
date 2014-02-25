<?php
/* @var $this CuentasController */
/* @var $data Cuentas */
?>
<div class="plan-name-<?php echo CHtml::encode($data->titulo); ?>">
<h2>Bono <strong><?php echo CHtml::encode($data->titulo); ?></strong></h2>
  <p>Este bono te ofrece:
</div>
    <table class="table table-hover" align="center">
      <tr>
        <th>Característica</th>
        <th>Cantidad</th>
        <th>Descripción</th>
      </tr>
      <tr>
        <td>Promociones activas</td>
        <td  align="center"><span class="badge badge-inverse"><?php echo CHtml::encode($data->prom_activ); ?></span></td>
        <td>Las promociones activas son las que aparecen en la oferta de promociones cuando un visitante entra a nuestra página, es decir, son promociones visibles para el público en general.</td>
      </tr>
      <tr>
        <td>Promociones inactivas</td>
        <td align="center"><span class="badge badge-inverse"><?php echo CHtml::encode($data->prom_stock); ?></span></td>
        <td>Las promociones inactivas son las que están ya configuradas y disponibles para estar activas, pero todavía no lo están. Las promociones inactivas no las verá el público general, solamente puede verlas las personas que las han creado. De esta forma se puede dejar una promoción lista para que se haga pública automáticamente otro día que tú indiques.</td>
      </tr>
      <tr>
        <td>Promos destacadas</td>
        <td align="center"><span class="badge badge-inverse"><?php echo CHtml::encode($data->prom_dest); ?></span></td>
        <td>Las promociones destacadas aparecen en primer lugar en la página principal. Son las promociones que el público verá primero.</td>
      </tr>
    </table>
    </p>
    <div class="clearfix">&nbsp;</div>
    <p>
      <div class="alert alert-success">
    <h3>Precio: <strong><?php echo CHtml::encode($data->precio); ?> €</strong></h3>
    </div>
    </p>
    <p> 
      El pago se debe realizar a través de paypal. Una vez que el pago se haya realizado, ya podrás comenzar a publicar promociones y ganar dinero.
      <div class="botonpaypal"><center>
    
    <?php if($data->id == 1): ?>
    <?php //SI CAMBIO LOS BOTONES DE SUSCRIPCIÓN, MANTENER EL CAMPO "CUSTOM" ?>
    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
      <input type="hidden" name="cmd" value="_s-xclick">
      <input type="hidden" name="custom" value="<?=Yii::app()->user->id ?>_<?=$data->id; ?>" />
      <input type="hidden" name="hosted_button_id" value="ZYDSP49JCGQK4">
      <input type="image" src="https://www.paypalobjects.com/es_ES/ES/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal. La forma rápida y segura de pagar en Internet.">
      <img alt="" border="0" src="https://www.paypalobjects.com/es_ES/i/scr/pixel.gif" width="1" height="1">
    </form>
    <?php elseif ($data->id == 2): ?>
      <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
        <input type="hidden" name="cmd" value="_s-xclick">
        <input type="hidden" name="custom" value="<?=Yii::app()->user->id ?>_<?=$data->id; ?>" />
        <input type="hidden" name="hosted_button_id" value="WGBDB8K3J7AQ8">
        <input type="image" src="https://www.paypalobjects.com/es_ES/ES/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal. La forma rápida y segura de pagar en Internet.">
        <img alt="" border="0" src="https://www.paypalobjects.com/es_ES/i/scr/pixel.gif" width="1" height="1">
      </form>
    <?php elseif ($data->id == 3): ?>
      <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
        <input type="hidden" name="cmd" value="_s-xclick">
        <input type="hidden" name="custom" value="<?=Yii::app()->user->id ?>_<?=$data->id; ?>" />
        <input type="hidden" name="hosted_button_id" value="REZ4D8SXMC8KJ">
        <input type="image" src="https://www.paypalobjects.com/es_ES/ES/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal. La forma rápida y segura de pagar en Internet.">
        <img alt="" border="0" src="https://www.paypalobjects.com/es_ES/i/scr/pixel.gif" width="1" height="1">
      </form>
    <?php endif; ?>

    </center></div>
    

    </p>