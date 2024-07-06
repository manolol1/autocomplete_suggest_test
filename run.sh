#!/bin/bash

# update/deploy website to apache directory
cp website/index.php /srv/www/htdocs
cp website/search.php /srv/www/htdocs

# run api server
cd api
node app.js
