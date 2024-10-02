SETUP 
git clone <repository-url>
cd <repository-directory>

-------------------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------------------

cp .env.example .env

ADD 

BROADCAST_DRIVER=
PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=
PUSHER_SCHEME=
PUSHER_APP_CLUSTER=

-------------------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------------------

composer install 
npm install 

php artisan migrate --seed
php artisan serve
npm run dev
php artisan queu:work
php artisan schedule:work


-------------------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------------------

USERS

user@example.com
password

admin@example.com
password
