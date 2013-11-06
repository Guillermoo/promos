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
					<a href="#"><img src="<?php echo Yii::app()->request->baseUrl.'/themes//frontEnd'; ?>/img/header_01.jpg" alt="ProEmocion"></a>
					<a href="#"><img src="<?php echo Yii::app()->request->baseUrl.'/themes//frontEnd'; ?>/img/header_02.jpg" alt="" title="Aprovéchate de las últimas ofertas"></a>
					<img src="<?php echo Yii::app()->request->baseUrl.'/themes//frontEnd'; ?>/img/header_03.jpg" alt="" title="">
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
					<?php foreach ($destacados as $key => $promo):	?>
								
								<li class="span3">
									<div class="thumbnail">
									<?php if (isset($promo->item)): ?>
										<?php //$this->debug(Yii::app()->request->baseUrl.$promo->item->path) ?>
										<a href="promo/<?=$promo->id ?>"><img src="<?php echo Yii::app()->request->baseUrl.$promo->item->path ?>" alt=""></a>
									<?php else: ?>
										<a href="promo/<?=$promo->id ?>"><img src="<?php echo Yii::app()->request->baseUrl.Yii::app()->params['no_image'] ?>" alt=""></a>
									<?php endif; ?>
									
									<div class="caption">
										<a href="promo/<?=$promo->id ?>"><?=$promo->titulo ?></a>
										<p><?=$promo->resumen ?> <span class="label label-info price pull-right">&euro; <?=$promo->precio ?>,-</span></p>
									</div>
								</div>
							</li>
					<?php endforeach;?>
				</ul>
			</div>
		</div>
		<hr />
		</div>
<?php //$this->debug($promos) ?>
	<div class="row-fluid">
		<div class="span12">
			<ul class="thumbnails product-list-inline-large">
				<?php foreach ($promos as $key => $promo):	?>
					<li class="span3">
						<div class="thumbnail light">
							<a href="promo/<?=$promo->id ?>">
								<span class="label label-info price">&euro; <? echo $promo->precio ?>,-</span>
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
							<a href="#" class="btn btn-block">all products in category</a>
						</div>
					</li>
				<?php endforeach; ?>
				<!--<li class="span3">
					<div class="thumbnail light">
						<a href="#">
							<span class="label label-info price">&euro; 2,<sup>99</sup></span>
							<span class="label label-important price price-over">&euro; 1,<sup>99</sup></span>
							<img data-hover="<?php echo Yii::app()->request->baseUrl.'/themes/frontEnd'; ?>/img/product_04b.jpg" src="img/product_04.jpg" alt="">
						</a>
						<div class="caption">
							<a href="#">Product A</a>
						</div>
						<a href="#" class="btn btn-block">all products in category</a>
					</div>
				</li>
				<li class="span3">
					<div class="thumbnail dark">
						<a href="#">
							<div class="label label-info price">&euro; 93,<sup>99</sup></div>
							<img data-hover="<?php echo Yii::app()->request->baseUrl.'/themes/frontEnd'; ?>/img/product_05b.jpg" src="img/product_05.jpg" alt="">
						</a>
						<div class="caption">
							<a href="#">Product B</a>
						</div>
						<a href="#" class="btn btn-block">all products in category</a>
					</div>
				</li>
				<li class="span3">
					<div class="thumbnail light">
						<a href="#">
							<div class="label label-info price">&euro; 1023,<sup>99</sup></div>
							<img data-hover="<?php echo Yii::app()->request->baseUrl.'/themes/frontEnd'; ?>/img/product_06b.jpg" src="img/product_06.jpg" alt="">
						</a>
						<div class="caption">
							<a href="#">Product C</a>
						</div>
						<a href="#" class="btn btn-block">all products in category</a>
					</div>
				</li>
				<li class="span3">
					<div class="thumbnail dark">
						<a href="#">
							<div class="label label-info price">&euro; 123,<sup>99</sup></div>
							<span class="label label-important price price-over">&euro; 122,<sup>99</sup></span>
							<img data-hover="<?php echo Yii::app()->request->baseUrl.'/themes/frontEnd'; ?>/img/product_07b.jpg" src="img/product_07.jpg" alt="">
						</a>
						<div class="caption">
							<a href="#">Product D</a>
						</div>
						<a href="#" class="btn btn-block">Todos los productos de la categoría</a>
					</div>
				</li>-->
			</ul>
		</div>
	</div>

	<!--<div class="row-fluid">
		<div class="span12">
			<ul class="thumbnails product-list-inline-large">
				<li class="span3">
					<div class="thumbnail dark">
						<a href="#">
							<span class="label label-info price">&euro; 2,<sup>99</sup></span>
							<img data-hover="<?php echo Yii::app()->request->baseUrl.'/themes/frontEnd'; ?>/img/product_08b.jpg" src="img/product_08.jpg" alt="">
						</a>
						<div class="caption">
							<a href="#">Product A</a>
						</div>
						<a href="#" class="btn btn-block">all products in category</a>
					</div>
				</li>
				<li class="span3">
					<div class="thumbnail light">
						<a href="#">
							<div class="label label-info price">&euro; 93,<sup>99</sup></div>
							<img data-hover="<?php echo Yii::app()->request->baseUrl.'/themes/frontEnd'; ?>/img/product_09b.jpg" src="img/product_09.jpg" alt="">
						</a>
						<div class="caption">
							<a href="#">Product B</a>
						</div>
						<a href="#" class="btn btn-block">all products in category</a>
					</div>
				</li>
				<li class="span3">
					<div class="thumbnail dark">
						<a href="#">
							<div class="label label-info price">&euro; 1023,<sup>99</sup></div>
							<span class="label label-important price price-over">&euro; 999,<sup>99</sup></span>
							<img data-hover="<?php echo Yii::app()->request->baseUrl.'/themes/frontEnd'; ?>/img/product_10b.jpg" src="img/product_10.jpg" alt="">
						</a>
						<div class="caption">
							<a href="#">Product C</a>
						</div>
						<a href="#" class="btn btn-block">all products in category</a>
					</div>
				</li>
				<li class="span3">
					<div class="thumbnail light">
						<a href="#">
							<div class="label label-info price">&euro; 123,<sup>99</sup></div>
							<img data-hover="<?php echo Yii::app()->request->baseUrl.'/themes/frontEnd'; ?>/img/product_11b.jpg" src="img/product_11.jpg" alt="">
						</a>
						<div class="caption">
							<a href="#">Product D</a>
						</div>
						<a href="#" class="btn btn-block">all products in category</a>
					</div>
				</li>
			</ul>
		</div>
	</div>-->

</div>