<?php 
    require '../../vendor/autoload.php';
    $config = require 'config.php';
    
    

    class Database{
 
        // specify your own database credentials

        private $db_name = $config['mongoDB']['DB_NAME'];
        private $db_password = $config['mongoDB']['DB_PASSWORD'];
        private $db_user = $config['mongoDB']['DB_USER'];
        public $conn;
     
        // get the database connection
        public function connect(){
     
            $this->conn = null;
     
            try{
                $client = new MongoDB\Client('mongodb+srv://'.$db_user.':'.$db_password.'@cluster0.51uyd.mongodb.net/'.$db_name.'?retryWrites=true&w=majority');

                $db = $client->smart_surveillance;
                $userCollection = $db->users;
            }catch (Exception $e) {
                echo $e->getMessage();
            }
     
            return $this->conn;
        }


        // public function conncet(){
        //     $connection =new MongoClient();
            
        //     $db =$connection->Database;

        //     return $db;


        // }


    }

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