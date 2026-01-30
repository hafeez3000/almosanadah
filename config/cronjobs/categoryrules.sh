#!/bin/bash

phpcontainer=$(docker ps   -n 1  -f "status=running" -f  "name=php-fpm" -q | xargs)
docker exec --user www-data  $phpcontainer php scripts/categoryrules/accessories-bags.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/accessories-balls.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/accessories-belts.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/accessories-cyclingcleats.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/accessories-fitnesstrackers.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/accessories-gloves.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/accessories-insoles.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/accessories-laces.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/accessories.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/accessories-shinguards.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/accessories-sport.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/accessories-sunglasses.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/accessories-watches.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/activities-basketball.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/activities-casual.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/activities-dress.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/activities-hiking.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/activities-running.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/activities-safety.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/activities-skate.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/activities-soccer.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/activities-western.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/activities-work.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/apparel-compression.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/apparel-dresses.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/apparel-fangear.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/apparel-hats.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/apparel-hoodies.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/apparel-outerwear.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/apparel.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/apparel-scarves.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/apparel-shorts.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/apparel-socks.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/apparel-sweaters.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/apparel-top.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/brand-converse-pattern.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/catalog.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/kids-athletic.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/kids-boat.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/kids-boots.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/kids-clearance.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/kids-infant.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/kids-oxford.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/kids.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/kids-shoes.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/kids-todler.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/kids-youth.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/men-athletic.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/men-boat.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/men-boot.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/men-clogs.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/men-loafers.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/men-oxford.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/men-sandals.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/men-shoes.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/men-slippers.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/shop-exotic.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/women-atheletic.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/women-boat.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/women-boot.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/women-clogmules.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/women-flats.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/women-heels.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/women-oxford.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/women-sandles.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/women-shoes.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/women-sleepers.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/women-slipon.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/new-arrivals.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/sales/catalog-sale-accessories.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/sales/catalog-sale-apparel.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/sales/catalog-sale-boots.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/sales/catalog-sale-kids.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/sales/catalog-sale-men.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/sales/catalog-sale-mizuno.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/sales/catalog-sale-newBalance.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/sales/catalog-sale.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/sales/catalog-sale-puma.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/sales/catalog-sale-running.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/sales/catalog-sale-skate.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/sales/catalog-sale-soccer.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/sales/catalog-sale-western.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/sales/catalog-sale-women.php
sleep 10
docker exec --user www-data  $phpcontainer php scripts/categoryrules/sales/catalog-sale-workAndDuty.php

