<?php if(YII_RUTAS == true) echo __FILE__; ?>
<h2>Bonos disponibles</h2>
<?php //(G)Si el usuario no ha rellenado los campos mínimos para poder vender, le apareceŕa?>
<?php //Hay que mirar que si es ?>
<?php if ($model->status == 1):?>
<div class="alert alert-info">
  <strong>Atención!</strong> No ha comprado ningún Bono. No podrá publicar sus promociones hasta que no tenga uno.
</div>

<?php elseif($model->status == 2) :?>
	<?php echo "Ud. ha elegido un tipo de cuenta de pago. "; ?>

	<?php if($model->profile->tipocuenta != 3):?>
		<?php echo "Todavía no se ha realizado el pago";?>
	<?php endif;?>
	
<?php endif;?>
<div class="clearfix">&nbsp;</div>

<div class="row-fluid pricing-table pricing-three-column">
  <?php $this->widget('zii.widgets.CListView', array(
  'dataProvider'=>$dataProvider,
  'itemView'=>'_view',
)); ?>
</div>

<script>

//$(document).ready(function() {
//	   $('#btn_show').trigger("click");
//	});
	
</script>