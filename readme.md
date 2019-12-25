# Price History

##  A management tool for small business owners to keep track of daily expenses, employees, and visualize data

This project is built using the Laravel Framework. See https://laravel.com/ for documentation.

As of 1/16/2018 this project is still in development, but the master branch will allow full functionality of a basic daily tracking system of income for the day. 

User composter to install packages, use Laravel's artisan tool with the command `php artisan migrate` to create the necessary DB tables.  

## 2019-12-25 - Dockerized!

Local development has been dockerized. Production isn't dockerized. Run `docker-compose up --build` from the root directory and you should be good to go. Localhost is set up on port 8282 for `localhost:8282`. No more vagrant. Huzzah!

### Docker data dump for MySQL

There is a new directory `dump/price_history_2019-12-12.sql` that contains a SQL dump file that will be used when creating a docker volume for MySQL. It is currently ignored my git, so you will have to grab the latest prod SQL dump or re-use your local dev dump. Or, atlernatively, don't import any dump and start a fresh DB with `php artisan migrate`. 
