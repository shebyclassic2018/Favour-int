<p align="center"><img src="public/image/logo/logo.png" width="400" style="background: white"></p>
<br>

## Favour International pre and primary school

<br></br>

## Steps to follow after downloading zipped file
- Unzip the file to a specific directory you want
- Create database, dbname = 'favour-int' 
- Open the root directory in command prompt (cmd)

## Run these commands
```bat
composer update
```

```bat
php artisan migrate:fresh --seed
```

## Run the website
```bat
php artisan serve
```