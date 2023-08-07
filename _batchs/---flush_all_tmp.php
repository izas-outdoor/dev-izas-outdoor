<?php
use Magento\Framework\App\Bootstrap;
use Predis\Client as Predis;
require __DIR__ . "/../app/bootstrap.php";
$bootstrap = Bootstrap::create(BP, $_SERVER);
$objectManager = $bootstrap->getObjectManager();

//echo '@Gabriel : forbidden mouahahhhahaha !! ';die;

try{
    $_cacheTypeList = $objectManager->create('Magento\Framework\App\Cache\TypeListInterface');
    $_cacheFrontendPool = $objectManager->create('Magento\Framework\App\Cache\Frontend\Pool');
    $types = array('config','layout','block_html','collections','reflection','db_ddl','eav','config_integration','config_integration_api','full_page','translate','config_webservice');
    foreach ($types as $type) {
        $_cacheTypeList->cleanType($type);
        echo 'Cleaning cache ' . $type .'<br/>';
    }
    foreach ($_cacheFrontendPool as $cacheFrontend) {
        $cacheFrontend->getBackend()->clean();
    }
}catch(Exception $e){
    echo $msg = 'Error : '.$e->getMessage();die();
}

echo " ---  Ban varnish START  ---  <br/>";
$curl = curl_init("http://127.0.0.1:6081");
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PURGE");
curl_setopt($curl, CURLOPT_HTTPHEADER, array('X-Magento-Tags-Pattern: .*'));
curl_exec($curl);
echo " ---  Ban varnish END  ---  <br/>";


echo " ---  Ban Cloudflare START  ---  <br/>";
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.cloudflare.com/client/v4/zones/c8d9706629ee57fec277f55629e02f87/purge_cache');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"purge_everything\":true}");

$headers = array();
$headers[] = 'X-Auth-Email: gabriel@wetrust.es';
$headers[] = 'X-Auth-Key: 30f741f99c6e05fe456382852374f7de1e6dc';
$headers[] = 'Content-Type: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
echo " ---  Ban Cloudflare END  ---  <br/>";