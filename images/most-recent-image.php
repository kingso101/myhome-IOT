<?php
    require_once(__DIR__ .'/../functions.inc.php');
    require_once(__DIR__ .'/../vendor/autoload.php');
    $config = require_once(__DIR__ .'/../config/config.php');
     // AWS API client
    use Aws\S3\S3Client;

    $bucket = $config['s3']['BUCKET'];

    $client = new S3Client([
        'version' => $config['s3']['VERSION'],
        'region' => $config['s3']['REGION'],
        'credentials' => [
            'key' => $config['s3']['KEY'],
            'secret' => $config['s3']['SECRET']
        ]
    ]);

    try {
        $objects = $client->getIterator('ListObjects', [
            'Bucket' => $config['s3']['BUCKET'],
            'Prefix' => $config['s3']['IMAGE_PREFIX'],
            'Delimiter' => '/'
        ]);

        // initialize with a 0 DateTime
        $most_recent = array('LastModified' => date(0));

        foreach ($objects as $object){
            $date1 = object_to_array($object['LastModified']);

            // $date1 = strtotime($object['LastModified']);
            $date1 = date("Y-m-n", strtotime($object['LastModified']));
            $date1 = explode(' ', $date1);

            // DateTime result
            $last_modified = $object['LastModified'];

            $currentTime = time();

            if ($last_modified <  $currentTime - (60*2)) {
                $update = '<span style="color: #fff;position: absolute;top: 0;left: 0;" class="badge badge-success">New</span>';
            }else{
                $update = '';
            }

            if ($last_modified > $most_recent['LastModified']) {
                $most_recent = $object;

                $date = $most_recent['LastModified'];
                $dateFormat = timeago($date);
                $bucket = $config['s3']['BUCKET'];
                // var_dump($most_recent);
                $ext = substr($object['Key'], strrpos($object['Key'], ".") + 1);
                
                if (strlen($most_recent['Key']) <= 30) {
                    $key = $most_recent['Key'];
                } else {
                    $key = substr($most_recent['Key'], 0, 30) . '...';
                }

                $url = $client->getObjectUrl($bucket, $object['Key']);
                // var_dump($url);
            }
        }

        echo '<div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title" title="'.$object['Key'].'">'.$key.'</h5>'.$update.'
                        <span style="color: #fff;position: absolute;top: 0;right: 0;" class="badge badge-info">'.$dateFormat.'</span>
                        <img src="'.$url.'" width="255" height="200" alt="'.$url.'"/>
                    </div>
                </div>
            </div>
        ';

    } catch (Aws\S3\Exception\S3Exception $e) {
        echo "Oops.\n";
        echo $e->getMessage();
    } catch (AwsException $e) {
        // This catches the more generic AwsException. You can grab information
        // from the exception using methods of the exception object.
        echo $e->getAwsRequestId() . "\n";
        echo $e->getAwsErrorType() . "\n";
        echo $e->getAwsErrorCode() . "\n";
        
        var_dump($e->toArray());
    }
    

    
