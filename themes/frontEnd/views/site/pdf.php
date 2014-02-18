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
          <p>xxxx</p>
        </div>
        <div class="span6">
          <h4>Fecha de compra</h4>
          <p>xxxxx</p>
        </div>
      </div>
      <div class="row-fluid marketing">
        <div class="span6">
          <h4>Precio</h4>
          <p>xx €</p>
        </div>
       
      </div>

      <hr>
      <h2>Datos del comprador</h2>
      <div class="row-fluid marketing">
        <div class="span6">
          <h4>Nombre</h4>
          <p>xxxxx</p>
        </div> 
        <div class="span6">
          <h4>Teléfono</h4>
          <p>xxxxx</p>
        </div> 
      </div>
      <div class="row-fluid marketing">
        <div class="span6">
          <h4>Dirección</h4>
          <p>xxxxxxx</p>
        </div> 
      </div>

      <hr>
      <h2>Datos de la promoción</h2>
      <div class="row-fluid marketing">
        <div class="span6">
          <h4>Promoción</h4>
          <p>xxxxx</p>
        </div> 
        <div class="span6">
          <h4>Precio</h4>
          <p>xxx €</p>
        </div> 
      </div>
      <div class="row-fluid marketing">
        <div class="span6">
          <h4>Condiciones</h4>
          <p>xxxxx

           </p>
        </div> 
      </div>

      <div class="footer">
        <p>&copy; Proemoción</p>
      </div>

    </div> <!-- /container -->