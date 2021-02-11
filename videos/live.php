<?php
    require_once(__DIR__ .'/../partials/header.inc.php');
    require_once(__DIR__ .'/../partials/quickSearch.inc.php');
    require_once(__DIR__ .'/../partials/sideBar.inc.php');

    // $objects = $client->ListObjects('ListObjects', [
    //     'Bucket' => $config['s3']['BUCKET'],
    //     'Prefix' => 'UnknownFaces/cdf655a5-8c29-4f3a-96ec-f417a58aa338/',
    //     'Delimiter' => '/'
    // ]);

    // var_dump($objects);
    
?>
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="page-title">Video Streams</h2>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    List of video streams according to date. These videos are streaming from  this <?= strtoupper($config['s3']['BUCKET']);?> bucket.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="videoMostRecentdata">
                    </div>
                    <script>
                        $(document).ready(function(){
                          refreshMostRecent();
                        });

                        function refreshMostRecent(){
                            $('#videoMostRecentdata').load('videos/most-recent-video.php', function(){
                                // Refreshes every 2 minutes
                                var interval = 1000 * 60 * 2;
                                setTimeout(refreshMostRecent, interval);
                                // showNotification();
                            });
                        }

                    </script>
                    <div class="row" id="videoDataResult">
                    </div>
                    <script>
                        $(document).ready(function(){
                            refreshTable();
                        });

                        function refreshTable(){
                            $('#videoDataResult').load('videos/live-stream-video.php', function(){
                                // Refreshes every 2 minutes
                                var interval = 1000 * 60 * 2;
                                setTimeout(refreshTable, interval);
                            });
                        }

                    </script>
                </div>
                
            </div><!-- Page Content -->


<?php require_once(__DIR__ .'/../partials/footer.inc.php');  ?>