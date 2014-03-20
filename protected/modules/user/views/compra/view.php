<?php
/* @var $this CompraController */
/* @var $model Compra */
?>

<?php 
  Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/bootstrap.css');
?>

<h1>Referencia: <?php echo $model->referencia; ?></h1>

  <div class="container-narrow-pdf">    
      <div class="row-fluid marketing destacado">
        <div class="span12">
          <p>CLAVE DE COMPRA: <strong><?php echo $model->referencia ?></strong></p>
          <p>Fecha de compra: <?php echo CHtml::encode($model->fecha_compra); ?></p>
        </div>
      </div>
    
      <h4>Datos del comprador</h4>
      <?php $comprador = User::model()->find('user.id=:id',array(':id' => $model->id_usuario)); ?>
      <div class="row-fluid marketing">
        <div class="span12">
          <table class="table table-condensed">
            <tr class="success">
              <td><h6>Nombre</h6></td>
              <td><h6>Teléfono</h6></td>
              <td><h6>Dirección</h6></td>
            </tr>
            <tr>
              <td><?php echo CHtml::encode($comprador->profile->username); echo " ".CHtml::encode($comprador->profile->lastname);?></td>
              <td><?php echo CHtml::encode($comprador->profile->telefono); ?></td>
              <td><?php echo "Población: ".CHtml::encode($comprador->profile->poblacion_id); echo "<br/>Dirección: ".CHtml::encode($comprador->profile->direccion); echo "<br/>C.P: ".CHtml::encode($comprador->profile->cp); ?></td>
            </tr>
          </table>
        </div>
      </div>

      <h4>Datos de la promoción</h4>
      <?php $promo = Promocion::model()->find('id=:id',array(':id' => $model->id_promo)); ?>
      <div class="row-fluid marketing">
        <div class="span12">
           <table class="table table-condensed">
            <tr class="success">              
              <td><h6>Promoción</h6></td>
              <td><h6>Precio</h6></td>
              <td><h6>Condiciones</h6></td>              
            </tr>
            <tr>
              <td><?php echo CHtml::encode($promo->titulo) ?></td>
              <td><?php echo CHtml::encode($promo->precio); ?> €</td>    
              <td><?php if(isset($promo->condiciones)): ?>
                    <?php echo CHtml::encode($promo->condiciones); ?>
                  <?php else: ?>
                    Sin determinar
                  <?php endif; ?></td>           
            </tr>
          </table>
        </div> 
      </div>

      <h4>Datos de la empresa</h4>
      <div class="row-fluid marketing">
        <div class="span12">
           <table class="table table-condensed">
            <tr class="success">   
              <td><h6>cif</h6></td>           
              <td><h6>Nombre</h6></td>
              <td><h6>Dirección</h6></td>
              <td><h6>Teléfono</h6></td>  
              <td><h6>Web</h6></td>            
            </tr>
            <tr>
              <td><?php echo CHtml::encode($comprador->empresa->cif);?></td>
              <td><?php echo CHtml::encode($comprador->empresa->nombre);?></td>
              <td><?php echo "Población: ".CHtml::encode($comprador->profile->poblacion_id); echo "<br/>Dirección: ".CHtml::encode($comprador->profile->direccion); echo "<br/>C.P: ".CHtml::encode($comprador->profile->cp); ?></td>    
              <td><?php echo CHtml::encode($comprador->profile->telefono); ?></td>  
              <td><?php echo CHtml::encode($comprador->empresa->web); ?></td>           
            </tr>
          </table>
        </div> 
      </div>

      <div class="footer">
        <p>&copy; Proemoción</p>
      </div>

    </div> <!-- /container -->

<?php /*$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_usuario',
		'id_promo',
		'fecha_compra',
		'estado',
		'votado',
	),
)); */
	

?>

