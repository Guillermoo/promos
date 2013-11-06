<div class="row-fluid print-show">
	<div class="span12">
		Proemoción - Tu web de promociones
	</div>
</div>

<div class="row-fluid print-hide">
	<div class="span4">
		<div class="header-action">

		</div>
	</div>
	<div class="span8">
		<div class="navbar pull-right header-nav" id="superior">
			<ul class="nav">
				<li class="dropdown">
					<?php echo CHtml::link('Login','user/login');?>								
					<?php //echo CHtml::link('Login',Yii::app()->getModule('user')->loginUrl);?>								
					<ul class="dropdown-menu">
						<li>
							<div class="dropdown-content">
								<br>
								<form>
									<input type="text" class="input-medium" placeholder="Username"><br>
									<input type="password" class="input-medium" placeholder="Password"><br>
									<button class="btn">reset</button>
									<button class="btn btn-primary">login</button>
								</form> 
								<br>
							</div>
						</li>
					</ul>
				</li>
				<li>
					<?php echo CHtml::link('Nueva Empresa','user/registrationcompany');?>	
				</li>
				<li>
					<?php echo CHtml::link('Nuevo Comprador','user/registrarcomprador');?>	
				</li>
			</ul>
		</div>
	</div>
</div>

	<div class="row-fluid print-hide">
		<!--<div class="span3 logo">
			<img src="<?php //echo Yii::app()->request->baseUrl.'/themes/frontEnd'; ?>/img/logo.png" alt="Logo">
		</div>-->
		<!--<div class="span4">
			<div class="row-fluid print-hide">
				<div class="span12">
					<div class="navbar header-search-nav">
						<ul class="nav">
							<li><a href="#">Gift certificates</a></li>
							<li class="active"><a href="#">Monthly preview</a></li>
							<li><a href="#">More</a></li>
						</ul>
					</div>
				</div>
			</div>					
		</div> -->				

		<div class="span12 cabecera">
			<div class="span10">
			<center><img src="<?php echo Yii::app()->request->baseUrl.'/themes/frontEnd'; ?>/img/banner_02.png" alt="No shipping"></center>
			</div>
			<div class="span2">
					<div class="social-icons pull-right">
						<a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/icon-facebook.png" alt="facebook"></a>
						<a href="#"><img src="<?php echo Yii::app()->theme->baseUrl;?>/img/icon-twitter.png" alt="twitter"></a>
						<a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/icon-linkedin.png" alt="linkedin"></a>
						<a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/icon-rss.png" alt="rss"></a>
					</div>
				</div>
		</div>
	</div>
	<br/>
	<div class="row-fluid print-hide">
		<div class="span12">
			<div class="navbar main-nav">
				<div class="navbar-inner">
					<div class="container">
						<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">menu</a>
						<div class="nav-collapse">
							<ul class="nav">
								<li class="active"><a href="index.html"><i class="icon-home"></i></a></li>
								<li class="divider-vertical"></li>
								<li><a href="category.html">Categorías</a></li>
								<li><a href="products.html">Empresas</a></li>										
							</ul>										
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>			

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
	<br/>
	<div class="row-fluid print-hide">
		<div class="span12">
			<form class="form-search header-search">
				<div class="input-append">
					<input class="input-large search-query" type="text"placeholder="Buscar productos...">
					<button class="btn" type="submit">buscar</button>
				</div>
			</form>
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
				
			</ul>
		</div>
	</div>

	

	

	<div class="row-fluid">
		<div class="span12 well well-small">
				&copy; <script>document.write(new Date().getFullYear());</script> - All taxes are excluded - shipping costs depends on location - <a href="#">more info <i class="icon-chevron-right"></i></a>
		</div>
	</div>

</div>