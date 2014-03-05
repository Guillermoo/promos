<?php if(YII_RUTAS == true) echo __FILE__; ?>
<h2>Cuenta <strong>Advanced</strong>:</h2>
<p>Este Bono le ofrece:
    	<table class="table table-hover" align="center">
  		<tr>
  			<th>Característica</th>
  			<th>Cantidad</th>
  			<th>Descripción</th>
  		</tr>
  		<tr>
  			<td>Promos activas</td>
  			<td  align="center"><span class="badge badge-inverse">10</span></td>
  			<td>Las promociones activas son las que aparecen en la oferta de promociones cuando un visitante entra a nuestra página...</td>
  		</tr>
      <tr>
        <td>Promos en stock</td>
        <td align="center"><span class="badge badge-inverse">30</span></td>
        <td>Las promociones en stock son las que están ya configuradas y disponibles para estar activas...</td>
      </tr>
      <tr>
        <td>Promos destacadas</td>
        <td align="center"><span class="badge badge-inverse">1</span></td>
        <td>Las promociones destacadas son las que tendrán prioridad al aparecer en la oferta de promociones general...</td>
      </tr>
		</table>
    </p>
    <div class="clearfix">&nbsp;</div>
    <p>
    	<div class="alert alert-info">
		Precio: <strong>15.99 €/mes</strong>
		</div>
    	(Poner ofertas por compra de varios meses y esas cosas si hay)
    </p>
    <p>	
    	El pago se debe realizar a través de paypal. Una vez que el pago se haya realizado, se activará automáticamente.
    	<div class="botonpaypal"><center>
		<?php $this->widget('bootstrap.widgets.TbButton', array(
    	'buttonType'=>'button',
    	'type'=>'primary',
    	'label'=>'Pago por paypal',
    	'loadingText'=>'cargando...',
    	'url'=>'#',
    	'icon'=>'shopping-cart',
    	'htmlOptions'=>array('id'=>'buttonStateful'),
		)); ?>
		</center></div>
    </p>