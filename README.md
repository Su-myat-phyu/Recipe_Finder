# Recipe Finder

Recipe Finder is a Laravel 13 web application for discovering recipes from ingredients users already have at home. It uses Spoonacular for recipe search, details, instructions, and nutrition, while local MySQL tables store user accounts, favorite recipes, and search history.

## Stack

- PHP 8.5
- Laravel 13
- MySQL
- Blade
- Tailwind CSS 4
- Alpine.js
- Axios
- Vite
- Spoonacular API

## Requirements

Enable these PHP extensions before installing Composer dependencies:

- `curl`
- `fileinfo`
- `mbstring`
- `openssl`
- `pdo_mysql`
- `zip` or a system unzip/7z binary

## Setup

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm run build
php artisan serve
```

Set your Spoonacular key in `.env`:

```env
SPOONACULAR_API_KEY=your_key_here
```

Configure MySQL in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=recipe_finder
DB_USERNAME=root
DB_PASSWORD=
```

## Architecture

Controllers remain thin and delegate Spoonacular calls, favorites, and history persistence to service classes in `app/Services`. Request validation lives in `app/Http/Requests`, shared filter data is supplied by a view composer, and the interface is built from reusable Blade components.
