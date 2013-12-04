<?php /*$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'nombre',
		'web',
		'twitter',
		'facebook',
		'urlTienda',
		'modificado',
	),
)); */
//Yii::app()->theme = "Frontend";
?>
<div class="row-fluid">
	<div class="span12">
		<center><?php $this->widget('bootstrap.widgets.TbButton', array(
    		'label'=>'Listado categorías',
    		'type'=>'', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    		'size'=>'large', // null, 'large', 'small' or 'mini'
    		'icon'=>' icon-arrow-left',
    		'url'=>array('/categorias')
			)); 
		?></center>
	</div>
</div>
<div class="row-fluid">
	<div class="span10"><h2><?php echo $model->nombre; ?></h2></div>
</div>
	
<h3> Proemociones de la categoría <?php echo $model->nombre; ?>:</h3>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$promos,
	'attributes'=>array(
		'nombre',
		'resumen',
	),
)); 
?>
<div class="row-fluid">
	<div class="span12">
		<ul class="thumbnails product-list-inline-large">

		</ul>
	</div>
</div>