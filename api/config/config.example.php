<?php 

return [
	's3' => [
		'KEY' => 'KEY',
		'SECRET' => 'SECRET_KEY_HERE',
		'BUCKET' => 'BUCKET_HERE',
		'REGION' => 'REGION_HERE_HERE',
		'VERSION' => 'VERSION_HERE'
	],
	'twilio' => [
		'SID' => 'SID_HERE',
		'TOKEN' => 'TOKEN_ID_HERE'
	],
	'cognito' =>[
		'POOL_NAME' => 'POOL_NAME_HERE',
		'CLIENT_NAME' => 'CLIENT_NAME_HERE',
		'POOL_ID' =>  'POOL_ID_HERE',
		'CLIENT_ID' => 'CLIENT_ID_HERE',
		'REGION' => 'REGION_HERE',
		'VERSION' => 'VERSION_HERE'
	],
	'dynamoDB' => [
		'PROFILE' => 'defult',
		'REGION' => 'REGION_HERE',
		'VERSION' => 'VERSION_HERE'
	],
	'firebase' =>[
		'API_KEY' => 'API_KEY_HERE',
		'AUTH_DOMAIN' => 'AUTH_DOMAIN_HERE',
		'DATABASE_URL' =>  'DB_URL_HERE',
		'PROJECT_ID' => 'PPROJECT_ID_HERE',
		'STORAGE_BUCKET' => 'STORAGE_BUCKET_HERE',
		'MESSAGING_SENDER_ID' => 'SENDER_ID_HERE',
		'APP_ID' => 'APP_ID_HERE',
		'MEASUREMENT_ID' => 'MEASUREMENT_ID_HERE'
	]
];

return [
	's3' => [
		'KEY' => 'AKIATBV3IPRIMW7QIUPG',
		'SECRET' => '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',
		'BUCKET' => 'demo-video-stream',
		'REGION' => 'us-west-2',
		'VERSION' => 'latest'
	],
	'twilio' => [
		'SID' => 'ACce931b8f75762d92f45a22bd5c114590',
		'TOKEN' => '6c084db83cc14b6543c9151765fc8e37'
	],
	'cognito' =>[
		'POOL_NAME' => 'smartsurvelliancef8c6bcbd_userpool_f8c6bcbd-dev',
		'CLIENT_NAME' => 'smartsf8c6bcbd_app_clientWeb',
		'POOL_ID' =>  'us-east-1_kTZT79J8N',
		'CLIENT_ID' => 'd9423d0k0uisl7epfa9ffupge',
		'REGION' => 'us-east-1',
		'VERSION' => 'latest'
	],
	'dynamoDB' => [
		'PROFILE' => 'defult',
		'REGION' => 'us-east-1',
		'VERSION' => 'latest',
		'USERS_TABLE' => 'UserDetail-mnlk6vdryzhbzfwvniw47hvbfm-dev',
		'IMAGE_RECOGNITION_TABLE' => 'ImageRecognitionStatus-mnlk6vdryzhbzfwvniw47hvbfm-dev'
	],
	'firebase' =>[
		'API_KEY' => 'AIzaSyB3YnQ2WaEQWGspxexCKSBc-1dF4kX7lQE',
		'AUTH_DOMAIN' => 'smart-surveillance-1eaf6.firebaseapp.com',
		'DATABASE_URL' =>  'https://smart-surveillance-1eaf6.firebaseio.com',
		'PROJECT_ID' => 'smart-surveillance-1eaf6',
		'STORAGE_BUCKET' => 'smart-surveillance-1eaf6.appspot.com',
		'MESSAGING_SENDER_ID' => '301561777685',
		'APP_ID' => '1:301561777685:web:ea02d8076f1a6a5de7081c',
		'MEASUREMENT_ID' => 'G-47LRFVSMHN'
	]
];

firebase.initializeApp({
    apiKey: "apiKey",
    authDomain: "authDomain",
    databaseURL: "databaseURL",
    projectId: "projectId",
    storageBucket: "storageBucket",
    messagingSenderId: "messagingSenderId",
    appId: "appId",
    measurementId: "measurementId",
 });

firebase.initializeApp({
    apiKey: "AIzaSyB3YnQ2WaEQWGspxexCKSBc-1dF4kX7lQE",
    authDomain: "smart-surveillance-1eaf6.firebaseapp.com",
    databaseURL: "https://smart-surveillance-1eaf6.firebaseio.com",
    projectId: "smart-surveillance-1eaf6",
    storageBucket: "smart-surveillance-1eaf6.appspot.com",
    messagingSenderId: "301561777685",
    appId: "1:301561777685:web:ea02d8076f1a6a5de7081c",
    measurementId: "G-47LRFVSMHN",
 });