#!/bin/bash
set -e
#
#echo "Deployment started ..."
#
#(php artisan down) || true
#
#git pull origin main
#
#composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

php artisan clear-compiled

php artisan config:clear
php artisan config:cache

php artisan route:clear
php artisan route:cache

php artisan view:clear
php artisan view:cache

#php artisan optimize
#
#commit_message=$(git log -1 --pretty=%B)
#if [[ "$commit_message" == *"--migrate"* ]]; then
#    echo "Running migrations..."
#    php artisan migrate
#else
#    echo "No migrations required."
#fi
#
#if [[ "$LAST_COMMIT_MSG" == *"--seed="* ]]; then
#  SEED_NAME=$(echo "$LAST_COMMIT_MSG" | sed -n 's/.*--seed=\([^ ]*\).*/\1/p')
#  echo "Seeding detected. Running seeder: $SEED_NAME..."
#  php artisan db:seed --class="$SEED_NAME"
#else
#  echo "No seeding required in last commit."
#fi
#
#php artisan up
#
#echo "Deployment finished!"
