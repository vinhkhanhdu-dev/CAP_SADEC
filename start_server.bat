@echo off
start "Server 1" cmd /k "cd /d D:\07_Backup\Per\api_login_setup_comman && php artisan serve"
start "Server 2" cmd /k "cd /d D:\07_Backup\Per\api_login_setup_comman && npm run watch"
start "Server 3" cmd /k "cd /d D:\07_Backup\Per\api_login_setup_comman\nodejs && node index.js"


