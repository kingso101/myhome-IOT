<?php

namespace AWSCognitoApp;
require_once('vendor/autoload.php');
$config = require './config/config.php';
use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;

use Aws\DynamoDb\DynamoDbClient;
use Aws\DynamoDb\Exception\DynamoDbException;

date_default_timezone_set('Africa/Lagos');
$dynamoDbClient = new DynamoDbClient([
    'version' => $config['dynamoDB']['VERSION'],
    'region' => $config['dynamoDB']['REGION'],
    'credentials' => [
        'key' => $config['s3']['KEY'],
        'secret' => $config['s3']['SECRET']
    ]
    ,'scheme'  => 'https' // Use this if you don't have HTTPS
    , 'debug' => false
]);
 
// Save the token from firebase to dynamoDB 
if (isset($_POST['token']) && isset($_POST['action'])) {
	ob_start();
	session_start();
	// Process the dynamo functionality for saving in db
    // Decode the firebase push notification token
    $token = htmlspecialchars(strip_tags($_POST['token']));
    $action = htmlspecialchars(strip_tags($_POST['action']));
	$sub = $_SESSION['sub'];
	$user_id = $sub;

    if ($action === 'save') {
        try {
            $response = $dynamoDbClient->getItem(array(
                'ConsistentRead' => true,
                'TableName' => $config['dynamoDB']['USERS_TABLE'],
                'Key' => array(
                    'id' => array( 'S' => $user_id)
                )
             ));

            $found = false;

            foreach ($response as $item) {
                $fcm_token = $item['fcmRegistrationId'];
                // print_r($fcm_token);
                foreach ($fcm_token as $value) {
                    foreach ($value as $result) {
                        if ($result['S'] === $token) {
                            $found = true;
                            break;  
                        }
                    }
                }            
            }

            if ($found === true) {
                echo "Yes token exist.. No need to save again.";
            }

            if ($found === false) {
                echo "Noo token does not exist..";
                $pro = $dynamoDbClient->updateItem(array(
                    'TableName' => $config['dynamoDB']['USERS_TABLE'],
                        'Key' => array(
                            'id' => array('S' => $user_id)
                        ),
                    'ExpressionAttributeNames' => ['#TokenList' => 'fcmRegistrationId'],
                    "ExpressionAttributeValues" => [
                        ':val' => [
                            'L' => [[
                                'S' => $token
                            ]]
                        ]
                    ],
                    'ReturnValues' => 'ALL_NEW',
                    'UpdateExpression' => 'SET #TokenList = list_append( #TokenList, :val )'
                    // 'UpdateExpression' => 'SET #TokenList = :val'
                ));
                print_r($pro);
            }

        } catch (DynamoDbException $e) {
            // The PutItem operation failed.
            echo $e->getMessage();
        }
    }

    if ($action === 'delete') {
        try {
            $response = $dynamoDbClient->getItem(array(
                'ConsistentRead' => true,
                'TableName' => $config['dynamoDB']['USERS_TABLE'],
                'Key' => array(
                    'id' => array( 'S' => $user_id)
                )
             ));

            $found = false;

            foreach ($response as $item) {
                $fcm_token = $item['fcmRegistrationId'];
                // print_r($fcm_token);
                foreach ($fcm_token as $value) {
                    
                    foreach ($value as $key => $result) {
                        if ($result['S'] === $token) {
                            $keyIndex = $key;
                            $found = true;
                            break;  
                        }
                    }
                }            
            }

            if ($found === true) {
                echo "Yes token was seen and will be deleted soon.";
                $resolve = $dynamoDbClient->updateItem(array(
                    'TableName' => $config['dynamoDB']['USERS_TABLE'],
                        'Key' => array(
                            'id' => array('S' => $user_id)
                        ),
                    // 'ReturnValues' => 'ALL_OLD',
                    'UpdateExpression' => 'REMOVE fcmRegistrationId['.$keyIndex.']',
                ));
                print_r($resolve);
            }

            if ($found === false) {
                echo "Noo token was not seen.";
            }

        } catch (DynamoDbException $e) {
            // The PutItem operation failed.
            echo $e->getMessage();
        }
    }    

} else {
	echo "Missing token parameter.";
    header('Location: dashboard.php');
}
