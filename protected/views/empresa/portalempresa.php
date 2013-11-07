<h1><?php echo $model->nombre; ?></h1>


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'nombre',
		'web',
		'twitter',
		'facebook',
		'urlTienda',
		'modificado',
	),
)); ?>
<h3> Promociones de <?php echo $model->nombre; ?>:</h3>
<?php /*$this->widget('zii.widgets.CDetailView', array(
	'data'=>$promosEmpresa,
	'attributes'=>array(
		'titulo',
		'resumen',
	),
)); */?>