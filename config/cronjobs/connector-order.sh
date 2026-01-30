#!/bin/bash

phpcontainer=$(docker ps   -n 1  -f "status=running" -f  "name=php-fpm" -q | xargs)
docker exec --user www-data  $phpcontainer  php bin/magento kensium:sync order 16 1 COMPLETE MANUAL NULL NULL
