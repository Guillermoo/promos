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
	<div class="span10"><h2><?php echo $model->nombre; ?></h2>
		<?php echo $model->descripcion; ?>
	</div>
</div>
	
<h3> Promociones de la categoría <?php echo $model->nombre; ?>:</h3>
<?php //$this->debug($model); ?>
<div class="row-fluid">
		<div class="span12">
			<ul class="thumbnails product-list-inline-large">

				<?php 
				$proemos=Promocion::model()->findAllByAttributes(array(
					'categorias_id'=>$model->id // $model= category model
				));

				if($proemos):
					foreach($proemos as $promo): ?>
 						<li class="span3">
		<div class="thumbnail light">
								<span class="label label-info price">&euro; <? echo $promo->precio ?>,-</span>
								<div class="caption titulopromo"><h4><?php echo CHtml::link($promo->titulo ,Yii::app()->request->baseUrl.'/promocion/'.$promo->titulo_slug) ?></h4></div>
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
					<?php endforeach;
				else: ?>
				<div class="alert alert-info">No hay promociones en esta categoría</div> 	
				<?php endif; ?>

			</ul>
		</div>
</div>