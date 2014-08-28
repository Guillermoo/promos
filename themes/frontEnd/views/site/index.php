<div class="row-fluid print-show">
	<div class="span12">
		Proemoción - Tu web de promociones
	</div>
</div>			

<br/>	

	<div class="row-fluid">
		<div class="span12">
			<div class="slider-wrapper theme-bar">
				<div class="ribbon"></div>
				<div id="slider1" class="nivoslider">
					<img src="<?php echo Yii::app()->request->baseUrl.'/themes//frontEnd'; ?>/img/header_01.jpg" alt="ProEmocion">
					<img src="<?php echo Yii::app()->request->baseUrl.'/themes//frontEnd'; ?>/img/header_04.jpg" alt="Zaragoza" >			
					<img src="<?php echo Yii::app()->request->baseUrl.'/themes//frontEnd'; ?>/img/header_02.jpg" alt="Tu web de promociones" >
				</div>
			</div>
		</div>
	</div>
	
	<br>
	<div class="row-fluid">
		<div class="span12">

			<div class="row-fluid">
				<div class="span12">
					<h2>Destacados</h2>					
				</div>						
			</div>	
		<div class="row-fluid">
			<div class="span12">
				<ul class="thumbnails product-list-inline-small">
					<?php 
					$cont = 0;
					foreach ($destacados as $key => $promo):	
					$cont++;										
					$image = Item::model()->find('foreign_id='.$promo->id.' AND model = "promo"'); 
					if (!isset($image) || $image->path==null): 							
						$path=Yii::app()->params['no_image'];						
					endif; ?>
					<li class="span3">
						<div class="thumbnail destacado">
							<?php if (!isset($path)): ?>
								<?php //$this->debug(Yii::app()->request->baseUrl.$promo->item->path) ?>
								<center><img class="thumbnailimgdest" data-hover="<?php echo Yii::app()->getBaseUrl().$image->path ?>" src="<?php echo Yii::app()->getBaseUrl().$image->path ?>" alt="<?php echo $promo->titulo ?>"></center>
							<?php else: ?>
								<center><a href="promocion/<?=$promo->titulo_slug ?>"><img class="thumbnailimgdest" src="<?php echo Yii::app()->request->baseUrl.Yii::app()->params['no_image'] ?>" alt=""></a></center>
							<?php endif; ?>
						
							<div class="caption">
								<a href="promocion/<?=$promo->titulo_slug ?>"><?=$promo->titulo ?></a>
								<p><?=$promo->resumen ?> <span class="label label-info price pull-right">&euro; <?=$promo->precio ?></span></p>
							</div>
						</div>
					</li>
					<?php endforeach;?>
				</ul>
				<?php if($cont==0): ?>
					<div class="alert alert-info">No hay ninguna promoción destacada en estos momentos<div>
				<?php endif; ?>
			</div>
		</div>
		<hr />
		</div>
<?php //$this->debug($promos) ?>
	<div class="row-fluid">
		<div class="span12">
			<ul class="thumbnails product-list-inline-large">
				<?php foreach ($promos as $key => $promo):	
				//$image = Item::model()->find('foreign_id='.$promo->id.' AND model = "promo"');
						if (!isset($promo->item)): 							
							$path=Yii::app()->params['no_image'];						
						endif; ?>
					<li class="span3">
						<div class="thumbnail light">
							<a href="promocion/<?=$promo->titulo_slug ?>">
								<span class="label label-info price">&euro; <?php echo $promo->precio ?></span>
								<!--<span class="label label-important price price-over">&euro; 1,<sup>99</sup></span>-->
								<?php if (isset($promo->item) && strcmp($model->item->model,'promo') == 0 ): ?>
									<center><img class="thumbnailimg" data-hover="<?php echo Yii::app()->getBaseUrl().$promo->item->path ?>" src="<?php echo Yii::app()->getBaseUrl().$promo->item->path ?>" alt="<?php echo $promo->titulo ?>" class="divpromo" /></center>
								<?php else: ?>
									<center><img class="thumbnailimg" data-hover="<?php echo Yii::app()->request->baseUrl.Yii::app()->params['no_image'] ?>"  alt="<?php echo $promo->titulo ?>" src="<?php echo Yii::app()->request->baseUrl.Yii::app()->params['no_image'] ?>" class="divpromo"></center>
								<?php endif; ?>
							</a>
							<div class="caption">
								<a href="promocion/<?=$promo->titulo_slug ?>"><?php echo $promo->titulo ?></a>
							</div>
							<a href="promocion/<?=$promo->titulo_slug ?>" class="btn btn-block">Ver promoción</a>
						</div>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</div>

</div>
</div>