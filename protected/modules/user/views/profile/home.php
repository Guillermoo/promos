<?php if(YII_RUTAS == true) echo __FILE__; ?>
<br>
<h2>Este es el panel de administración del usuario</h2>
<?php
	//probando la cuenta trial
	//echo CHtml::link('Prueba la cuenta trial!',array('puedeTrial'));
?>

<?php //(G)Si el usuario no ha rellenado los campos mínimos para poder vender, le apareceŕa?>
<?php //Hay que mirar que si es ?>
<?php if (UserModule::isCompany() && $model->status == 1):?>
			<div class="alert alert-info" align="center"><?php echo "¡Está usando la cuenta trial!"?></div>
	
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
<?php endif;?>

<?php 
	if(UserModule::isBuyer() && $model->profile==null){
		echo "<div class=\"alert alert-warning\" align=\"center\"><strong><a href=\"#\">¡Tiene que rellenar los datos de su perfil</a></strong><!/div> ";
		echo CHtml::link('Crear Perfil',array('profile/create'));
	}
?>

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
    <?php //$this->renderPartial('../layouts/contacto', array('model'=>$model));?>
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