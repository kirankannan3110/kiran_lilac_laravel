#!/bin/bash
  #export WEB_DIR="/home/bestdeal/api.best-deals.ae"
  export WEB_DIR="/var/www/html/api.best-deals.ae/public"
  export WEB_USER="ubuntu"
  cd $WEB_DIR
  echo path is $PWD
  ls -la

  sudo -u $WEB_USER /usr/bin/php artisan config:clear
  sudo -u $WEB_USER /usr/bin/php artisan cache:clear
  sudo -u $WEB_USER /usr/local/bin/composer dump-autoload --no-interaction
  sudo -u $WEB_USER /usr/bin/php artisan view:clear
  sudo -u $WEB_USER /usr/bin/php artisan route:clear
  sudo -u $WEB_USER /usr/bin/php artisan migrate --force

  sudo chown -R www-data:www-data $WEB_DIR
