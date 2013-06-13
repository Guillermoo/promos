<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',
	'theme'=>'classic',	
	'language'=>'en',
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
            'returnUrl' => array('/user/profile'),
 
            # page after logout
            'returnLogoutUrl' => array('/user/login'),
            
        ),
	),

	// application components
	'components'=>array(
		'bootstrap'=>array(
				//'class'=>'bootstrap.components.Bootstrap',
				'class' => 'ext.bootstrap.components.Bootstrap',
				//'coreCss' => false, //use css themes
		),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
				'empresa/<alias:[A-Za-z0-9 _]*[A-Za-z0-9][A-Za-z0-9 _]+>' => 'empresa/view',
				'empresa/edit' => 'empresa',
				'admin/home' => 'user/empresa/home',
				'user' => 'user/empresa/home',
				'user/promociones'=>'user/promocion/promocion',
				'page/<view>'=>array('site/page'),
                                'index'=>array('site/index'),
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				'empresas'=>'empresa/index',
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
					'logFile'=>'trace.log',
                    'levels' => 'error, trace,warning, info',
                    'categories'=>'system.*',
                ),
				array(
					'class'=>'CWebLogRoute',
					'enabled' => YII_DEBUG,
					'levels'=>'trace',
					//'filter'=>'CLogFilter',
					'categories'=>'vardump',
					'showInFireBug'=>true
				),				
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'debugContent'=>'',
		'adminEmail'=>'grillermo@gmail.com',
		'websiteEmail'=>'promos@promos.com',
		'img_default'=>'/img/noprofile.jpg',
		'url_paypal'=>'wwww.sadfsdf.com',
		'path_imgs'=> realpath( Yii::app( )->getBasePath( )."/../" ),
		'cuenta_paypal' => 'grillermo@gmail.com',
	),
);