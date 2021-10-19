<?php
if(isset($_SERVER['HTTP_HOST']) && !empty($_SERVER['HTTP_HOST'])){
    $domain = $_SERVER['HTTP_HOST'];
}

return [
    'defaultStartUrl' => "/community",
		'imageUrl'=>'/storage',
		'isPartnerSite'=> $domain != '116.122.157.150:8084' ? 'Y':'N',
];
