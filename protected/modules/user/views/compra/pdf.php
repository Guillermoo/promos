<?php
/* @var $this CompraController */
/* @var $model Compra */
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/bootstrap.css');
?>


    <div class="container-narrow-pdf">
    	<div class="span12"><p><?php echo CHtml::link('Volver',Yii::app()->user->returnUrl,array('class'=>'btn btn-success')); ?></p></div>
      <div class="masthead">
      	<?php  echo CHtml::image(Yii::app()->getBaseUrl()."/img/logo.png "); ?>        
      </div>

      <hr>

      <div class="jumbotron">
        <h1><center>¡Has comprado una promoción!</center></h1><br/>
        <p class="lead">Puedes presentar este documento en el lugar en el que vas a disfrutar de la promoción.</p>
      </div>

      <hr>      
      <div class="row-fluid marketing destacado">
        <div class="span12">
          <p>CLAVE DE COMPRA: <?php echo $model->clave ?></p>
        </div>
      </div>
      <hr>
      <h2>Datos de la compra</h2>
      <div class="row-fluid marketing">
        <div class="span6">
          <h4>Identificador</h4>
          <p><?php echo CHtml::encode($model->id); ?></p>
        </div>
        <div class="span6">
          <h4>Fecha de compra</h4>
          <p><?php echo CHtml::encode($model->fecha_compra); ?></p>
        </div>
      </div>
      <div class="row-fluid marketing">
        <div class="span6">
          <h4>Precio</h4>
          <p><?php echo CHtml::encode($model->precio); ?> €</p>
        </div>
        <div class="span6">
          <h4>Estado</h4>
          <p><?php if($model->estado == 0): ?> 
                  <span class="label label-warning">No ha sido pagada</span>
                <?php else: ?>
                  <span class="label label-success">Pagado</label>
                <?php endif; ?>
          </p>
        </div>
      </div>

      <hr>
      <h2>Datos del comprador</h2>
      <div class="row-fluid marketing">
        <div class="span6">
          <h4>Nombre</h4>
          <p><?php echo CHtml::encode($comprador->profile->username); echo " ".CHtml::encode($comprador->profile->lastname);?></p>
        </div> 
        <div class="span6">
          <h4>Teléfono</h4>
          <p><?php echo CHtml::encode($comprador->profile->telefono); ?></p>
        </div> 
      </div>
      <div class="row-fluid marketing">
        <div class="span6">
          <h4>Dirección</h4>
          <p><?php echo "Población: ".CHtml::encode($comprador->profile->poblacion_id); echo "<br/>Dirección: ".CHtml::encode($comprador->profile->direccion); echo "<br/>C.P: ".CHtml::encode($comprador->profile->cp); ?></p>
        </div> 
      </div>

      <hr>
      <h2>Datos de la promoción</h2>
      <div class="row-fluid marketing">
        <div class="span6">
          <h4>Promoción</h4>
          <p><?php echo CHtml::encode($promo->titulo); echo " ".CHtml::encode($comprador->profile->lastname);?></p>
        </div> 
        <div class="span6">
          <h4>Precio</h4>
          <p><?php echo CHtml::encode($promo->precio); ?> €</p>
        </div> 
      </div>
      <div class="row-fluid marketing">
        <div class="span6">
          <h4>Condiciones</h4>
          <p><?php 
            if(isset($promo->condiciones)): ?>
              <?php echo CHtml::encode($promo->condiciones); ?>
            <?php else: ?>
              Sin determinar
            <?php endif; ?>

           </p>
        </div> 
      </div>

      <div class="footer">
        <p>&copy; Proemoción</p>
      </div>

    </div> <!-- /container -->