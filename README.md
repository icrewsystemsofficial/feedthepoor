<p align="center"><img src="https://icrewsystems.com/icrewsystems_mascot.gif" width="400"></p>

<p align="center">
    Simple payments solution for icrewsystems LLP, made with Laravel 7
</p>

## Notice to all developers working on this project
This project is intended for the use of icrewsystems LLP only. You are bound not to share any API keys, logins or whatsoever related to this project with anyone outside of icrewsystems. Doing so will result in severe consequences. 

## How to setup?
1. ```git clone https://github.com/icrewsystemsofficial/payments.git```
2. cd into the directory
3. Run composer install, ```composer install```
4. Create a seperate branch for yourself in git. ```git branch BRANCHNAME``` & ```git checkout BRANCHNAME``` -- Interns are requested not to use Master branch at all. 
5. Copy .env file, ```cp .env.example .env```
6. Generate Key ```php artisan key:generate```

Done! Your project is now setup. You can now directly run it by going to your [http://localhost/payments](http://localhost/payments), you don't have to run ```php artisan serve``` command since we've changed the server.php to index.php to simulate a production environment. 

## How to report?
Mark your assigned tasks from "Planned" to "In Progress" while working on it, Once you've committed & pushed it, change the task status to "Done". You must report your work on the commits.

- Leonard Selvaraja, 
CEO, icrewsystems.
