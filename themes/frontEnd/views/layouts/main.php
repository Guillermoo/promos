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
	<?php if(!empty(Yii::app()->params['debugContent'])):?>
	                <?php echo Yii::app()->params['debugContent'];?>
	  <?php endif;?>
		<!-- Facebook div for like button -->
		<div id="fb-root"></div>

		<!-- Div for shade line -->
		<div class="header-shadow"></div>

		<!-- Use class "container-fluid" on the following div for making complete website fluid -->
		<div class="container">
			<?php echo $content; ?>
			
			
	</div>

		<div class="footer">
				<p align="center"> ProEmoción - Tu web de promociones   |    contacto: 976 XXX XXX </p>
		</div>
	</body>

</html>
