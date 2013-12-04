<?php
/* @var $this CategoriaController */
/* @var $data Categoria */
?>

<li class="span3">
	<div class="thumbnail">

	<b>
	<?php echo CHtml::link(CHtml::encode($data->nombre),array('view','id'=>$data->id)); ?></b>
	<br />
	<?php echo CHtml::encode($data->descripcion); ?>
	<br />
	</div>
</li>