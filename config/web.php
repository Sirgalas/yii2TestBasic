<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'defaultRoute' => 'post/post/index',
    'bootstrap' => ['log'],
    'aliases' => [
        '@myweb'=> "http://".$_SERVER['HTTP_HOST'].'/web/'
    ],
    'components' => [
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@dektrium/user/views' => '@app/modules/users/views/user'
                ],
            ],
        ],
        'request' => [
            'cookieValidationKey' => '1MftF_29QdkodLdnr9Ya1cZy4HWquo40',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
    'modules' => [
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ],
        'users' => [
            'class' => 'app\modules\users\Module',
        ],
        'message' => [
            'class' => 'app\modules\message\Module',
            'models'=>['app\modules\post\models\Post'],
            'user'  =>'dektrium\user\models\User',
        ],
        'user' => [
            'class' => 'dektrium\user\Module',
            'adminPermission' => 'admin',
            'modelMap' => [
                'Profile'=>'app\models\Profile',
            ],
            'controllerMap' => [
                'admin' => 'app\modules\users\controllers\AdminController',
                'registration' => [
                    'class' => \dektrium\user\controllers\RegistrationController::className(),
                    'on ' . \dektrium\user\controllers\RegistrationController::EVENT_AFTER_REGISTER  => function ($event) {
                        $auth = Yii::$app->authManager;
                        $role = $auth->getRole('user');
                        $user = \dektrium\user\models\User::findOne(['username' => $event->form->username]);
                        $auth->assign($role, $user->id);
                    }
                ],
            ],
            //'admins' => ['Sergalas'] first register user admin

        ],
        'rbac' => 'dektrium\rbac\RbacWebModule',
        'post' => [
            'class' => 'app\modules\post\Module',
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
