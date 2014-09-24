<!doctype html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="es"><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" lang="es"><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9" lang="es"><![endif]-->
<!--[if IE]><html class="no-js ie" lang="es"><![endif]-->
<!--[if !IE]><!--><html class="no-js" lang="es"><!--<![endif]-->

	<head>

		<meta charset="utf-8">
		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
		<link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl.'/themes/frontEnd'; ?>/img/favicon.ico">
		<meta name="description" content="Promociones Ofertas Zaragoza">
		<meta name="author" content="Hugo Langa y Guillermo Cano">
		<meta name="viewport" content="width=device-width">
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl.'/themes/frontEnd'; ?>/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu">
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=McLaren">
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl.'/themes/frontEnd'; ?>/css/style.css">
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl.'/themes/frontEnd'; ?>/css/nivo-slider.css">
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl.'/themes/frontEnd'; ?>/nivo-themes/bar/bar.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl.'/themes/frontEnd'; ?>/nivo-themes/light/light.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl.'/themes/frontEnd'; ?>/bootstrap/css/bootstrap-responsive.min.css">
		<!-- Personalizacion CierzoDevs -->
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl.'/themes/frontEnd'; ?>/css/cdestilos.css">
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
		<!-- --------------- -->
	</head>

	<body>	
		<?php //$this->debug(Yii::app()->getModule('user')); ?>
			<!-- Facebook div for like button -->
		<div id="fb-root"></div>

		<!-- Div for shade line -->
		<div class="header-shadow"></div>

		<!-- Use class "container-fluid" on the following div for making complete website fluid -->
	<?php if(!empty(Yii::app()->params['debugContent'])):?>
            <?php echo Yii::app()->params['debugContent'];?>
	  	<?php endif;?>	
		<div class="navbar pull-right header-nav" id="superior">
			<ul class="nav">
				<?php if(Yii::app()->user->isGuest): ?>
				<li>
					<?php echo CHtml::link('Acceder',Yii::app()->baseUrl.'/user/login');?>							
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
					<?php echo CHtml::link('Crear cuenta',Yii::app()->baseUrl.'/user/registrarcomprador');?>	
				</li>
		<?php else: ?>
			<li>
				<?php echo CHtml::link('Panel de control de '.Yii::app()->user->name,Yii::app()->baseUrl.'/user/profile');?>
			</li>
			<li>
				<?php echo cHtml::link('Cerrar sesión',Yii::app()->getModule('user')->logoutUrl);?>
			</li>
		<?php endif; ?>
			</ul>
		</div>
		
		<!-- Facebook div for like button -->
		<div id="fb-root"></div>

		<!-- Div for shade line -->
		<!--<div class="header-shadow"></div>--><!--He borrado esto poruqe no se veía el menú-->

		<!-- Use class "container-fluid" on the following div for making complete website fluid -->
		

			<div class="row-fluid print-hide">
				<div class="span4">
					<div class="header-action">

					</div>
				</div>
			</div>

			<div class="row-fluid print-hide">
				<div class="span7 logo">
					<img src="<?php echo Yii::app()->request->baseUrl.'/themes/frontEnd'; ?>/img/logo.png" alt="Logo">
				</div>					
				<br>
				<div class="span5">
					<img src="<?php echo Yii::app()->request->baseUrl.'/themes/frontEnd'; ?>/img/banner_top.jpg" alt="No shipping">
				</div>
			</div>

			<div class="row-fluid print-hide">
				<div class="span12">
					<div class="navbar main-nav" id="menupral">
						<div class="navbar-inner">							
								<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">menú</a>
								<div class="nav-collapse">
									<ul class="nav">
										<?php 
										if(Yii::app()->controller->action->id == 'index'):
										?>
										<li class="active"><a href=<?=Yii::app()->homeUrl ?> ><i class="icon-home"></i></a></li>
									<?php else: ?>
										<li ><a href=<?=Yii::app()->homeUrl ?> ><i class="icon-home"></i></a></li>
									<?php endif; ?>
										<li class="divider-vertical"></li>
										<!--<li><?php //echo Chtml::link('Promociones',array('/promociones'))?></li>-->
										<li><?php 
										if(Yii::app()->controller->id == 'categoria'):
											echo Chtml::link('Categorías',array('/categorias'),array('class'=>'active')); 
										else: 
											echo Chtml::link('Categorías',array('/categorias')); 
										endif;
										?></li>
										<li><?php 
										if(Yii::app()->controller->id == 'empresa'):
											echo Chtml::link('Empresas',array('/empresas'),array('class' => 'active'));
										else:
											echo Chtml::link('Empresas',array('/empresas'));
										endif;
										?></li>			

										<li><?php
											if(Yii::app()->controller->action->id == 'about'):
												echo CHtml::link('Qué es ProEmoción',array('site/about'),array('class'=>'active')); 
											else:
												echo CHtml::link('Qué es ProEmoción',array('site/about')); 
											endif;
										?></li>								
									</ul>										
								</div>							
						</div>
					</div>
				</div>
			</div>			
		<div class="container-fluid">
			<?php echo $content; ?>			
		</div>
	
	<div class="footer">
			<p align="center"> ProEmoción - Tu web de promociones  |   contacto: 652 389 176  |  proemocion(arroba)proemocion.com | Zaragoza | España</p>
			<div class="clearfix">&nbsp;</div>
			<p align="center">¿Quieres publicar tus promociones en ProEmoción? Llámanos y te informaremos sin compromiso</p>				
	</div>
	<script src="<?php echo Yii::app()->request->baseUrl.'/themes/frontEnd'; ?>/js/config.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl.'/themes/frontEnd'; ?>/js/modernizr-2.6.2.min.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl.'/themes/frontEnd'; ?>/js/jquery-1.8.1.min.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl.'/themes/frontEnd'; ?>/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl.'/themes/frontEnd'; ?>/js/jquery.nivo.slider.pack.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl.'/themes/frontEnd'; ?>/js/respond.min.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl.'/themes/frontEnd'; ?>/js/script.js"></script>
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-55129249-1', 'auto');
	  ga('send', 'pageview');
	</script>
</body>
</html>
