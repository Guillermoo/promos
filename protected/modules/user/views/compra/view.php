<?php
/* @var $this CompraController */
/* @var $model Compra */
?>

<h1>Identificador de compra: <?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_usuario',
		'id_promo',
		'fecha_compra',
		'estado',
		'votado'.
	),
)); 
	

?>

