#!/bin/bash
cd
cd $1
time rm -rf pub/static/frontend/* pub/static/adminhtml/*
time find pub/static -name js-translation.json -exec rm -rf {} \;
time /usr/sbin/container-run oxeva/php-7.3-gw php -dmemory_limit=512M bin/magento setup:static-content:deploy  -j 8 -t Magento/backend  en_US
time /usr/sbin/container-run oxeva/php-7.3-gw php -dmemory_limit=512M bin/magento setup:static-content:deploy  -j 8 -t Magento/backend  fr_FR
time /usr/sbin/container-run oxeva/php-7.3-gw php -dmemory_limit=512M bin/magento setup:static-content:deploy  -j 8 -t Magento/backend  es_ES
time /usr/sbin/container-run oxeva/php-7.3-gw php -dmemory_limit=512M bin/magento setup:static-content:deploy  -j 8 -t Seonov/kilpi en_US
time /usr/sbin/container-run oxeva/php-7.3-gw php -dmemory_limit=512M bin/magento setup:static-content:deploy  -j 8 -t Seonov/kilpi es_ES
time /usr/sbin/container-run oxeva/php-7.3-gw php -dmemory_limit=512M bin/magento setup:static-content:deploy  -j 8 -t Seonov/kilpi it_IT
time /usr/sbin/container-run oxeva/php-7.3-gw php -dmemory_limit=512M bin/magento setup:static-content:deploy  -j 8 -t Seonov/kilpi fr_FR
sh bin/flush-cache.sh $1
time /usr/sbin/container-run oxeva/php-7.3-gw php -dmemory_limit=512M bin/magento maintenance:disable
