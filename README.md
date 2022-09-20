# nartask1

## Kurulum
- docker-compose up -d
- docker exec -it nartask1_workspace_1 /bin/bash
- composer install
- php artisan key:generate
- php artisan queue:work
- php artisan swoole:http start
### Sanal host
- nginx+php-fpm için **task1.test**
- swoole için **task1-swoole.test** + workspace üzerinde **php artisan swoole:http start**

### Organizasyon bilgilerini içeriye aktarmak
- php artisan import:organizations
