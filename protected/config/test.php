<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'晚霞居--更酷的新闻和图片浏览',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

  'modules'=>array(  
      'user',  
      'gii'=>array(
          'class'=>'system.gii.GiiModule',
          'password'=>'801024',
      ),
      
  ),
	'defaultController'=>'share',

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		/*'db'=>array(
			'connectionString' => 'sqlite:protected/data/blog.db',
			'tablePrefix' => 'tbl_',
		),
		// uncomment the following to use a MySQL database
		*/
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=sharepic',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'lm800107',
			'charset' => 'utf8',
			'tablePrefix' => 'share_',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
    'urlManager'=>array(
    	'urlFormat'=>'path',
    	'rules'=>array(
    		'post/<id:\d+>/<title:.*?>'=>'post/view',
    		'posts/<tag:.*?>'=>'post/index',
    		'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
    	),
    ),  
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error',
				), 
				// uncomment the following to show log messages on web pages
				
				/*array(
					'class'=>'CWebLogRoute', 
          'levels'=>'error,warning,info,profile,trace',          
				),   */  
       array(
					'class'=>'CProfileLogRoute',
          'levels'=>'error',
				),         
				
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).'/params_test.php'),
  'language'=>'zh_cn',
  'timeZone' => 'Asia/Shanghai', 
  
);