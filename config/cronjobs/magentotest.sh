#!/bin/bash

phpcontainer=$(docker ps   -n 1  -f "status=running" -f  "name=php-fpm" -q | xargs)
docker exec $phpcontainer touch magecrontest.txt
