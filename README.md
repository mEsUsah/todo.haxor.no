[<img src="public/resources/svg/haxor_no-white.svg" width="250" style="display:inline-block"/>](public/resources/svg/haxor_no-white.svg)
# Todo Haxor

Simple Laravel app for realtime colaboration on todo-lists using Websockets.

- Build with Laravel 11

## Installation
Install dependencies
```bash
composer install
npm install
```

## DDev setup
To start the the DDev instance, simply run:
```bash
ddev start
```

## Websockets
To make the app work it does need to have access to a pusher compliant messaging service. Change the credentials in the .env file accordingy.

## Setup
On a fresh install, you need to change the DB values in the .env file and then run the migrations to create DB tables.
You also need to generate the security key.
```bash
php artisan migrate
php artisan key:generate
```

## Create Admin user
Admin users can add more users via the web GUI. To create the Admin user run the following command:
```bash
php artisan haxor:create-admin
```
