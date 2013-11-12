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
		<h2> <?php echo $model->nombre; ?></h2>
		<div class="thumbnail"> 
			<img src=" 
			<?php echo Yii::app()->baseUrl.$model->usuario->item->path; ?>"/>
		</div>
		<span class="label label-info">Web:</span>
		<div class="well clearfix"> <?php echo "<a href='".$model->web."' target='_blank'>".$model->web."</a>" ?>
		</div>		

		<span class="label label-info">Facebook:</span>
		<div class="well well-small clearfix"> <?php echo CHtml::link(CHtml::encode($model->facebook), $model->web) ?>
		</div>

		<span class="label label-info">Twitter:</span>
		<div class="well well-small clearfix"> <?php echo CHtml::link(CHtml::encode($model->twitter), $model->web) ?>
		</div>
	</div>
</div>
	
<h3> Proemociones de <?php echo $model->nombre; ?>:</h3>
<?php /*$this->widget('zii.widgets.CDetailView', array(
	'data'=>$promos,
	'attributes'=>array(
		'titulo',
		'resumen',
	),
)); 
/* CAMBIAR EL MÉTODO DE MOSTRAR LAS PROMOS, A VER SI NO ME LAS MUESTRA POR ESTO. MOSTRARLAS CON UN FOR */
?>
<div class="row-fluid">
		<div class="span12">
			<ul class="thumbnails product-list-inline-large">
<?php
if(empty($model->usuario->promocion)){
?>
	<div class="alert alert-info">Esta empresa no tiene ninguna promoción activada</div>
<?php
}else{
	foreach ($model->usuario->promocion as $key => $promo) {
?>
	<li class="span3">
		<div class="thumbnail light">
								<span class="label label-info price">&euro; <? echo $promo->precio ?>,-</span>
								<div class="caption titulopromo"><h4><?php echo $promo->titulo ?></h4></div>
								<div class="descripcionpromo"><?php echo $promo->resumen ?></div>
								<!--<span class="label label-important price price-over">&euro; 1,<sup>99</sup></span>-->
								<?php if (isset($promo->item)): ?>
									<img data-hover="<?php echo Yii::app()->request->baseUrl.$promo->item->path ?>" src="$promo->item->path" alt="">
								<?php else: ?>
									<img data-hover="<?php echo Yii::app()->request->baseUrl.Yii::app()->params['no_image'] ?>"  alt="">
								<?php endif; ?>
							</a>
							<div class="caption">
								<a href="promo/<?=$promo->id ?>"><?php $promo->titulo ?></a>
							</div>
			</div>
		</li>
<?php
	}
}
?>
</ul>
</div>
</div>