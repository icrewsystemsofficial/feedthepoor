Steps to setup:

2. Copy .env file using this command, ```cp .env.example .env```
3. Run composer install using this command, ```composer install```
4. Create a seperate branch for yourself in git. ```git branch BRANCHNAME``` & ```git checkout BRANCHNAME``` -- Interns are requested not to use Master/ Main branch at all. 
5. Generate a Key using this command ```php artisan key:generate``` 
6. Run composer dumpautoload using this command, ```composer dumpautoload```
7. Go to phpMyAdmin/ HeidiSQL (or any of your mysql consoles) and create a new database called 'feedThePoor'
8. Go to .env and update the value of your database name in the field "DB_DATABASE", for example: ```DB_DATABASE=feedthepoor```
9. Run this command ```npm install``` to install all the node modules
10. Run this command ```npm run dev``` to compile the css
11. Run the following commands one by one:
```
php artisan sweetalert:publish
php artisan vendor:publish --provider="Barryvdh\Debugbar\ServiceProvider"
php artisan vendor:publish --provider="Barryvdh\DomPDF\ServiceProvider"
php artisan vendor:publish --provider="Spatie\Activitylog\ActivitylogServiceProvider" --tag="migrations"
php artisan vendor:publish --provider="Spatie\Activitylog\ActivitylogServiceProvider" --tag="config"
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```

Note: If you get errors while performing the step 10, run ```npm run dev``` for two three times. If the error persists, contact your project incharge (for icrewsystems' interns/engineers) or open an issue.

11. Run the command ```php artisan migrate```, this will create the tables (if any)
12. Run the command ```php artisan db:seed``` this will seed the database (if any seeders available)
