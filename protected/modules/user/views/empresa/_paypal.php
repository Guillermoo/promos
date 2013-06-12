<form id="paypal_form" action="<?=Yii::app()->params['url_paypal']?>" method="post">
	<!--<input type="hidden" name="cmd" value="_ext-enter">
	<input type="hidden" name="cmd" value="_cart">
	<!--<input type="hidden" name="redirect_cmd" value="_xclick">
	<input type="hidden" name="upload" value="1">
	<INPUT TYPE="hidden" NAME="charset" value="UTF-8">
	<INPUT TYPE="hidden" NAME="rm" value="1">
	<INPUT TYPE="hidden" NAME="currency_code" value="EUR">-->
	<input type="hidden" name="no_shipping" value="1">
	<input type="hidden" name="business" value="<?=Yii::app()->params['email_paypal'];?>">  
	
	<input type="hidden" name="item_name" value="<?=$profile->cuenta->titulo ?>">  
	<input type="hidden" name="item_number" value="<?=$profile->poblacion->id ?>">
	<input type="hidden" name="amount" value="<?=$profile->meses?>">
	<!-- <input type="hidden" name="quantity_<?=//$i+1;?>" value="<?=//$pedido['Venta'][$i]['cantidad']?>"> 
	<input type="hidden" name="amount" value="<?=//$precio?>">
	<input type="hidden" name="shipping" value=0>-->
	
	<INPUT TYPE="hidden" NAME="return" value="http://<?=$_SERVER['SERVER_NAME'] ?>/pedidos/gracias">
	<INPUT TYPE="hidden" NAME="notify_url" value="http://<?=$_SERVER['SERVER_NAME'] ?>/pedidos/conexion_paypal">
	<INPUT TYPE="hidden" NAME="cancel_return" value="http://<?=$_SERVER['SERVER_NAME'] ?>/pages/cancelado">
	<input type="hidden" name="custom" value="<?=$empresa->id;?>">
	
	<INPUT TYPE="hidden" NAME="first_name" value="<?=$profile->username?>">
	                        <?php if($profile->lastname != ""): ?>
	<INPUT TYPE="hidden" NAME="last_name" value="<?=$profile->lastname?>">
	                        <?php endif;?>
	<INPUT TYPE="hidden" NAME="address1" value="<?=$profile->direccion?>">
	<INPUT TYPE="hidden" NAME="city" value="<?=$profile->poblacion->name?> (<?=$profile->poblacion->provincia?>)">
	<INPUT TYPE="hidden" NAME="zip" value="<?=$profile->cp?>">
	                        <INPUT TYPE="hidden" NAME="email" VALUE="<?=$model->email?>">
	<INPUT id="paypal_submit" TYPE="submit" VALUE="Paypal" />
</form>