# My Troy Web Technical Assessment:
A Library Book Resource Manager.

After cloning the repo, use the following commands to get started:
```shell
composer update
npm install
php artisan migrate
php artisan db:seed --class=BookSeeder
php artisan db:seed --class=RoleSeeder
php artisan db:seed --class=LibrarianSeeder
composer run dev
```