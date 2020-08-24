<p align="center">    
    <strong>
	    Coast2Coast, sea food delivery app
    </strong>
</p>
<p align="center">
    <img src="https://cdn.discordapp.com/attachments/530789778912837640/747505788783951993/mockup_coast2coast.png" width="500">   
</p>
<p align="center">    
    <small>
	Made with Laravel 7 by icrewsystems
   </small>
</p>


## How to setup
1. ```git clone https://github.com/icrewsystemsofficial/coast2coast.git```
2. cd into the directory
3. Run composer install, ```composer install```
4. Create a seperate branch for yourself in git. ```git branch BRANCHNAME``` & ```git checkout BRANCHNAME``` -- Interns are requested not to use Master branch at all. 
5. Copy .env file, ```cp .env.example .env```
6. Generate Key ```php artisan key:generate```
7. Go to /database/seed/UsersTableSeeder.php and update the second entry to your name & email ID.
8. Migrate DB & Seed it (only required on the first time, unless directed by Project Manager)  ```php artisan migrate --seed```

Done! Your project is now setup. You can now directly run it by going to your [http://localhost/coast2coast](http://localhost/coast2coast), you don't have to run ```php artisan serve``` command since we've changed the server.php to index.php to simulate a production environment. 

## How to report?
Mark your assigned tasks from "Planned" to "In Progress" while working on it, Once you've committed & pushed it, change the task status to "Done". You must report your work on the commits.

## Copyrights
icrewsystems Software Engineering LLP, India <br>
<img src="https://icrewsystems.com/logo.png" width="150">   

