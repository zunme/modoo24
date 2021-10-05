<?php
if(isset($_SERVER['HTTP_HOST']) && !empty($_SERVER['HTTP_HOST'])){
    $domain = $_SERVER['HTTP_HOST'];
}
return [
    'defaultStartUrl' => "/community",
		'imageUrl'=>'/storage',
		'isPartnerSite'=> $domain != 'modoo24.run.goorm.io' ? 'Y':'N',
];