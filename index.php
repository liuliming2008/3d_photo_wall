<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/../../liming/yii118/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following line when in production mode
define('YII_DEBUG',true);

require_once($yii);

Yii::createWebApplication($config)->run();
                                                 