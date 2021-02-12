<?php 

return [
	'project' => [
		'SITE_URL' => 'https://smart-surveillance-web-app.herokuapp.com/'
	],
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