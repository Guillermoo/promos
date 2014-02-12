<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Proemoción',
	'theme'=>'frontEnd',	
	'language'=>'es',
	// preloading 'log' component
	'preload'=>array('log'),
 
	// autoloading model and component classes
	'import'=>array(
            'application.models.*',
            'application.components.*',
            'application.modules.user.models.*',
            'application.modules.user.components.*',
            'application.modules.rights.*',
            'application.modules.rights.components.*',
            //'ext.giix-components.*', // giix components
            'ext.mailer.*',
            'ext.flash',
	),
	'aliases' => array(
	    //If you manually installed it
	    'xupload' => 'ext.xupload',
	),
	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
                    'class'=>'system.gii.GiiModule',
                    'password'=>'asdf',
                    // If removed, Gii defaults to localhost only. Edit carefully to taste.
                    'ipFilters'=>array('127.0.0.1','::1'),
                    'generatorPaths' => array(
                    'application.gii',  //nested set  Model and Crud templates
                    'ext.ajaxgii', 
                    'ext.giix-core', // giix generators
             ),
        ),
		
        'rights'=>array(
            'superuserName'=>'Admin', // Name of the role with super user privileges. 
           'authenticatedName'=>'Authenticated',  // Name of the authenticated user role. 
           'userIdColumn'=>'id', // Name of the user id column in the database. 
           'userNameColumn'=>'username',  // Name of the user name column in the database. 
           'enableBizRule'=>true,  // Whether to enable authorization item business rules. 
           'enableBizRuleData'=>true,   // Whether to enable data for business rules. 
           'displayDescription'=>true,  // Whether to use item description instead of name. 
           'flashSuccessKey'=>'RightsSuccess', // Key to use for setting success flash messages. 
           'flashErrorKey'=>'RightsError', // Key to use for setting error flash messages. 
           'baseUrl'=>'/rights', // Base URL for Rights. Change if module is nested. 
           'layout'=>'rights.views.layouts.main',  // Layout to use for displaying Rights. 
           'appLayout'=>'application.views.layouts.main', // Application layout. 
           'cssFile'=>'rights.css', // Style sheet file to use for Rights. 
           'install'=>false,  // Whether to enable installer. 
           'debug'=>false, 
		),
		'user'=>array(
            'tableUsers' => 'tbl_users',
            'tableProfiles' => 'tbl_profiles',
            'tableProfileFields' => 'tbl_profiles_fields',
                # encrypting method (php hash function)
            'hash' => 'md5',
 
            # send activation email
            'sendActivationMail' => true,
 
            # allow access for non-activated users
            'loginNotActiv' => false,
 
            # activate user on registration (only sendActivationMail = false)
            'activeAfterRegister' => false,
 
            # automatically login from registration
            'autoLogin' => true,
 
            # registration path
            //'registrationUrl' => array('/user/registration'),
		
			//'registrationCompanyUrl' => array('/user/registrationcompany'),
 
            # recovery password path
            'recoveryUrl' => array('/user/recovery'),
 
            # login form path
            'loginUrl' => array('/user/login'),
 
            # page after login
            'returnUrl' => array('/admin/ee'),
 
            # page after logout
            'returnLogoutUrl' => array('/user/login'),
            
        ),
	),

	// application components
	'components'=>array(
            'Paypal' => array(
                'class'=>'application.components.Paypal',
                'apiUsername' => 'proemocion_api1.proemocion.com',
                'apiPassword' => 'ENVU6DCLB9L6AELF',
                'apiSignature' => 'A0gFURFJhApKq6Rs1dviYnXTG7PYAb-ML-DEq3GEnNFHboH1d6YLiHhG',
                'apiLive' => false,
            
                'returnUrl' => 'paypal/confirm/', //regardless of url management component
                'cancelUrl' => 'paypal/cancel/', //regardless of url management component
                 'currency' => 'EUR',
                  // Default description to use, defaults to an empty string
                //'defaultDescription' => '',
 
                // Default Quantity to use, defaults to 1
                //'defaultQuantity' => '1',
 
                //The version of the paypal api to use, defaults to '3.0' (review PayPal documentation to include a valid API version)
                //'version' => '3.0',
            ),
            'bootstrap'=>array(
                            'class'=>'bootstrap.components.Bootstrap',
                            //'class' => 'ext.bootstrap.components.Bootstrap',
                            'coreCss' => true, //use css themes
            ),
            'ePdf' => array(
            'class'         => 'application.extensions.yii_pdf.EYiiPdf',
            'params'        => array(
                'mpdf'     => array(
                    'librarySourcePath' => 'application.vendors.mpdf.*',
                    'constants'         => array(
                        '_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
                    ),
                    'class'=>'mpdf', // the literal class filename to be loaded from the vendors folder.
                    /*'defaultParams'     => array( // More info: http://mpdf1.com/manual/index.php?tid=184
                        'mode'              => '', //  This parameter specifies the mode of the new document.
                        'format'            => 'A4', // format A4, A5, ...
                        'default_font_size' => 0, // Sets the default document font size in points (pt)
                        'default_font'      => '', // Sets the default font-family for the new document.
                        'mgl'               => 15, // margin_left. Sets the page margins for the new document.
                        'mgr'               => 15, // margin_right
                        'mgt'               => 16, // margin_top
                        'mgb'               => 16, // margin_bottom
                        'mgh'               => 9, // margin_header
                        'mgf'               => 9, // margin_footer
                        'orientation'       => 'P', // landscape or portrait orientation
                    )*/
                ),
                'HTML2PDF' => array(
                    'librarySourcePath' => 'application.vendors.html2pdf.*',
                    'classFile'         => 'html2pdf.class.php', // For adding to Yii::$classMap
                    /*'defaultParams'     => array( // More info: http://wiki.spipu.net/doku.php?id=html2pdf:en:v4:accueil
                        'orientation' => 'P', // landscape or portrait orientation
                        'format'      => 'A4', // format A4, A5, ...
                        'language'    => 'en', // language: fr, en, it ...
                        'unicode'     => true, // TRUE means clustering the input text IS unicode (default = true)
                        'encoding'    => 'UTF-8', // charset encoding; Default is UTF-8
                        'marges'      => array(5, 5, 5, 8), // margins by default, in order (left, top, right, bottom)
                    )*/
                )
            ),
        ),

            'phpThumb'=>array(
                'class'=>'ext.EPhpThumb.EPhpThumb',
                //'options'=>array(optional phpThumb specific options are added here)
            ),
            // uncomment the following to enable URLs in path-format
            'urlManager'=>array(
                'urlFormat'=>'path',
                'showScriptName'=>false,
                'rules'=>array(
                    'empresas'=>'empresa/index',
                    'categorias'=>'categoria/verCategorias',
                    'user/empresa'=>'user/empresa/empresa',
                    'user/empresas'=>'user/empresa/admin',
                    'user/promociones'=>'user/promocion/admin',
                    'user/mispromociones'=>'user/promocion/index',
                    'user/compra/comprado/<id:\d+>'=>'user/compra/comprado/<id:\d+>',
                    'user/contacto'=>'user/user/contacto',
                    'empresa/<alias:[A-Za-z0-9 _]*[A-Za-z0-9][A-Za-z0-9 _]+>' => 'empresa/view',
                    'profile/edit' => 'profile',
                    'user/home' => 'user/profile/home',
                    'user/registrarcomprador' => 'user/registrationcomprador',
                    'user/registrarempresa' => 'user/registrationcompany',
                    'user/user/contact' => 'user/user/contact',
                    'page/<view>'=>array('site/page'),
                    //'index'=>array('site/index'),
                    'promocion/<title_slug:[A-Za-z0-9 _]*[A-Za-z0-9][A-Za-z0-9 _]+>' => 'promocion/view/<title_slug:[A-Za-z0-9 _]*[A-Za-z0-9][A-Za-z0-9 _]+>',
                    'index'=>'promociones/index',
                    '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                    '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                    '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                    'promociones' => 'promocion/index',
                ),
            ),
            'user'=>array(
                'class'=>'RWebUser',
                // enable cookie-based authentication
                'allowAutoLogin'=>true,
                'loginUrl'=>array('/user/login'),
            ),
        'authManager'=>array(
                'class'=>'RDbAuthManager',
                'connectionID'=>'db',
                'defaultRoles'=>array('Authenticated', 'Guest'),
        ),
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database
		'db'=>array(
                    'connectionString' => 'mysql:host=localhost;dbname=promos',
                    'emulatePrepare' => true,
                    'username' => 'root',
                    'password' => '',
                    'charset' => 'utf8',
                    'tablePrefix' => 'tbl_',
                    'enableProfiling' => true,
                    'enableParamLogging' => true,
		),
		
		/*'widgetFactory'=>array(
				'widgets'=>array(
						'TbGridView'=>array(
								//'cssFile' => 'application.css.css.style-gridview.css',
								'cssFile' => '',
						),
				),
		),*/
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
                    'class'=>'CLogRouter',
                    'routes'=>array(
                        // uncomment the following to show log messages on web pages
                        array(
                            'class' => 'CFileLogRoute',
                            //'logFile'=>'trace.log',
                            'levels' => 'error, trace,warning, info'
                            // 'categories'=>'system.*',
                        ),
                        array(
                                'class'=>'CWebLogRoute',
                                'enabled' => YII_DEBUG,
                                /*'levels'=>'trace',
                                'filter'=>'CLogFilter',
                                'categories'=>'vardump',
                                'showInFireBug'=>true*/
                        ),				
                    ),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'debugContent'=>'',
		'adminEmail'=>'hugoepila@gmail.com',
		'websiteEmail'=>'proemocion@proemocion.com',
		'no_image'=>'/img/no_img.jpg',
		'url_paypal'=>'wwww.sadfsdf.com',
		'path_imgs'=> realpath( Yii::app( )->getBasePath( )."/../" ),
		'cuenta_paypal' => 'proemocion@proemocion.com',
	),
    'catchAllRequest'=>file_exists(dirname(__FILE__).'/.maintenance')
        ? array('site/maintenance') : null,    
);

//PAYPAL IPN
    // Define LIVE constant as true if 'localhost' is not present in the host name. Configure the detecting of environment as necessary of course.
/*defined('LIVE') || define('LIVE', strpos($_SERVER['HTTP_HOST'],'localhost')===false ? true : false);
if (LIVE) {
  define('PAYPAL_SANDBOX',false);
  define('PAYPAL_HOST', 'ipnpb.paypal.com');
  define('PAYPAL_URL', 'https://ipnpb.paypal.com/cgi-bin/webscr');
  define('PAYPAL_EMAIL','proemocion@proemocion.com'); // live email of merchant
}else{ */
  define('PAYPAL_HOST', 'www.sandbox.paypal.com');
  define('PAYPAL_URL', 'https://www.sandbox.paypal.com/uk/cgi-bin/webscr');
  define('PAYPAL_EMAIL', 'hlanga.business@hlanga.es'); // dev email of merchant
  define('PAYPAL_SANDBOX',true);
//}