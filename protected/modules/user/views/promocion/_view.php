<?php
/* @var $this PromocionesController */
/* @var $data Promociones */
?>

<li class="span3">
								<div class="thumbnail">
								<?php if (isset($data->item)): ?>
									<a href="<?php echo Yii::app()->request->baseUrl ?>/promocion/<?=$data->titulo_slug ?>" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl.$data->item->path ?>" alt=""></a>
								<?php else: ?>
									<a href="<?php echo Yii::app()->request->baseUrl ?>/promocion/<?=$data->titulo_slug ?>" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl.Yii::app()->params['no_image'] ?>" alt=""></a>
								<?php endif; ?>
								
								<div class="caption">
									<a href="<?php echo Yii::app()->request->baseUrl ?>/promocion/<?=$data->titulo_slug ?>" target="_blank"><?=$data->titulo ?></a>
									<p><?=$data->resumen ?> <span class="label label-info price pull-right">&euro; <?=$data->precio ?>,-</span></p>
								</div>
							</div>
						</li>
	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion_html')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion_html); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_inicio')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_inicio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_fin')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_fin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fechaCreacion')); ?>:</b>
	<?php echo CHtml::encode($data->fechaCreacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('destacado')); ?>:</b>
	<?php echo CHtml::encode($data->destacado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('precio')); ?>:</b>
	<?php echo CHtml::encode($data->precio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rebaja')); ?>:</b>
	<?php echo CHtml::encode($data->rebaja); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('condiciones')); ?>:</b>
	<?php echo CHtml::encode($data->condiciones); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stock')); ?>:</b>
	<?php echo CHtml::encode($data->stock); ?>
	<br />

	*/ ?>