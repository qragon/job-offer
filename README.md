# How to run

## Step 1
1. Install and launch docker
2. Open terminal in project folder
3. Run `docker-compose up -d`

## Step 2 
4. Run `docker-compose run --rm php-cli composer install`
5. Run `docker-compose run --rm node npm i`
6. Run `docker-compose run --rm node npm run build`
7. Create `.env` file from with correct Mysql connection
8. Run `docker-compose run --rm php-cli php artisan migrate`
9. Run `docker-compose run --rm php-cli php artisan db:seed`

## Step 3
10. Open `http://localhost:8080` in your browser

## Mor info
Tables for review:
- products
- users (default laravel)
- basket

Code review:
- web.php
- HomeController.php
- BasketController.php
- Modules folder
