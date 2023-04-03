## Installation Steps

```
## 
.env file: 
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_LOG_LEVEL=debug
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=


##
Installing the system with Docker
docker-compose up --build  --force-recreate
docker-compose exec app composer install
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan config:cache


## database from scratch with Docker
docker-compose exec app php artisan migrate
docker-compose exec app php artisan db:seed


##
Installing workbench https://downloads.mysql.com/archives/workbench
If container can't install db: service mysql stop

## 
Import existing DB
//apt install mysql-client-core-8.0
//apt install mariadb-client-core-10.3
//docker exec -i <container_id> mysql -uroot -psecret notidata < papperssdatabase.sql (this not worked last time we try)


## 
Doing Symlink to see news images and carousel matches clicking on "Lector Rss"
create news-images and chart-images folder inside storage/app/
create symlink for chart-images and news-images folder in public folder/

a Delete "charts" file inside /public y go into Docker conteiner to do the symlink 
b Type "docker ps" to know what Digitalocean.com/php container is
c Go inside docker container typing docker exec -it e9581a2bd233 /bin/sh (in this case digital ocean container is: e9581a2bd233)
d Once inside type ln -s /var/www/storage/app/charts /var/www/public
(if it doesn't work try with docker-compose exec app php artisan storage:link)


## 
Cronjob instead of clicking on "Lector Rss"
sudo crontab -e
Press 1
Enter
Example:
* * * * * cd /home/gonzalo/Desktop/papperss && docker-compose exec -T app php artisan schedule:run >> /dev/null 2>&1


## 
Recaptcha:
Type this key on .env file
NOCAPTCHA_SECRET=6LfZrEAeAAAAAFDoAe81Wgh48wkiluRdSkA76pCF
NOCAPTCHA_SITEKEY=6LfZrEAeAAAAADMz0JS7CHwCHpWgQT6WrOHIh6oi

If it doesn't work "clear cache" from console


##
Gmail credentials: 
This credentials works on Desktop pc: In .env file add:
MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=ssl

(You have to wait two days aprox for approval and start sending automatic emails)


## 
Login to the system using
-   username: 
-   password: 
```
