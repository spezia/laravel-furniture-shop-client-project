# Furniture Shop Project

This is a furniture shop project built with **Laravel 7**, featuring an online shopping cart, multi-language support, and an admin panel. It was intended to be a complete e-commerce solution with online payment integration using **Stripe**.

This project started with static **HTML**, **CSS**, and **JavaScript** files. My role was to turn these files into a working web app using **Laravel**.

I used **Blade components** to build the frontend, making the templates easy to reuse. I also created the backend to manage data, support multiple languages, and handle the shopping cart.


## Project Status

- **Project is discontinued and remains 80% complete.**
- **Last updated:** Jan 24, 2021.
- **PHP version:** 7.4
- **Laravel version:** 7.24

## Known Issues
- Stripe payment integration is not implemented.
- Some UI components may not be fully responsive.
- No automated tests are included.
- Translations for some static text are missing.


## Features

- **Shopping Cart:** Users can add products to their cart. Cart data is stored in both the session and the database.
- **Multi-Language Support:** The application is set up to support multiple languages.
- **Admin Panel:** The project includes an admin panel for managing the site.


## Screenshots
![Homepage](./web/screenshots/home.png)

---


![Shopping Cart](./web/screenshots/cart.png)

---


![Admin Panel - Product List](./web/screenshots/products.png)

---


![Admin Panel - Edit Product](./web/screenshots/edit.png)


## Setup

To run this project locally, follow these steps:

### Requirements
- **Docker**
- **PHP 7.4**
- **Laravel 7.x**

### Installation

1. **Clone the repository:**
```bash
  git clone git@github.com:spezia/laravel-furniture-catalog-client-project.git
```
2. **Configuration:**

[Laravel 7 documentation](https://laravel.com/docs/7.x/installation#configuration)

 If you want to run the project using Docker, create a **.env** file in the root directory and configure the database settings as follows:

```
APP_NAME=Laravel
APP_KEY=base64:nlBWj2cemHj0YG9ctE9tov/UjQEOHAqpWfylqcydj/k=
APP_URL=http://app.local:8000/

LOG_CHANNEL=stack

DB_CONNECTION=mysql
DB_HOST=dbmysql
DB_PORT=3306
DB_DATABASE=konstantin
DB_USERNAME=dbuser
DB_PASSWORD=dbpass
...

```

Update your hosts file

```
127.0.0.1   app.local
```

and run

```
sh start.sh
```

To stop the Docker containers, run

```
sh stop.sh
```

If you use Docker you can start the app

```
http://app.local:8000

http://app.local:8000/admin/home

```

  **Admin login credentials:**
  - **Email:** mobex@example.net
  - **Password:** wirtesten

## License

[MIT](./LICENSE)
