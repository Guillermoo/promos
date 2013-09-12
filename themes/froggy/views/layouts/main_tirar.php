<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
    <!-- <link rel="stylesheet" type="text/css" href="<?php //echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />
	<link media="screen" rel="stylesheet" type="text/css" href="<?php //echo Yii::app()->theme->baseUrl; ?>/css/main.css"  />
    <link rel="stylesheet" href="<?php //echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php //echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-responsive.min.css"> -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/dashboard.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-responsive.css" />
	<!-- <link media="screen" rel="stylesheet" type="text/css" href="<?php //echo Yii::app()->theme->baseUrl; ?>/css/main.css"  /> -->
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/font-awesome.css">
	<?php Yii::app()->bootstrap->register(); ?>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<!--LOAD GOOGLE WEBFONTS -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600,700' rel='stylesheet' type='text/css'>

      <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
</head>

<body>


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
     <div class="btn-group" style="margin-top:7px;">  <a class="medium twitter button radius" style="text-decoration:none;"><i style="font-size:14px; padding-top:3px; padding-right:5px;" class="icon-envelope-alt"></i>(5) Messages</a> <a href="login.htm" class="medium twitter button radius" style="text-decoration:none;"><i style="font-size:16px; padding-top:3px; padding-right:5px;" class="icon-off"></i>Leap out</a> </div>
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


    <li class="active">
      <a href="#labels">
  <i style="margin-top:7px;" class="icon-dashboard icon-large"></i> Dashboard
</a>
    </li>
    <li>
      <a href="pages.htm"><i style="margin-top:7px;" class="icon-th icon-large"></i>Pages</a>
    </li>
    <li>
      <a href="pages.htm"><i style="margin-top:7px;" class=" icon-file icon-large"></i>Articles</a>
    </li>
    <li>
      <a href="pages.htm"><i style="margin-top:7px;" class="icon-picture icon-large"></i>Media</a>
    </li>
    <li>
      <a href="pages.htm"><i style="margin-top:7px;" class="icon-bar-chart icon-large"></i>Reports</a>
    </li>
    <li>
      <a href="pages.htm"><i style="margin-top:7px;" class="icon-tasks icon-large"></i>Widgets</a>
    </li>
       <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="pages.htm">
     <i style="margin-top:7px;" class="icon-cog icon-large"></i>Settings
        <b class="caret"></b>
      </a>
      <ul class="dropdown-menu">
        <li>
          <a href="#">Server Status</a>


        </li>
        <li>
          <a href="pages.htm">Security</a>
        </li>
        <li>
          <a href="pages.htm">Cache</a>
        </li>
        <li>
          <a href="pages.htm">Templates</a>
        </li>
      </ul>
    </li>
     <li>

  <form style="padding:5px;" class="navbar-search pull-left" action="">
            <input type="text" class="search-query span3" placeholder="Search">
          </form>

    </li>
  </ul>

</div>




 <!--END NAVBAR -->










 <!--START MAIN-CONTENT -->

 <div class="container" style="margin-top:30px;">


 <!--START STATS-WIDGET -->

  <div class="row">
    <div class="span7"><div class="widget_heading"><h4>Statistics</h4></div><div class="widget_container">




   <ul id="sortable" class="unstyled" style="padding-left:20px;">
         <li class="span2 ui-state-default"><div class="infoblock shadow"><h1 style="color:#4DB848;">$2565</h1>
       <p>Todays Earnings</p></div>
    </li>
           <li class="span2 ui-state-default"><div class="infoblock shadow"><h1 style="color:#0099FF;">10,789</h1>
       <p>Unique Visitors</p></div>
    </li>

     <li class="span2 ui-state-default"><div class="infoblock shadow"><h1 style="color:#ff4056;">500,467</h1>
       <p>Total Visitors</p></div>
    </li>

        <li class="span2 ui-state-default"><div class="infoblock shadow"><h1 style="color:#ff9900;">1,486</h1>
       <p>Registered Users</p></div>
    </li>
           <li class="span2 ui-state-default"><div class="infoblock shadow"><h1 style="color:#FF6320;">564</h1>
       <p>Published Articles</p></div>
    </li>

     <li class="span2 ui-state-default"><div class="infoblock shadow "><h1 style="color:#6148B3;">4,587</h1>
       <p>Todays Visitors</p></div>
    </li>
    </ul>


    </div></div>

    <!--END STATS-WIDGET -->




       <!--START -RECENT-POSTS-WIDGET -->

  <div class="span5"><div class="widget_heading"><h4>Recent Posts</h4></div><div class="widget_container">


  <ul class="unstyled">

   <li class="widget_recent_posts">
