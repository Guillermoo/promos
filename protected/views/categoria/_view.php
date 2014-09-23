<?php
/* @var $this CategoriaController */
/* @var $data Categoria */
?>

<li class="span3 cajacategoria">
	<div class="thumbnail">

	<b>
	<?php echo CHtml::link(CHtml::encode($data->nombre),array('verpromos','id'=>$data->id)); ?></b>
	<br />
	<?php echo CHtml::encode($data->descripcion); ?>
	<br />
	</div>
</li>