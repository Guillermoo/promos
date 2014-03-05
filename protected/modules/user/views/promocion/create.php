<h1>Crear Promoción</h1>


<?php

	//Tengo que comprobar si puede crear una nueva promoción.
	//Únicamente NO podrá crear una nueva si ya tiene todas las posibles en stock y activas.
	//Habría que avisar de cuántas promos le quedan por crear de cada tipo
 	$user = User::model()->findByPk(Yii::app()->user->id); 	
 	//$this->debug($user);
	//echo "<br/>Tipo cuenta: ".$user->profile->tipocuenta; 
	//número de promociones que tiene el usuario:
	$numPromos = Promocion::model()->countByAttributes(array(
            'user_id'=> Yii::app()->user->id
        ));
	$numPromosActivas = Promocion::model()->countByAttributes(array(
            'user_id'=> Yii::app()->user->id, 'estado'=>1
        ));
	$numPromosStock = Promocion::model()->countByAttributes(array(
            'user_id'=> Yii::app()->user->id, 'estado'=>0
        ));	
	//número máximo de promos que permite el tipo de cuenta del usuario:
	$datosCuenta = Cuenta::model()->find('id=:id',
array(
  ':id'=>$user->profile->tipocuenta
));
	$maxPromos = $datosCuenta->prom_activ + $datosCuenta->prom_stock;
	?>
	<div class="alert alert-info">Número de promociones que tiene creadas: <?php echo "<b>".$numPromos." </b> de <b>".$maxPromos."</b>"; ?>. </div>	
	<?php 
	if($datosCuenta->prom_activ == $numPromosActivas)
		echo "<div class=\"alert alert-warning\">No puedes crear más promociones <b>ACTIVAS</b></div>";
	?>
	<?php 
	if($datosCuenta->prom_stock == $numPromosStock)
		echo "<div class=\"alert alert-warning\">No puedes crear más promociones en <b>STOCK</b></div>";
	?>
	<?php 
	if($user->empresa->verificado == 0): ?>
		<div class="row">			
		<div class="well well-small">
			<div class="alert alert-error"><b>ATENCIÓN:</b> No puedes publicar promociones hasta que no se verifica tu cuenta.
		</div>
		<p>Si ha rellenado los datos de su perfil y los datos de su empresa, un responsable de Proemoción verificará que su empresa es real y que los datos son correctos. Si es así, se activará su cuenta para que pueda publicar sus promociones. </p><p>Para cualquier consulta no dude en contactar con nosotros, bien por teléfono o a través del formulario de contacto pinchando en "Contacto" en el menú superior.</p></div>
		</div>
	<?php endif; ?>
	<?php if($user->profile->fecha_fin != '0000-00-00' && strtotime($user->profile->fecha_fin) < strtotime(date('Y-m-d'))): ?>
    <div class="alert alert-error">
        <b>Su Bono ha caducado.</b> Para poder publicar promociones tienes que adquirir un nuevo bono.
    </div>
<?php endif; ?>
	<?php
	if($numPromos < $maxPromos){
		echo $this->renderPartial('_form', array('model'=>$model,'item'=>$item,'image'=>$image, 'maxPromos'=>$maxPromos, 'maxActivas'=>$datosCuenta->prom_activ, 'maxStock'=>$datosCuenta->prom_stock,'promoActivas'=>$numPromosActivas,'promoStock'=>$numPromosStock,'maxDest'=>$maxDest,'promosDest'=>$promosDest,'verificado'=>$user->empresa->verificado,'fecha_fin'=>$user->profile->fecha_fin));
	}else{
		echo $this->renderPartial('_denied');
	}
	?>