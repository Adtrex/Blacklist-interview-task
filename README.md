### Setting up your workspace

Before running this app, locally make sure you have the following software installed:

-   XAMPP or it's equivalent
-   NPM
-   Composer

How to Test

1. Clone this repository with `git clone https://github.com/Adtrex/Blacklist-interview-task.git`
2. Run `cd Blacklist-interview-task`
3. Run `composer install`
4. Run `npm install`
5. Run `npm run dev`
6. Run `cp .env.example .env` to copy the contents of **.env.example** file to **.env** file and then change the values as appropriate
7. Run `php artisan key:generate --show` to retrieve a base64 encoded string for Laravel's `APP_KEY` in `.env`
8. Run `php artisan migrate --seed` from your terminal to run the migrations and seeders`
9. Run `php artisan serve` from your terminal and the app will be running on `http://127.0.0.1:8000/`
10. Run `php artisan queue:work` to execute queued jobs.

Link to API documentation: [here](https://documenter.getpostman.com/view/11277551/UV5ZCcRY#fc8a4278-4c17-46b7-95de-c6cf6af5c89b).

Thank you.

Adekunte Tolulope.