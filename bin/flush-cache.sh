#!/bin/bash
cd
cd $1
time /usr/sbin/container-run oxeva/php-7.3-gw php -dmemory_limit=512M bin/magento cache:enable
time /usr/sbin/container-run oxeva/php-7.3-gw php -dmemory_limit=512M bin/magento cache:clean
time /usr/sbin/container-run oxeva/php-7.3-gw php -dmemory_limit=512M bin/magento cache:flush
