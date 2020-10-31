<p align="center">
    <img src="https://cdn.discordapp.com/attachments/530789778912837640/691801343723307068/1585008642050.png" width="300">   
</p>

<p align="center">    
    <strong>#feedThePoor Initiative, 2020.</strong>
    <br>
    <small>"Feeding the hungry is greater work than raising the dead"</small>
</p>

## Why #feedThePoor?
<h3>"I don't know...I want to help, but who knows my money is actually being used to feed the needy?"</h3>
This, is the first thing that haunts the mind of every good soul that wants to help. "Trust & Transparency", This is the issue we're trying to fix with the help of technology. Seeing is beliving. With our app, the donor will be able to see the happy, smiley face of an underprivledged human whom they've just fed. "Trust & Transparency"

## How to setup & contribute?
1. ```git clone https://github.com/icrewsystemsofficial/donation.git```
2. cd into the directory
3. Run composer install, ```composer install```
4. Create a seperate branch for yourself in git. ```git branch BRANCHNAME``` & ```git checkout BRANCHNAME``` -- Interns are requested not to use Master branch at all. 
5. Copy .env file, ```cp .env.example .env```
6. Generate Key ```php artisan key:generate```
7. Change the ```ADMIN_EMAIL``` parameter in the .env file to the administrator's email ID.

Done! Your project is now setup. You can now directly run it by going to your [http://localhost/donation](http://localhost/donation), you don't have to run ```php artisan serve``` command since we've changed the server.php to index.php to simulate a production environment. 

## How to report?
Mark your assigned tasks from "Planned" to "In Progress" while working on it, Once you've committed & pushed it, change the task status to "Done". You must report your work on the commits.

## Project Development is sponsored by


icrewsystems Software Engineering LLP, India <br>
<img src="https://icrewsystems.com/logo.png" width="150">   

GemHosting, United Kingdom <br>
<img src="https://gem-hosting.com/Assets/img/logos/V4/Logo-Version-4-1500x360.png" width="150">   

