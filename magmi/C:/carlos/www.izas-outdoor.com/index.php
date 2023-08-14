<?php
/**
 * Application entry point
 *
 * Example - run a particular store or website:
 * --------------------------------------------
 * require __DIR__ . '/app/bootstrap.php';
 * $params = $_SERVER;
 * $params[\Magento\Store\Model\StoreManager::PARAM_RUN_CODE] = 'website2';
 * $params[\Magento\Store\Model\StoreManager::PARAM_RUN_TYPE] = 'website';
 * $bootstrap = \Magento\Framework\App\Bootstrap::create(BP, $params);
 * \/** @var \Magento\Framework\App\Http $app *\/
 * $app = $bootstrap->createApplication(\Magento\Framework\App\Http::class);
 * $bootstrap->run($app);
 * --------------------------------------------
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

try {
    require __DIR__ . '/app/bootstrap.php';
} catch (\Exception $e) {
    echo <<<HTML
<div style="font:12px/1.35em arial, helvetica, sans-serif;">
    <div style="margin:0 0 25px 0; border-bottom:1px solid #ccc;">
        <h3 style="margin:0;font-size:1.7em;font-weight:normal;text-transform:none;text-align:left;color:#2f2f2f;">
        Autoload error</h3>
    </div>
    <p>{$e->getMessage()}</p>
</div>
HTML;
    exit(1);
}


if(isset($_SERVER['REDIRECT_MAGE_RUN_TYPE'])){
	$_SERVER['MAGE_RUN_TYPE'] = $_SERVER['REDIRECT_MAGE_RUN_TYPE'];
} 
if(isset($_SERVER['REDIRECT_MAGE_RUN_CODE'])){
	$_SERVER['MAGE_RUN_CODE'] = $_SERVER['REDIRECT_MAGE_RUN_CODE'];
} 



$bootstrap = \Magento\Framework\App\Bootstrap::create(BP, $_SERVER);
/** @var \Magento\Framework\App\Http $app */
$app = $bootstrap->createApplication(\Magento\Framework\App\Http::class);
$bootstrap->run($app);

ini_set('display_error', 1);
#$log  = $_SERVER['HTTP_CF_IPCOUNTRY'] . " ------ ". $_SERVER['REMOTE_ADDR'].' ------ '.date("F j, Y, g:i a") ." ------ ".$_SERVER['REQUEST_URI'] ." ------ (" .$_SERVER['HTTP_USER_AGENT'] .")" . PHP_EOL;
#file_put_contents('./var/log/access.log', $log, FILE_APPEND);
