<?php 
$connection = (new MongoDB\Client);
$db = $connection->smart_surveillance;
$userCollection = $db->users;


echo phpinfo();


return [
	'project' => [
		'SITE_URL' => 'https://smart-surveillance-web-app.herokuapp.com/'
	],
	's3' => [
		'KEY' => 'AKIATBV3IPRIPWYNAMC5',
		'SECRET' => '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',
		'BUCKET' => 'detection-garage',
		'REGION' => 'us-east-1',
		'VERSION' => 'latest',
		'IMAGE_PREFIX' => 'UnknownFaces/cdf655a5-8c29-4f3a-96ec-f417a58aa338/',
		'VIDEO_PREFIX' => 'intruderfaces/cdf655a5-8c29-4f3a-96ec-f417a58aa338/'
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