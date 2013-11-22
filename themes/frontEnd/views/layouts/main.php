<!doctype html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="nl"><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" lang="nl"><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9" lang="nl"><![endif]-->
<!--[if IE]><html class="no-js ie" lang="nl"><![endif]-->
<!--[if !IE]><!--><html class="no-js" lang="nl"><!--<![endif]-->

	<head>

		<meta charset="utf-8">
		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
		<link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl.'/themes/frontEnd'; ?>/img/favicon.ico">
		<meta name="description" content="Promociones Zaragoza">
		<meta name="author" content="BigBase - D. Tiems">
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
		<!-- --------------- -->
		<script src="<?php echo Yii::app()->request->baseUrl.'/themes/frontEnd'; ?>/js/config.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl.'/themes/frontEnd'; ?>/js/modernizr-2.6.2.min.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl.'/themes/frontEnd'; ?>/js/jquery-1.8.1.min.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl.'/themes/frontEnd'; ?>/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl.'/themes/frontEnd'; ?>/js/jquery.nivo.slider.pack.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl.'/themes/frontEnd'; ?>/js/respond.min.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl.'/themes/frontEnd'; ?>/js/script.js"></script>

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
					<?php echo CHtml::link('Login',Yii::app()->baseUrl.'/user/login');?>							
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
					<?php echo CHtml::link('Nueva Empresa',Yii::app()->baseUrl.'/user/registrationcompany');?>	
				</li>
				<li>
					<?php echo CHtml::link('Nuevo Comprador',Yii::app()->baseUrl.'/user/registrarcomprador');?>	
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
		<div class="container">

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
					<div class="navbar main-nav">
						<div class="navbar-inner">
							<div class="container">
								<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">menu</a>
								<div class="nav-collapse">
									<ul class="nav">
										<li class="active"><a href=<?=Yii::app()->homeUrl ?> ><i class="icon-home"></i></a></li>
										<li class="divider-vertical"></li>
										<!--<li><?php //echo Chtml::link('Promociones',array('/promociones'))?></li>-->
										<li><?php echo Chtml::link('Categorias',array('categoria/index'))?></li>
										<li><?php echo Chtml::link('Empresas',array('/empresas'))?></li>										
									</ul>										
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>			
			<?php echo $content; ?>			
		</div>
	</body>
	<div class="footer">
			<p align="center"> ProEmoción - Tu web de promociones  |    contacto: 976 XXX XXX </p>
		</div>
</html>
