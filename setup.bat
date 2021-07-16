@echo off
color a
:::
:::      ______            _ _______ _          _____
:::     |  ____|          | |__   __| |        |  __ \
:::     | |__ ___  ___  __| |  | |  | |__   ___| |__) |__   ___  _ __
:::     |  __/ _ \/ _ \/ _` |  | |  | '_ \ / _ \  ___/ _ \ / _ \| '__|
:::     | | |  __/  __/ (_| |  | |  | | | |  __/ |  | (_) | (_) | |
:::     |_|  \___|\___|\__,_|  |_|  |_| |_|\___|_|   \___/ \___/|_|
:::
:::                    #feedThePoor Initiative, 2021.
:::      "Feeding the hungry is greater work than raising the dead"
:::
:::
for /f "delims=: tokens=*" %%A in ('findstr /b ::: "%~f0"') do @echo(%%A
copy .env.example .env
call composer install
call composer update
php artisan key:generate
call npm install
call npm audit fix
call npm run dev
call composer dumpautoload
php artisan migrate:fresh
php artisan roles:generate
php artisan db:seed
echo.
echo FeedThePoor Project Setup Complete, Have Fun!
echo.
pause