<div class="widget_rp_img">
 <a href=""> <img src="assets/img/thumb_d_1.jpg" alt="froggy 1"> </a>
</div>

<div class="widget_rp_des">
<h4><a href="#">Ipsum is simply dummy</a><span>1 day ago</span></h4>
<p> Lorem Ipsum is simply dummy text of the is text printing...</p>
 </div>
   </li>

   <li class="widget_recent_posts">
<div class="widget_rp_img">
 <a href="">  <img src="assets/img/thumb_d_2.jpg" alt="froggy 2"> </a>
</div>

<div class="widget_rp_des">
<h4><a href="#">Ipsum is simply dummy</a><span>2 hours ago</span></h4>
<p> Lorem Ipsum is simply dummy text of the is text printing...</p>
 </div>
   </li>
   <li class="widget_recent_posts">
<div class="widget_rp_img">
<a href="#">  <img src="assets/img/thumb_d_3.jpg" alt="froggy 3">  </a>
</div>

<div class="widget_rp_des">
<h4><a href="#">Ipsum is simply dummy</a><span>30 min ago</span></h4>
<p> Lorem Ipsum is simply dummy text of the is text printing...</p>
 </div>
   </li>

  </ul>
  </div></div>
</div>


 <!--END-RECENT-POSTS-WIDGET -->





   <!--START-DAILY REPORT-WIDGET -->


     <div class="row">
  <div class="span6"><div class="widget_heading"><h4>Daily Report</h4></div><div class="widget_container"><!-- Begin demo markup -->

        <!--START-LINE GRAPH -->

      <div id="wijlinechartDefault" class="ui-widget ui-widget-content ui-corner-all" style="width: 540px; height: 248px; background: white; border:0px; ">

      </div>

      <!--END-LINE GRAPH -->


</div></div>


   <!--END-DAILY REPORT-WIDGET -->


      <!--START-QUICK-POST-WIDGET -->

  <div class="span6"><div class="widget_heading"><h4>Quick Post</h4></div><div class="widget_container">
  <div class="control-group">
  <label class="control-label" for="input01">Title</label>
  <div class="controls">
    <input type="text" class="input-xlarge span5" >

</div>
     <label class="control-label" for="input01">Description</label>


   <textarea class="input-xlarge span5" id="textarea" rows="4"></textarea>

       <div class="insert-actions">

 <div class="btn-toolbar">

  <div class="btn-group">
    <a class="btn" href="#">
      <i class="icon-film"></i>
    </a>
    <a class="btn" href="#">
      <i class="icon-music"></i>
    </a>
    <a class="btn" href="#">
      <i class=" icon-picture"></i>
    </a>
    <a class="btn" href="#">
      <i class="icon-align-justify"></i>
    </a>


</div>
<p class="pull-right">
<button class="btn btn-medium btn-primary">Publish</button></p>

</div>
</div>
</div>
</div>
</div>
</div>

<!--END-QUICK-POST-WIDGET -->


 <!--START-STATIC TEXT-WIDGETS -->


