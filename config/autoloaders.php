<?php 
    // require '../vendor/autoload.php';
    // $config = require 'config.php';

    // use Aws\S3\S3Client;
    // use Aws\DynamoDb\DynamoDbClient;
    // use Aws\DynamoDb\Exception\DynamoDbException;

    // date_default_timezone_set('Africa/Lagos');

    // $bucket = $config['s3']['BUCKET'];

    // $client = new S3Client([
    //     'version' => $config['s3']['VERSION'],
    //     'region' => $config['s3']['REGION'],
    //     'credentials' => [
    //         'key' => $config['s3']['KEY'],
    //         'secret' => $config['s3']['SECRET']
    //     ]
    // ]);

    // $dynamoDbClient = new DynamoDbClient([
    //     'version' => $config['dynamoDB']['VERSION'],
    //     'region' => $config['dynamoDB']['REGION'],
    //     'credentials' => [
    //         'key' => $config['s3']['KEY'],
    //         'secret' => $config['s3']['SECRET']
    //     ]
    //     ,'scheme'  => 'https' // Use this if you don't have HTTPS
    //     , 'debug' => false
    // ]);