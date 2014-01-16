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
	if($model->votado == 0 && $model->estado == 1): ?>
		<div>Puede votar la promoción <?php echo CHtml::link('haciendo click aquí','promocion/votar/id/'.$model->id_promo); ?> </div>
	<?php else: ?>
		<div>Ha votado esta promocion. Su valoracion: <strong><?php echo $model->votado ?></strong></div>
	<?php endif; ?>

?>

