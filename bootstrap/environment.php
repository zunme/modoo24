<?php
if(isset($_SERVER['HTTP_HOST']) && !empty($_SERVER['HTTP_HOST'])){
    $domain = $_SERVER['HTTP_HOST'];
}
$env = $app->detectEnvironment(function(){
    $environmentPath = __DIR__.'/../.env';
    $setEnv = trim(file_get_contents($environmentPath));
    if (file_exists($environmentPath))
    {
        putenv("$setEnv");
        if (getenv('APP_ENV') && file_exists(__DIR__.'/../.env.'.$domain)) {
        	$dotenv = new Dotenv\Dotenv(__DIR__.'/../', '.env.'.$domain);
        	$dotenv->overload();
        } 
    }
});