## Url Shortener Project

This is the repository for the Url Shortener Project built with Laravel and Vue.js

The goal of the project is to allow users to shorten long URLs into shorter, more manageable ones.

## Project

![Project Screnshot](/screenshots/Project.png)

## Examples of generated short Urls

![Generated Urls](/screenshots/Urls-Examples.png)

## Example of Form Validation

![Form Validation](/screenshots/Form-validation-example.png)

## Technologies Used

-   Vue.js
-   Tailwind CSS
-   Laravel

## Key features

-   Intuitive User Interface
-   Fully Responsive User Interface
-   Generating a unique short URL from a long URL
-   Storing the mapping between the short url and the original long URL
-   Redirecting users to the original URL when they access the short url
-   Displaying basic stats about the generated URLs

## Installation

To run the project locally :

-   Clone the project

```
git clone https://github.com/hamza-eshoul/URL-Shortener.git
cd URL-Shortener
```

-   Install composer dependecies

```
composer install
```

-   Install npm dependencies

```
npm install
```

-   Create a .env file and updat its content by setting up a connection to a local database

```
cp .env.example .env
```

-   Generate a new application key

```
php artisan key:generate --ansi
```

-   Run migrations

```
php artisan migrate
```

-   Start laravel server

```
php artisan serve
```

-   Start Node.js development server

```
npm run dev
```

-   Open http://localhost:8000 with your browser to access a local version of the project
