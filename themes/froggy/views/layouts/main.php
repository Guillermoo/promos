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
  <!--START NAVBAR KO -->

  <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#"><img src="assets/img/logo.png" alt=""/></a>

          <div class="nav-collapse">

     <ul class="nav pull-right">
     <li>
     <div class="btn-group" style="margin-top:7px;">  <a class="medium twitter button radius" style="text-decoration:none;"><i style="font-size:14px; padding-top:3px; padding-right:5px;" class="icon-envelope-alt"></i>(5) Messages[Main]</a> <a href="login.htm" class="medium twitter button radius" style="text-decoration:none;"><i style="font-size:16px; padding-top:3px; padding-right:5px;" class="icon-off"></i>Leap out</a> </div>
      </li>
  <li class="dropdown">
    <a href="pages.htm" class="dropdown-toggle" data-toggle="dropdown">
      <span style="padding-right:10px; width:30px;"><img src="assets/img/user_thumb.jpg" style="width:30px;" alt=""/></span>Mr Froggy
      <b class="caret"></b>
    </a>
    <ul class="dropdown-menu">
      <li>
        <a href="error.htm">Privacy Settings</a>
      </li>
      <li>
        <a href="error.htm">My Account</a>
      </li>
      <li>
        <a href="error.htm">System Settings</a>
      </li>
      <li class="divider"></li>
      <li>
        <a href="error.htm"><i style="font-size:14px; padding-top:3px; padding-right:5px;" class="icon-user"></i>My Account</a>
      </li>
      <li>
        <a href="error.htm"><i style="font-size:14px; padding-top:3px; padding-right:5px;" class="icon-lock"></i>Privacy Settings</a>
      </li>
       <li>
        <a href="error.htm"><i style="font-size:14px; padding-top:3px; padding-right:5px;" class="icon-cogs"></i>System Settings</a>
      </li>
    </ul>
  </li>
</ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

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
   <p style="margin-left:10px;">Proemoción</p>
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