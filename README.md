# Simple invoice

<a href="https://simple-invoice.rounak-nikhar.com" target="_blank">Live preview</a>

A simple invoice generator created using Laravel 11, Vue 3, MySQL, PHP v.8.3

To run this project into your local environment:

-   Clone the project

Run these commands from console/wsl:

```

npm install
composer install
php artisan migrate --seed
composer run dev

```

> If everything went well without any error, you should be able to run the project at this point.

The default account creds with seeded data is :

```
test@example.com
password

```

Feel free to create your own account and play around!
This is a very basic side of invoice creation and generate PDFs of it, I have plans to keep working on in when i get a chance in the future.

## Tech

Docker, Laravel 11 (eloquent), inertia.js, Vue 3, mySQL, TailwindCSS, daisyUI, domPDF etc.
