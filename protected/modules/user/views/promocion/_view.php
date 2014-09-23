<?php
/* @var $this PromocionesController */
/* @var $data Promociones */
?>
<li class="span3">
	<div class="thumbnail">					
		<div class="caption">
			<a href="<?php echo Yii::app()->request->baseUrl ?>/promocion/<?=$data->titulo_slug ?>" target="_blank"><?=$data->titulo ?></a>
			<p><?=$data->resumen ?> <span class="label label-info price pull-right">&euro; <?=$data->precio ?>,-</span></p>
		</div>
	</div>
</li>