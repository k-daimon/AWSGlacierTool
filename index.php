<?php

use GuzzleHttp;

require './GlacierUtility.php';

$gu = new GlacierUtility();

$mode = $_GET['mode'];
if (!empty($mode)) {
    switch ($mode) {
        case 'jo':
            break;
    }
}


// Jobを作成
//$gu->createJobInventoryRetrieval();
//$gu->createJobArchiveRetrieval('XNNrC8_BwmsPGY140PNK8xv7BrTcfCuDG7MivMCFgX1EsSA_PjX8EsqGJqemBjbzeTXaUPxVXGB_U4hr2ZKHRy7sGwEj403qR6OdkH9svBbGFan-FbNfxq4jtwbqzfd-avyiMEjtKw');

// JOBを取得
$jobs = $gu->listJobs()->get('JobList');
//$retrieveArchiveJobOutput = $gu->getJobOutput('fbxjrLOqgFd0ccoET6l4kxmxAk4ZD9YXkErObwyMjd2dM-NuV6b1Sf5bubRQh8NDxTsgy1SqFpxhWqscLR7dYW-7s1kd');
$retrieveInventoryJobOutput = $gu->getJobOutput('HLtIxIKixMu3qwPTah4yHrQKfcZOmd83Btl7Seacu2xWY9g1LM_hp4JBkfYzFQnpPSCwJyyQXe_lW1lkCyUboJZQ4RUo');

// JSON形式の結果Streamから取得したデータ
//$contents = $retrieveArchiveJobOutput->get('body')->getContents();
//file_put_contents("test.mp4", $contents);

// JSON形式の結果Streamから取得したデータ
$contents = $retrieveInventoryJobOutput->get('body')->getContents();
var_dump($contents);

$gu->deleteArchive('WdE1UPwUjRbLxPfSYjYDyKmG7J3rQCVIYro1kNeXnK1HdR7c8LLwd3kefAmMmttsH45DfH4RdxJcoYSeWlBVV4olgkEZtyOE9YwY0EHTNICOKfqMIPkWjiFYrtRSPiCV9852JsQsZQ');
$gu->deleteArchive('g7jD8elJbWnvpOZRajECQUSr_BhY_RAT9M4ifBUVoEJ4bbygnITd8l-KyyYFTW1I778DmSA5oWGsbeWbRVC8HE6vyQflQ4NSygOAK8MFE573-udvdD2hNfJETHDZg6tR0mKKP9i0tg');
$gu->deleteArchive('XNNrC8_BwmsPGY140PNK8xv7BrTcfCuDG7MivMCFgX1EsSA_PjX8EsqGJqemBjbzeTXaUPxVXGB_U4hr2ZKHRy7sGwEj403qR6OdkH9svBbGFan-FbNfxq4jtwbqzfd-avyiMEjtKw');

?>
<!DOCTYPE html>
<html lang="ja">
<head>

</head>
<body>
<div>
    <?php foreach ($jobs as $key => $job): ?>
        <div>
            <?php if ($job['StatusCode'] == "Succeeded"): ?>
                <a href="?mode=jo&key=<?php echo $key;?>" ><?php echo $job['JobId'];?></a>
            <?php else: ?>
                <?php echo $job['JobId'];?>
            <?php endif;?> /
            <?php echo $job['Action'];?> /
            <?php echo $job['StatusCode'];?> /
            <?php echo $job['CreationDate'];?>
        </div>
    <?php endforeach;?>
</div>

</body>
</html>