<div class="row">
<div class="span6"><div class="widget_heading"><h4>6 Column</h4></div><div class="widget_container"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi non quam sit amet lacus pellentesque gravida eu vel ante. Suspendisse tellus massa, lobortis eu placerat eu, lacinia ut eros. Nam fermentum aliquet molestie. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Quisque vestibulum egestas suscipit. Donec suscipit sagittis enim at auctor. Quisque molestie felis eget ligula rhoncus suscipit.

 Quisque iaculis ligula nec tellus consequat dignissim. Suspendisse volutpat nulla erat, vitae lobortis nunc. Integer sed tempus arcu. Sed varius aliquet sem, sit amet laoreet mauris rhoncus non. Curabitur eget urna turpis, eu ultricies mauris. Sed hendrerit ante non nisl sodales luctus   In varius ultricies neque ut porttitor. Praesent sapien metus, adipiscing eget placerat sed, porttitor sed metus. Phasellus quis ipsum sapien. Mauris ut sem ut erat placerat ultricies vitae venenatis odio. Fusce varius tortor sed ipsum dapibus gravida faucibus nunc vehicula. Nulla faucibus tortor vitae ligula volutpat</p></div></div>
 <div class="span6"><div class="widget_heading"><h4>6 Column</h4></div><div class="widget_container">

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi non quam sit amet lacus  sit amet, consectetur adipiscing elit. Morbi non quam sit amet lacus   sit amet, consectetur adipiscing elit. Morbi non quam sit amet lacus   sit amet, consectetur adipiscing elit. Morbi non quam sit amet lacus   sit amet, consectetur adipiscing elit. Morbi non quam sit amet lacus   sit amet, consectetur adipiscing elit. Morbi non quam sit amet lacus pellentesque gravida eu vel ante. Suspendisse tellus massa, lobortis eu placerat eu, lacinia ut eros. Nam fermentum aliquet molestie. Cum sociis natoque penatibus et magnis dis.  Morbi non quam sit amet lacus pellentesque gravida eu vel ante. Suspendisse tellus massa, lobortis eu placerat eu, lacinia ut eros. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi non quam sit amet lacus pellentesque gravida eu vel ante. Suspendisse tellus massa, lobortis eu placerat eu, lacinia ut eros. Nam fermentum aliquet molestie. Cum sociis natoque penatibus et magnis dis parturient montes, nasce</p>


</div>
</div>
</div>
</div>
 </div>

<!--END-STATIC TEXT-WIDGETS -->


  <footer>


       <div class="footer_container">
          <div class="container">
    <p style="margin-left:10px;">froggy - the awesome admin panel</p>
    </div>
          </div>
        </footer>




  <!--LOAD JQUERY UI ASSETS-->


   <!--jQuery References-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js" type="text/javascript"></script>


<!--Wijmo Widgets JavaScript-->
<!--Wijmo Widgets JavaScript-->
<script src="http://cdn.wijmo.com/jquery.wijmo-open.all.2.1.4.min.js" type="text/javascript"></script>
<script src="http://cdn.wijmo.com/jquery.wijmo-complete.all.2.1.4.min.js" type="text/javascript"></script>


<!--LOAD JQUERY/JAVASCRIPT ASSETS-->

<script type="text/javascript" src="assets/js/bootstrap.js"></script>
<script src="assets/js/scriptdash.js" type="text/javascript"></script>

<!-- ----------------------- -->



<div class="container" id="page">
	<?php if(YII_RUTAS == true) echo __FILE__; ?>
	<!-- menu horizontal -->	
	<div id="mainmenu">		
		<!-- navbar de bootstrap -->
		<?php 
			$this->widget('UserNav');
		?>
		<!-- ------------------- -->
	</div><!-- mainmenu -->
	<!-- --------------- -->
	<?php if(YII_RUTAS == true) echo __FILE__; ?>
	<!-- Para debugear como en cake, notcar -->
	<?php if(!empty(Yii::app()->params['debugContent'])):?>
                <?php echo Yii::app()->params['debugContent'];?>
	<?php endif;?>
	<!-- End debug -->

	<?php echo $content; ?>

</div><!-- page -->

</body>
</html>
