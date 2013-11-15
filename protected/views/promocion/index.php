<div class="row-fluid">
	<div class="span3">
		<br>
		<div class="row-fluid">
			<div class="span12 well well-small">
				<ul class="nav nav-list">
					<li class="nav-header">Brands</li>
					<li><a href="#"><i class="icon-ok"></i> Brand A</a></li>
					<li><a href="#"><i class="icon-ok icon-white"></i> Brand B</a></li>
					<li><a href="#"><i class="icon-ok"></i> Brand C</a></li>
					<li class="divider"></li>
					<li class="nav-header">Price</li>
					<li><a href="#"><i class="icon-ok"></i> &euro; 10 - &euro; 50</a></li>
					<li><a href="#"><i class="icon-ok icon-white"></i> &euro; 50 - &euro; 100</a></li>
					<li><a href="#"><i class="icon-ok icon-white"></i> &euro; 100 - &euro; 250</a></li>
					<li class="divider"></li>
					<li class="nav-header">Color</li>
					<li><a href="#"><i class="icon-ok icon-white"></i> Orange</a></li>
					<li><a href="#"><i class="icon-ok icon-white"></i> Red</a></li>
					<li><a href="#"><i class="icon-ok"></i> Yellow</a></li>
				</ul>
			</div>
		</div>

		<div class="row-fluid">
			<div class="span12">
				<div class="slider-wrapper theme-light">
					<div class="ribbon"></div>
					<div id="slider2" class="nivoslider">
						<img src="img/banner_01.jpg" alt="" title="This is an example of an optional long caption text" />
						<img src="img/banner_02.jpg" alt="" title="" />
						<img src="img/banner_03.jpg" alt="" title="" />
						<img src="img/banner_04.jpg" alt="" title="Another caption" />
					</div>
				</div>
				<br>
			</div>
		</div>

	</div>
				
	<div class="span9">
		<div class="row-fluid">
			<div class="span9">
				<h2>Productos</h2>
			</div>
			<div class="span3">
				<div class="social-icons pull-right">
					<a href="#"><img src="<?php echo Yii::app()->theme->baseUrl?>/img/icon-facebook.png" alt="facebook"></a>
					<a href="#"><img src="<?php echo Yii::app()->theme->baseUrl?>/img/icon-twitter.png" alt="twitter"></a>
					<a href="#"><img src="<?php echo Yii::app()->theme->baseUrl?>/img/icon-linkedin.png" alt="linkedin"></a>
					<a href="#"><img src="<?php echo Yii::app()->theme->baseUrl?>/img/icon-rss.png" alt="rss"></a>
				</div>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span12">
				<ul class="thumbnails product-list-inline-small">
					<?php foreach ($model as $key => $promo):	?>
						<li class="span3">
								<div class="thumbnail">
								<?php if (isset($promo->item)): ?>
									<a href="promocion/<?=$promo->titulo_slug ?>"><img src="<?php echo Yii::app()->request->baseUrl.$promo->item->path ?>" alt=""></a>
								<?php else: ?>
									<a href="promocion/<?=$promo->titulo_slug ?>"><img src="<?php echo Yii::app()->request->baseUrl.Yii::app()->params['no_image'] ?>" alt=""></a>
								<?php endif; ?>
								
								<div class="caption">
									<a href="promocion/<?=$promo->titulo_slug ?>"><?=$promo->titulo ?></a>
									<p><?=$promo->resumen ?> <span class="label label-info price pull-right">&euro; <?=$promo->precio ?>,-</span></p>
								</div>
							</div>
						</li>
					<?php endforeach;?>
				</ul>
			</div>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span12">
			<div class="pagination pagination-right">
				<ul>
					<li class="disabled"><a href="#">&laquo;</a></li>
					<li class="active"><a href="#">1</a></li>
					<li><a href="#">2</a></li>
					<li><a href="#">3</a></li>
					<li><a href="#">4</a></li>
					<li><a href="#">5</a></li>
					<li><a href="#">&hellip;</a></li>
					<li><a href="#">93</a></li>
					<li><a href="#">&raquo;</a></li>
			 </ul>
			</div>
		</div>
	</div>

	<!--<div class="row-fluid">
		<div class="span12 well well-small">
				&copy; <script>document.write(new Date().getFullYear());</script> - All taxes are excluded - shipping costs depends on location - <a href="#">more info <i class="icon-chevron-right"></i></a>
		</div>
	</div>-->
</div>