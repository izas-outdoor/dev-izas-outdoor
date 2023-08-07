#!/bin/bash
cd
cd $1
time /usr/sbin/container-run oxeva/php-7.3-gw php -dmemory_limit=512M bin/magento maintenance:enable
rm -rf var/cache/ var/page_cache/ generated/ var/di/ var/view_preprocessed/ var/generation/
time /usr/sbin/container-run oxeva/php-7.2-gw php -dmemory_limit=512M bin/magento setup:upgrade
time /usr/sbin/container-run oxeva/php-7.2-gw php -dmemory_limit=512M bin/magento setup:di:compile
sh bin/deploy-static.sh $1
time /usr/sbin/container-run oxeva/php-7.3-gw php -dmemory_limit=512M bin/magento setup:static-content:deploy  -j 8 -t Magento/backend en_US
time /usr/sbin/container-run oxeva/php-7.3-gw php -dmemory_limit=512M bin/magento setup:static-content:deploy  -j 8 -t Magento/backend fr_FR
time /usr/sbin/container-run oxeva/php-7.3-gw php -dmemory_limit=512M bin/magento setup:static-content:deploy  -j 8 -t Magento/backend es_ES
time /usr/sbin/container-run oxeva/php-7.3-gw php -dmemory_limit=512M bin/magento setup:static-content:deploy  -j 8 -t Seonov/kilpi en_US
time /usr/sbin/container-run oxeva/php-7.3-gw php -dmemory_limit=512M bin/magento setup:static-content:deploy  -j 8 -t Seonov/kilpi es_ES
time /usr/sbin/container-run oxeva/php-7.3-gw php -dmemory_limit=512M bin/magento setup:static-content:deploy  -j 8 -t Seonov/kilpi it_IT
time /usr/sbin/container-run oxeva/php-7.3-gw php -dmemory_limit=512M bin/magento setup:static-content:deploy  -j 8 -t Seonov/kilpi fr_FR
time /usr/sbin/container-run oxeva/php-7.3-gw php -dmemory_limit=512M bin/magento cache:enable
time /usr/sbin/container-run oxeva/php-7.3-gw php -dmemory_limit=512M bin/magento cache:clean
time /usr/sbin/container-run oxeva/php-7.3-gw php -dmemory_limit=512M bin/magento cache:flush
time /usr/sbin/container-run oxeva/php-7.3-gw php -dmemory_limit=512M bin/magento maintenance:disable
redis-cli -h izas.redis flushall
echo "ban req.url ~ /" |nc izas.varnish 8081
time curl -X POST "https://api.cloudflare.com/client/v4/zones/c8d9706629ee57fec277f55629e02f87/purge_cache" \
     -H "X-Auth-Email: gabriel@wetrust.es" \
     -H "X-Auth-Key: 30f741f99c6e05fe456382852374f7de1e6dc" \
     -H "Content-Type: application/json" \
     --data '{"purge_everything":true}'
