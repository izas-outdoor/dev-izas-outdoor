#!/bin/bash
cd
cd $1
sh bin/flush-cache $1
redis-cli -h izas.redis flushall
echo "ban req.url ~ /" |nc izas.varnish 8081
time curl -X POST "https://api.cloudflare.com/client/v4/zones/c8d9706629ee57fec277f55629e02f87/purge_cache" \
     -H "X-Auth-Email: gabriel@wetrust.es" \
     -H "X-Auth-Key: 30f741f99c6e05fe456382852374f7de1e6dc" \
     -H "Content-Type: application/json" \
     --data '{"purge_everything":true}'
