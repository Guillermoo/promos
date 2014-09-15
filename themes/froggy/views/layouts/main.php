<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
      <title><?php echo CHtml::encode($this->pageTitle); ?></title>
     <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

<?php
    $baseUrl = Yii::app()->theme->baseUrl; 
    $cs = Yii::app()->getClientScript();
    Yii::app()->clientScript->registerCoreScript('jquery');
  ?>
    <!-- LOAD CSS ASSETS -->
    <link rel="stylesheet" href="<?php echo $baseUrl;?>/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo $baseUrl;?>/css/dashboard.css">
    <link href="<?php echo $baseUrl;?>/css/bootstrap.css" rel="stylesheet">
     <link href="<?php echo $baseUrl;?>/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="<?php echo $baseUrl;?>/css/cdestilos.css" rel="stylesheet">

    <!--LOAD GOOGLE WEBFONTS -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600,700' rel='stylesheet' type='text/css'>
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
      <?php Yii::app()->bootstrap->register(); ?>
    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="<?php echo $baseUrl;?>/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $baseUrl;?>/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $baseUrl;?>/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $baseUrl;?>/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo $baseUrl;?>/ico/apple-touch-icon-57-precomposed.png">
  </head>

<body>
  <?php if(!Yii::app()->user->isGuest){ ?>
  <div class="logout medium twitter button radius"><em class="icon icon-off"> </em> <?php echo cHtml::link('Salir ('.Yii::app()->user->name.')',Yii::app()->getModule('user')->logoutUrl);?></div>
  <?php } ?>
      <!--START SUB-NAVBAR -->
<div class="subnav subnav-fixed">               
  <ul class="nav nav-pills">
  <?php 
    $this->widget('UserNav');
  ?> 
  </ul>
</div>

 <!--END NAVBAR -->

 <!--START MAIN-CONTENT -->

 <div class="container" style="margin-top:80px;">
<?php if(!empty(Yii::app()->params['debugContent'])):?>
                <?php echo Yii::app()->params['debugContent'];?>
  <?php endif;?>
<!-- Include content pages -->
<?php echo $content; ?>

</div>
    
<footer>
  <div class="footer_container">
   <div class="container">
      <p align="center"> ProEmoción - Tu web de promociones  |   contacto: 652 389 176  |  proemocion@proemocion.com | Zaragoza | España</p>
    </div>
  </div>
</footer>




  <!--LOAD JQUERY UI ASSETS-->


   <!--jQuery References-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js" type="text/javascript"></script>


<!--Wijmo Widgets JavaScript-->
<!--Wijmo Widgets JavaScript-->
<script src="http://cdn.wijmo.com/jquery.wijmo-open.all.2.1.4.min.js" type="text/javascript"></script>
<script src="http://cdn.wijmo.com/jquery.wijmo-complete.all.2.1.4.min.js" type="text/javascript"></script>


<!--LOAD JQUERY/JAVASCRIPT ASSETS-->

<!--<script type="text/javascript" src="assets/js/bootstrap.js"></script>
<script src="assets/js/scriptdash.js" type="text/javascript"></script>-->

            
  </body>
</html>