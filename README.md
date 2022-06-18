<p align="center"><a href="https://homes.ngata.co.tz" target="_blank"><img src="public/media/brand/192x192-logo.png" width="400"></a></p>
<br>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Ngata Homes Africa LTD

<br></br>

## Run this command First

### Change directory to Storage then create the Framework directory and change the permission

```bat
mkdir public/video && chmod -R 775 public/video
```

```powershell
rm -rf public/storage && php artisan storage:link
```

```bat
cd storage/
```

```bat
mkdir -p framework/{sessions,views,cache}
```

```bat
cd framework/cache/
```

```bat
mkdir data
```

Then back to storage directory and give framework permission of readwrite and execute

```bat
chmod -R 775 framework
```

## Then no you can Run the followings command

```bat
composer update
```

USER IN ONE COMMAND

```bat
  mkdir -p storage/framework/{sessions,views,cache} && mkdir storage/framework/cache/data && chmod -R 775 storage/framework
  ```

> `Note: If neccessary for only Development in Local Repository`

```bat
npm install
```

```bat
composer dump-autoload
```

> ### `NOTE: Read the` [PROJECT_SETUP](https://github.com/axetrixhub/ngata_homes/blob/f3922352eb7368637f712d540f67af100c492edf/PROJECT_SETUP.md) for setup some changes from the previous batches

```bat
php artisan migrate:fresh --seed
```

Delete Storage folder in public directory if present, if not its oky then run this command to create a linked public directory with storage

```bat
php artisan storage:link
```

## Run the following Command (Only Developer given access)

  ```bat
   git checkout dev
  ```

   ```bat
    git push origin dev
   ```

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Features

- Role Module
- Register Owner
- Register Tenant
- Register Broker

## Kazi ya Kesho

- menu builder
- owner register house
- Broker Functionality

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
