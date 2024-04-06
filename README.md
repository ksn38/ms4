docker compose --env-file ./laravel/.env up  
docker exec -it laravel-app bash  
composer install  
php artisan key:generate  


