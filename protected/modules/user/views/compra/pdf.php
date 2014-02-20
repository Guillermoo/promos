<?php
/* @var $this CompraController */
/* @var $model Compra */
?>
<?php 
  Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/bootstrap.css');
?>

    <div class="container-narrow-pdf">

      <div class="well">
        <h3><center>¡Enhorabuena!</center></h3><br/>
        <p >Puedes presentar este documento en el lugar en el que vas a disfrutar de la promoción.</p>
      </div>
      
      <div class="row-fluid marketing destacado">
        <div class="span12">
          <p>CLAVE DE COMPRA: <strong><?php echo $model->referencia ?></strong></p>
          <p>Fecha de compra: <?php echo CHtml::encode($model->fecha_compra); ?></p>
        </div>
      </div>
    
      <h4>Datos del comprador</h4>
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
              <td><?php echo CHtml::encode($empresa->empresa->cif);?></td>
              <td><?php echo CHtml::encode($empresa->empresa->nombre);?></td>
              <td><?php echo "Población: ".CHtml::encode($empresa->profile->poblacion_id); echo "<br/>Dirección: ".CHtml::encode($empresa->profile->direccion); echo "<br/>C.P: ".CHtml::encode($empresa->profile->cp); ?></td>    
              <td><?php echo CHtml::encode($empresa->profile->telefono); ?></td>  
              <td><?php echo CHtml::encode($empresa->empresa->web); ?></td>           
            </tr>
          </table>
        </div> 
      </div>

      <div class="footer">
        <p>&copy; Proemoción</p>
      </div>

    </div> <!-- /container -->