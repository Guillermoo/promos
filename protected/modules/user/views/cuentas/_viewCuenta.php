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
      El pago se puede hacer mediante PayPal o con tarjeta. Una vez que el pago se haya realizado, ya podrás comenzar a publicar promociones y ganar dinero.
      <div class="botonpaypal"><center>
    
    <?php //SI CAMBIO LOS BOTONES DE SUSCRIPCIÓN, MANTENER EL CAMPO "CUSTOM" ?>
    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
      <input type="hidden" name="cmd" value="_xclick">
      <input type="hidden" name="custom" value="<?=Yii::app()->user->id ?>_<?=$data->id; ?>" />
      <intput type="hidden" name="notify_url" value="http://wwww.proemocion.com/cuenta/checkoutCompra">
      <input type="hidden" name="quantity" value="1">
      <input type="hidden" name="currency_code" value="EUR">
      <?php if($data->id == 1): ?>
        <input type="hidden" name="return" value="http://www.proemocion.com/site/pagoMini" >
      <?php endif; ?>
      <?php if($data->id == 2): ?>
        <input type="hidden" name="return" value="http://www.proemocion.com/site/pagoBasico" >
      <?php endif; ?>
      <?php if($data->id == 3): ?>
        <input type="hidden" name="return" value="http://www.proemocion.com/site/pagoPremium" >
      <?php endif; ?>
      <input type="hidden" name="amount" value="<?=$data->precio ?>">      
      <input type="hidden" name="business" value="<?php echo Yii::app()->params['websiteEmail'] ?>">
      <!-- <input type="hidden" name="business" value="hlanga.business@hlanga.es"> -->
      <input type="image" src="https://www.paypalobjects.com/es_ES/ES/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal. La forma rápida y segura de pagar en Internet.">
      <img alt="" border="0" src="https://www.paypalobjects.com/es_ES/i/scr/pixel.gif" width="1" height="1">
    </form>

    </form>
    </center></div>
    

    </p>