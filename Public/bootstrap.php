<?php 
const DEFAULT_APP = 'Frontend';



if (!isset($_GET['app']) || !file_exists(__DIR__.'/../App'.$_GET['app'])) {
    $_GET['app'] = DEFAULT_APP;
}


require __DIR__.'/../lib/Frame/SplClassLoader.php';


$FrameLoader = new SplClassLoader('Frame', __DIR__.'/../lib');
$FrameLoader->register();

$appLoader = new SplClassLoader('App', __DIR__.'/..');
$appLoader->register();

$modelLoader = new SplClassLoader('Model', __DIR__.'/../lib/vendors');
$modelLoader->register();

$entityLoader = new SplClassLoader('Entity', __DIR__.'/../lib/vendors');
$entityLoader->register();

$appClass = 'App\\'.$_GET['app'].'\\'.$_GET['app'].'Application';

$app = new $appClass;
$app->run();

?>