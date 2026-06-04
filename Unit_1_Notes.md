# Unit I: Getting Started with MVC Laravel Framework

This study guide covers the fundamental concepts of Laravel, MVC architecture, Composer, installation, directory structure, and the Artisan command-line tool.

---

## 1. What is MVC Framework?

**MVC (Model-View-Controller)** is a software architectural pattern that separates an application into three main interconnected components. This separation of concerns helps in organizing code, making it modular, scalable, and easy to maintain.

```
       +--------------------------------------------+
       |                  USER                      |
       +-----------------+------------------^-------+
                         |                  |
                 (1) HTTP Request    (6) HTML Response
                         |                  |
                         v                  |
               +-------------------+        |
               |      Routing      |        |
               +---------+---------+        |
                         |                  |
                  (2) Forward               |
                         |                  |
                         v                  |
               +-------------------+        |
               |    CONTROLLER     +--------+
               +----+-^-------+-^--+
                    | |       | |
       (3) Query/   | |       | | (5) Pass Data
       Update       | |       | | to View
                    v |       v |
               +------+----+ +--+-------+
               |   MODEL   | |   VIEW   |
               +-----------+ +----------+
```

### Components of MVC:
1. **Model (Data & Logic):**
   * **Role:** Manages the database, data validation, and business logic.
   * **In Laravel:** Models are located in the [app/Models](file:///c:/Users/anshu/OneDrive/Desktop/Laravel/Chapter_1/app/Models) directory. Laravel uses **Eloquent ORM** (Object-Relational Mapping) to interact with the database using PHP classes instead of writing raw SQL queries.
   * *Example:* If you have a `users` table, you will have a `User` model to retrieve, insert, and update user records.

2. **View (User Interface):**
   * **Role:** The visual representation of data (HTML, CSS, JS). It is what the user sees and interacts with.
   * **In Laravel:** Views are located in the [resources/views](file:///c:/Users/anshu/OneDrive/Desktop/Laravel/Chapter_1/resources/views) directory. Laravel uses the **Blade Templating Engine** (extension `.blade.php`) to create dynamic views easily.
   * *Example:* A login form, dashboard table, or landing page.

3. **Controller (Brain/Bridge):**
   * **Role:** Acts as an intermediary between Model and View. It handles user requests (via routes), fetches data using the Model, processes it, and passes it to the View.
   * **In Laravel:** Controllers are located in the [app/Http/Controllers](file:///c:/Users/anshu/OneDrive/Desktop/Laravel/Chapter_1/app/Http/Controllers) directory.
   * *Example:* A `UserController` handles the request to view a profile, fetches profile data via the `User` model, and renders the `profile.blade.php` view with that data.

### Advantages of MVC:
* **Separation of Concerns:** Frontend code (HTML/CSS) is separated from backend logic (PHP/SQL).
* **Code Reusability:** Models can be reused across different views or controllers.
* **Easy Maintenance:** Changes in the user interface (View) do not affect the underlying business logic (Model).
* **Parallel Development:** Different developers can work on the Model, View, and Controller simultaneously.

---

## 2. Overview of Laravel Framework and its Features

**Laravel** is a free, open-source PHP web framework created by **Taylor Otwell** in 2011. It follows the MVC architectural pattern and is designed for building web applications rapidly by handling common tasks such as routing, authentication, sessions, and caching.

### Key Features of Laravel:
* **Eloquent ORM (Object-Relational Mapping):** Allows database interaction using simple PHP objects. Every table has a corresponding Model class.
* **Blade Templating Engine:** A powerful yet lightweight template engine that provides control structures (like loops and conditionals) and template inheritance without adding overhead.
* **Artisan CLI:** A built-in command-line tool that automates repetitive development tasks (creating controllers, models, migrations, clearing cache, etc.).
* **Routing System:** Intuitive and clean routing system where URLs are mapped to specific controller actions (defined in the [routes/](file:///c:/Users/anshu/OneDrive/Desktop/Laravel/Chapter_1/routes) directory).
* **Database Migrations & Seeders:** Version control for your database schema. Allows you to define tables and columns in PHP code and share schema changes easily across a team. Seeders allow you to populate the database with test data.
* **Built-in Security:** Automatically protects applications against:
  * **CSRF (Cross-Site Request Forgery):** Requires token validation for form submissions.
  * **SQL Injection:** Eloquent uses PDO parameter binding to prevent malicious queries.
  * **XSS (Cross-Site Scripting):** Blade templates automatically escape variables printed with `{{ $variable }}`.
* **Authentication and Authorization:** Out-of-the-box configuration for user login, registration, password resets, and role-based permissions (via Gates/Policies).

---

## 3. Introduction to Composer

**Composer** is a dependency management tool for PHP. It allows you to declare the libraries your project depends on, and it will install, update, and manage them for you.

### Key Concepts:
* **Dependency Manager vs. Package Manager:** Unlike globally installed package managers (like `apt` or `yum` in Linux), Composer manages packages on a **per-project basis** by default, storing them inside a `vendor/` directory inside your project.
* **composer.json:** A file at the root of the project that lists the dependencies (packages) required by the project. You can inspect your project's dependencies in [composer.json](file:///c:/Users/anshu/OneDrive/Desktop/Laravel/Chapter_1/composer.json).
* **composer.lock:** Once dependencies are installed, Composer writes the exact versions installed to this file. This ensures that every developer working on the project, and the production server, uses the exact same versions of all packages.
* **Autoloading:** Composer automatically generates an autoloader file (`vendor/autoload.php`). When you include this file, you can use any class in your dependencies without writing manual `include` or `require` statements.

---

## 4. Latest Composer Installation (Windows)

To install the latest version of Composer on Windows, follow these steps:

### Prerequisites:
* PHP must be installed on your system and added to your system's `PATH` variable. (Usually done via XAMPP, WAMP, or Laragon).

### Installation Steps:
1. **Download the Installer:**
   * Go to the official Composer website: [getcomposer.org](https://getcomposer.org/).
   * Download and run the **`Composer-Setup.exe`** installer.
2. **Run the Installer:**
   * Choose **"Install for all users"** (recommended).
   * The installer will ask you to locate your PHP executable (`php.exe`). If you are using XAMPP, this is typically at `C:\xampp\php\php.exe`.
   * (Optional) Specify proxy settings if needed.
3. **Verify the Path:**
   * The installer automatically adds Composer to your system environment variables.
4. **Complete and Restart:**
   * Finish the wizard and restart any open Terminal or Command Prompt window.
5. **Verify Installation:**
   * Open your command prompt/terminal and run:
     ```bash
     composer --version
     ```
   * You should see output showing the installed version (e.g., `Composer version 2.x.x`).

---

## 5. Latest Laravel Installation

Once Composer is installed, you can create a new Laravel project using either of the following methods:

### Method A: Using the Laravel Installer (Recommended)
This method installs the Laravel installer globally, allowing you to create new projects quickly using the `laravel` command.

1. **Install Laravel Installer Globally:**
   ```bash
   composer global require laravel/installer
   ```
2. **Ensure global composer bin is in your System PATH:**
   * On Windows: `%USERPROFILE%\AppData\Roaming\Composer\vendor\bin` must be added to your system's `Path` environment variables.
3. **Create a New Project:**
   ```bash
   laravel new my-app
   ```
   * This command will prompt you to choose your starter kit (Blade, React, Vue, etc.) and your preferred database.

### Method B: Using Composer's `create-project` Command
This is a direct command that downloads the latest version of Laravel and sets up the project structure. No global installer required.

1. **Run the Command:**
   ```bash
   composer create-project laravel/laravel my-app
   ```
   * Replace `my-app` with your preferred project folder name.

### Running the Laravel Application:
1. Navigate into the project folder:
   ```bash
   cd my-app
   ```
2. Start the local development server:
   ```bash
   php artisan serve
   ```
3. Open your browser and navigate to `http://127.0.0.1:8000`. You will see the default Laravel welcome page.

---

## 6. Directory / Application Structure

A standard Laravel project consists of several files and folders. Let's look at the structure of a Laravel project:

* **`app/`**: The core of your application. Contains the business logic.
  * [app/Http/Controllers/](file:///c:/Users/anshu/OneDrive/Desktop/Laravel/Chapter_1/app/Http/Controllers): Holds controllers that handle routing logic.
  * [app/Http/Middleware/](file:///c:/Users/anshu/OneDrive/Desktop/Laravel/Chapter_1/app/Http/Middleware): Holds middleware (runs before/after requests, e.g. authentication checking).
  * [app/Models/](file:///c:/Users/anshu/OneDrive/Desktop/Laravel/Chapter_1/app/Models): Holds your Eloquent models (database interaction).
  * [app/Providers/](file:///c:/Users/anshu/OneDrive/Desktop/Laravel/Chapter_1/app/Providers): Contains service providers that bootstrap application components.
* **`bootstrap/`**: Contains the [app.php](file:///c:/Users/anshu/OneDrive/Desktop/Laravel/Chapter_1/bootstrap/app.php) file which bootstraps the framework. It also holds a `cache/` directory containing framework-generated files for performance optimization.
* **`config/`**: Contains configuration files for database, mail, app, services, session, etc.
* **`database/`**: Contains database-related files:
  * `migrations/`: DB schema definition files.
  * `seeders/`: DB seeder files to populate records.
  * `factories/`: Generates dummy data for testing.
* **`public/`**: The web root directory. Contains `index.php` (entry point for all requests) and assets like CSS, JavaScript, and images.
* **`resources/`**: Contains assets that are compiled or rendered:
  * `views/`: Contains Blade template files (HTML views).
  * `css/` & `js/`: Uncompiled stylesheets and script files.
* **`routes/`**: Contains route definitions for the application:
  * `web.php`: Routes for web interface (uses sessions, CSRF protection).
  * `api.php`: Routes for API endpoints (stateless, uses token auth).
  * `console.php`: Defines custom Artisan command closures.
* **`storage/`**: Contains logs, compiled Blade templates, file uploads, and session files. It must be writeable by the web server.
* **`tests/`**: Contains automated test files (Unit and Feature tests).
* **`vendor/`**: Contains all external PHP packages installed by Composer. *Do not modify files inside this folder.*
* **`.env`**: Configuration file containing environment-specific variables like database credentials (`DB_DATABASE`, `DB_USERNAME`), App Key, Mail Server configs, etc.

---

## 7. Artisan

**Artisan** is the built-in Command Line Interface (CLI) included with Laravel. It provides helpful commands to assist you in building your application.

* The executable script is located at the root of your project: [artisan](file:///c:/Users/anshu/OneDrive/Desktop/Laravel/Chapter_1/artisan).
* You execute Artisan commands from your command line using `php artisan <command>`.

### Common and Useful Artisan Commands:

| Command | Description |
| :--- | :--- |
| `php artisan help` | Displays help information for any command. |
| `php artisan list` | Lists all available Artisan commands. |
| `php artisan serve` | Starts the local PHP development server. |
| `php artisan make:controller <Name>` | Generates a new Controller class in `app/Http/Controllers/`. |
| `php artisan make:model <Name>` | Generates a new Eloquent Model class in `app/Models/`. |
| `php artisan make:migration <Name>` | Generates a database migration file in `database/migrations/`. |
| `php artisan migrate` | Runs the pending database migrations (creates/updates tables). |
| `php artisan migrate:rollback` | Rolls back the latest database migration batch. |
| `php artisan make:middleware <Name>` | Generates a new Middleware class. |
| `php artisan route:list` | Lists all registered routes in the application. |
| `php artisan tinker` | Starts an interactive REPL shell to test PHP code and interact with database models directly. |
| `php artisan cache:clear` | Clears the application cache. |
| `php artisan key:generate` | Generates the `APP_KEY` in your `.env` file (used for encryption). |

---
*Created for study/reference on Laravel Class Notes.*
