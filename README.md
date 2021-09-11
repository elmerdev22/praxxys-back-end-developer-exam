Installtion Process:

After cloning the repository. run this command on your terminal
1) composer install
2) npm install
3) npm run dev
4) create .env file and copy the config in .env.example
5) then create mysql database name 'laravel'
6) php artisan migrate --seed
7) php artisan serve (default Laravel development server: http://127.0.0.1:8000 )
    NOTES : if you are using custom host and port please change the API baseUrl in 'App\resources\js\http-common.js'
8) Go to admin login page 
    http://127.0.0.1:8000/admin/login
    
Default Admin credentials
username: admin
email   : admin@admin.com
password: password

And that's all :)
Thank you!