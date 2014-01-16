<?php
/* @var $this CompraController */
/* @var $dataProvider CActiveDataProvider */

/*$this->menu=array(
	array('label'=>'Create Compra', 'url'=>array('create')),
	array('label'=>'Manage Compra', 'url'=>array('admin')),
);*/
?>

<h1>Promociones compradas por el usuario</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 
$this->debug($dataProvider);
if($dataProvider->votado == 0 && $dataProvider->estado == 1): ?>
		<div>Puede votar la promoción <?php echo CHtml::link('haciendo click aquí','promocion/votar/id/'.$dataProvider->id_promo); ?> </div>
	<?php else: ?>
		<div>Ha votado esta promocion. Su valoracion: <strong><?php echo $dataProvider->votado ?></strong></div>
	<?php endif; ?>

