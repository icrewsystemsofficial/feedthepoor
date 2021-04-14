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
php artisan sweetalert:publish
php artisan vendor:publish --provider="Barryvdh\Debugbar\ServiceProvider"
php artisan vendor:publish --provider="Barryvdh\DomPDF\ServiceProvider"
php artisan vendor:publish --provider="Spatie\Activitylog\ActivitylogServiceProvider" --tag="migrations"
php artisan vendor:publish --provider="Spatie\Activitylog\ActivitylogServiceProvider" --tag="config"
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
php artisan vendor:publish --provider="Mckenziearts\Notify\LaravelNotifyServiceProvider"
call composer dumpautoload
php artisan migrate:fresh
php artisan db:seed
php artisan roles:generate
echo.
echo FeedThePoor Project Setup Complete, Have Fun!
echo.
pause
