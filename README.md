<p align="center">
    <img src="https://cdn.discordapp.com/attachments/530789778912837640/691801343723307068/1585008642050.png" width="300">   
</p>

<p align="center">    
    <strong>#feedThePoor Initiative, 2021.</strong>
    <br>
    <small>"Feeding the hungry is greater work than raising the dead"</small>
</p>

## Why #feedThePoor?
<h3>"I don't know...I want to help, but who knows my money is actually being used to feed the needy?"</h3>
This, is the first thing that haunts the mind of every good soul that wants to help. "Trust & Transparency", This is the issue we're trying to fix with the help of technology. Seeing is beliving. With our app, the donor will be able to see the happy, smiley face of an underprivledged human whom they've just fed. "Trust & Transparency"

Visit our live site at: https://feedthepoor.online

## How to setup & contribute?

### Prerequisites

We have used Laragon for this project. If you do not use Laragon, then skip the steps that are related to Laragon. If you want to use Laragon then please download laragon from here: https://laragon.org/

### How to get the files cloned on your local machine

1. Run this command: ```git clone https://github.com/icrewsystemsofficial/donation.git``` (Clone this into the www directory under your Laragon root directory, only if you are using Laragon)
2. Rename the directory ```donation``` to ```feedThePoor```
3. Enter (CD) into this directory

### How to set this project on your local machine?

Note: If you are using an UNIX based system (ex: MacOS/ Linux), follow the README-unix.md
1. Make sure you have followed the steps above.
2. Inside the root directory of the project, find this file: ```setup.bat```. Double click on this to run (Windows ONLY)

Note: If you have problems with the above step, please follow README-unix.md.
How to know if you had problems? A command prompt window should open. If everything worked fine, you'll see no errors and the console output will end with "FeedThePoor Project Setup Complete, Have Fun!".

3. Run this command ```php artisan developer:set``` and create an account. 

4. Change the ```ADMIN_EMAIL``` parameter in the .env file to the administrator's email ID. (OPTIONAL, only if you have mailtrap account)

5. Try running ```php artisan serve``` and it should spin up a development server. Go to the url given by the development server and you should see Boomerang UI kit's main page. (OPTIONAL)

### How to configure Laragon for this projects

Normally Laragon should autodetect the file when you clone it inside the **www directory** under laragon root directory. If it doesnot **try restarting laragon or rebooting your machine**. 

How to know if it worked for you? Well, open Laragon and click on "Start all", then try visiting these routes: http://feedThePoor.test or http://localhost/feedThePoor. This should load the homepage with all the CSS and JS applied. If the stying is not applied, follow steps-

If it does not work, follow the steps:

1. Copy the path of your Laragon root directory. In my case, its D:/Laragon/ (I will call this directory as **LARAGON_ROOT**)
2. Open the LARAGON_ROOT and find this file and open it with notepad: ```etc\apache2\sites-enabled\00-default.conf```
3. Add the following code inside the file. Remember, you will only append the following code and NOT replace any exsisting code with this code:
```
<VirtualHost **:80> 
    DocumentRoot "LARAGON_ROOT\www\feedThePoor\public"
    ServerName feedThePoor.test
    ServerAlias **.feedThePoor.test
    <Directory "LARAGON_ROOT\www\feedThePoor\public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

Done! Your project is now set up. You can now directly run it by going to your project going to the http://feedThePoor.test OR https://localhost/feedThePoor. You don't have to run ```php artisan serve``` command since Laragon will serve your project from now on.

### How to push to Github

1. Make sure you have created a branch with your first name.
2. Use this command to stage the changes: ```git add .```
3. Use this command to commit the changes: ```git commit -m "Your Commit Message"```
4. Use this command to push the changes to remote repo: ```git push origin YOUR_BRANCH_NAME``` (Replace YOUR_BRANCH_NAME with your own branch name, i.e., your first name)
5. Send a pull request to **MASTER** branch

Make sure to push your code at the end of each day after you made your changes.

Also make sure to pull the code everyday before starting work.

## Rules and Best Practices

1. Please **do not** send a pull request to the **PRODUCTION** branch. This branch is reserved for the production server. Any pull requests to this branch will be declined unless the pull request is from any Lead Engineer or Project Incharge

2. Please **do not** merge your pull request to Main branch unless said so by the Lead Engineer/ Project Incharge.

3. Write what are the new features added/ bug fixed in your commit message. Keep this message very brief.

## How to report?
Mark your assigned tasks from "Planned" to "In Progress" while working on it, Once you've committed & pushed it, change the task status to "Done". You must report your work on the commits.

## Whom to contact in case of doubts?

#### 1. Samay Bhattacharyya (Lead Software Developer)
Email: engineering@icrewsystems.com

## Whom to contact for Copyright claims

Please send a mail to ceo@icrewsystems.com in case of any copyright claims. Please note that this project is not-for-profit and open source. See our licenses for more details.

## Project Development is sponsored by

icrewsystems Software Engineering LLP, India <br>
<img src="https://icrewsystems.com/logo.png" width="150">   

GemHosting, United Kingdom <br>
<img src="https://gem-hosting.com/Assets/img/logos/V4/Logo-Version-4-1500x360.png" width="150">   

## Credits

1. Boomerang UI: https://github.com/webpixels/boomerang-free-bootstrap-ui-kit
2. SB Admin 2: https://startbootstrap.com/theme/sb-admin-2
3. Laravel: https://laravel.com/
