<?php if(YII_RUTAS == true) echo __FILE__; ?>
<br>
<h2>Esta es la página de bievenida para los usuarios-empresa al logearsee</h2>z
<?php
	//probando la cuenta trial
	echo CHtml::link('Prueba la cuenta trial!',array('user/puedeTrial'));
?>

<?php //(G)Si el usuario no ha rellenado los campos mínimos para poder vender, le apareceŕa?>
<?php //Hay que mirar que si es ?>
<?php if ($model->status == 1):?>
	<?php echo "LE FALTAN CAMPOS!!!"?>
	<div id="btn_oculto" >
	Ocultar por css el botón!!!
	<?php //$this->renderPartial('_contacto', array('model'=>$model));?>
	<?php $this->widget('bootstrap.widgets.TbButton', array(
	    'label'=>'Click me',
	    'type'=>'primary',
	    'htmlOptions'=>array(
			'id'=>'btn_show',
	        'data-toggle'=>'modal',
	        'data-target'=>'#myModal',
	    ),
	)); ?>
	</div>
<?php elseif($model->status == 2) :?>
	<?php //$this->debug($model->profile->attributes);?>
	<?php if($model->profile->tipocuenta != 3):?>
		<?php echo "Tiene que pagar!!";?>
	<?php endif;?>
	<!-- Lo que tenga que salir de normal -->
<?php endif;?>

<?php $this->beginWidget('bootstrap.widgets.TbModal', 
	array(
		'id'=>'myModal',
		'htmlOptions'=>array(
			'style'=>'width:600px',	
		),
	)); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Modal header</h4>
</div>
 
<div class="modal-body">
    <?php $this->renderPartial('../layouts/contacto', array('model'=>$model));?>
</div>
 
<div class="modal-footer">
    <?php /*$this->widget('bootstrap.widgets.TbButton', array(
        'type'=>'primary',
        'label'=>'Save changes',
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    ));*/ ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Close',
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
</div>
 
<?php $this->endWidget(); ?>

<script>

//$(document).ready(function() {
//	   $('#btn_show').trigger("click");
//	});
	
</script>