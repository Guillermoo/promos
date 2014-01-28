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
        <h1><center>¡Has comprado una promoción!</center></h1>
        <p class="lead">Puedes presentar este documento en el lugar en el que vas a disfrutar de la promoción.</p>
      </div>

      <hr>
      <?php $this->debug($model) ?>
      <div class="row-fluid marketing">
        <div class="span6">
          <h4>Referencia</h4>
          <p><?php echo CHtml::encode($model->id); ?></p>
        </div>
        <div class="span6">
          <h4>Fecha de compra</h4>
          <p><?php echo CHtml::encode($model->fecha_compra); ?></p>
        </div>
        <div class="span6">
          <h4>Precio</h4>
          <p><?php echo CHtml::encode($model->precio); ?></p>
        </div>
      </div>

      <hr>

      <div class="footer">
        <p>&copy; Proemoción</p>
      </div>

    </div> <!-- /container -->