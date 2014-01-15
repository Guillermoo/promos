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
								<a href="/promocion/<?=$promo->titulo_slug ?>">
									<span class="label label-info price">&euro; <? echo $promo->precio ?></span>									
									<?php if (isset($promo->item)): ?>
										<center><img data-hover="<?php echo Yii::app()->request->baseUrl.$promo->item->path ?>" src="<?php echo Yii::app()->getBaseUrl().$promo->item->path ?>" alt=""></center>
									<?php else: ?>
										<img data-hover="<?php echo Yii::app()->request->baseUrl.Yii::app()->params['no_image'] ?>"  alt="">
									<?php endif; ?>
								</a>
								<div class="caption">
									<a href="/promocion/<?=$promo->titulo_slug ?>"><?php echo $promo->titulo ?></a>
								</div>
							</div>			
							<a href="/promocion/<?=$promo->titulo_slug ?>" class="btn btn-block">Ver promoción</a>
						</li>
					<?php endforeach;
				else: ?>
				<div class="alert alert-info">No hay promociones en esta categoría</div> 	
				<?php endif; ?>

			</ul>
		</div>
</div>