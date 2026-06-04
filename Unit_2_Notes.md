# Unit II: Request, Routing & Responses

This study guide explains how Laravel processes HTTP requests, manages routing, renders views, passes data, and constructs different types of HTTP responses and redirections.

---

## 1. Laravel Request Lifecycle

The Request Lifecycle describes the journey an HTTP request takes from the moment it enters the application until the response is sent back to the user's browser. Understanding this is crucial for knowing where to write initialization logic, middleware, and core application code.

### The Steps in the Request Lifecycle:

```
                  +--------------------------------+
                  |      User HTTP Request         |
                  +----------------+---------------+
                                   |
                                   v
                  +--------------------------------+
                  |        public/index.php        |  <-- Entry Point
                  +----------------+---------------+
                                   |
                                   v
                  +--------------------------------+
                  |  vendor/autoload.php (Composer)|  <-- Load Dependencies
                  +----------------+---------------+
                                   |
                                   v
                  +--------------------------------+
                  |       bootstrap/app.php        |  <-- Bootstrap Framework
                  +----------------+---------------+
                                   |
                                   v
                  +--------------------------------+
                  |     HTTP Kernel (handle())     |  <-- Resolves Kernel
                  +----------------+---------------+
                                   |
                                   v
                  +--------------------------------+
                  |        Service Providers       |  <-- Register & Boot
                  +----------------+---------------+
                                   |
                                   v
                  +--------------------------------+
                  |           Middleware           |  <-- Filter Requests (Auth, CSRF)
                  +----------------+---------------+
                                   |
                                   v
                  +--------------------------------+
                  |       Routing & Controller     |  <-- Executes logic & retrieves DB data
                  +----------------+---------------+
                                   |
                                   v
                  +--------------------------------+
                  |            Response            |  <-- Sent back to client
                  +--------------------------------+
```

1. **Entry Point (`public/index.php`):**
   * All requests to the application are directed here by the web server (Apache/Nginx configuration).
   * It loads the Composer autoloader (`vendor/autoload.php`) and retrieves an instance of the Laravel application from `bootstrap/app.php`.

2. **HTTP / Console Kernels:**
   * The incoming request is sent to either the **HTTP Kernel** or the **Console Kernel** (depending on whether the request came from the browser or the command line).
   * The HTTP kernel defines a list of **Middleware** that the request must pass through before it can be processed (e.g., checking if the app is in maintenance mode, verifying CSRF tokens, reading sessions).

3. **Service Providers:**
   * One of the most important steps of bootstrapping is loading **Service Providers** (defined in configuration files).
   * Service Providers are responsible for bootstrapping all of Laravel's core components: database connection, queue, validation, and routing.
   * Every service provider has a `register()` method (to bind things into the Service Container) and a `boot()` method (to execute startup code).

4. **Routing:**
   * Once the application is bootstrapped and service providers are booted, the request is handed off to the router.
   * The Router dispatches the request to a route closure or a Controller action. It also runs any route-specific middleware.

5. **Response:**
   * The Controller or route closure returns a response (a view, JSON data, string, or redirection).
   * The response flows back through the HTTP Kernel and middleware stack (which can modify or add headers) and is finally sent back to the user's browser.

---

## 2. Basic Routing

Routes map URL paths to specific actions. In Laravel, web routes are defined in the [routes/web.php](file:///c:/Users/anshu/OneDrive/Desktop/Laravel/Chapter_1/routes/web.php) file.

### Supported HTTP Verbs:
```php
Route::get($uri, $callback);
Route::post($uri, $callback);
Route::put($uri, $callback);
Route::patch($uri, $callback);
Route::delete($uri, $callback);
Route::options($uri, $callback);
```

### Basic Route Examples:
```php
// Returning a simple string
Route::get('/welcome', function () {
    return 'Welcome to Laravel Class Notes!';
});

// Returning a view
Route::get('/', function () {
    return view('welcome');
});
```

---

## 3. Routing Parameters

Sometimes you need to capture segments of the URI within your route.

### A. Required Parameters
Required parameters are wrapped in curly braces `{}` and must consist of alphabetic characters. They are passed directly to the route closure or controller method in the order they are defined.

```php
Route::get('/user/{id}', function ($id) {
    return 'User ID: ' . $id;
});

// Multiple parameters
Route::get('/posts/{post_id}/comments/{comment_id}', function ($postId, $commentId) {
    return "Post: $postId, Comment: $commentId";
});
```

### B. Optional Parameters
If a parameter is not always required, you can make it optional by appending a `?` after the parameter name. You must provide a default value in the callback function.

```php
Route::get('/user/{name?}', function ($name = 'Guest') {
    return 'Hello ' . $name;
});
```

### C. Regular Expression Constraints
You can restrict the format of your route parameters using the `where` method on a route instance.

```php
// Parameter must be numeric
Route::get('/user/{id}', function ($id) {
    return 'User ID: ' . $id;
})->where('id', '[0-9]+');

// Parameter must be alphabetic
Route::get('/user/{name}', function ($name) {
    return 'User: ' . $name;
})->where('name', '[A-Za-z]+');

// Convenient helpers
Route::get('/user/{id}', function ($id) { ... })->whereNumber('id');
Route::get('/user/{name}', function ($name) { ... })->whereAlpha('name');
```

---

## 4. Understanding Views in Laravel

Views contain the HTML served by your application and separate your controller/application logic from your presentation logic.

* Views are stored in [resources/views](file:///c:/Users/anshu/OneDrive/Desktop/Laravel/Chapter_1/resources/views) directory.
* Laravel uses **Blade**, a templating engine that allows you to write plain PHP code alongside HTML. Blade templates end with the `.blade.php` extension.
* To render a view, use the global `view()` helper function:
  ```php
  Route::get('/', function () {
      return view('welcome'); // Renders resources/views/welcome.blade.php
  });
  ```
* For nested directories, use dot notation:
  ```php
  // Renders resources/views/admin/profile.blade.php
  return view('admin.profile');
  ```

---

## 5. Passing Data to Views

You can pass data to views in three main ways:

### Method 1: Using an Associative Array
Pass an array of data as the second argument to the `view()` function.
```php
Route::get('/profile', function () {
    return view('profile', [
        'name' => 'Anshuman',
        'role' => 'Administrator'
    ]);
});
```
*In the view (`profile.blade.php`), you access this data using `{{ $name }}` and `{{ $role }}`.*

### Method 2: Using the `with()` Method
```php
Route::get('/profile', function () {
    return view('profile')
            ->with('name', 'Anshuman')
            ->with('role', 'Administrator');
});
```

### Method 3: Using the `compact()` Function (Most Popular)
If you already have variables defined with the same names as the keys, use the PHP `compact()` function.
```php
Route::get('/profile', function () {
    $name = 'Anshuman';
    $role = 'Administrator';
    
    return view('profile', compact('name', 'role'));
});
```

---

## 6. Sharing Data with all Views

Sometimes you need to share a piece of data with **all** views rendered by your application (e.g., logged-in user information, site configurations, social media links).

You can achieve this using the `View::share` method within the `boot` method of a service provider (typically `AppServiceProvider.php` located in [app/Providers/](file:///c:/Users/anshu/OneDrive/Desktop/Laravel/Chapter_1/app/Providers)).

### Example Configuration:
In `app/Providers/AppServiceProvider.php`:
```php
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Sharing a variable name 'appName' with all views
        View::share('appName', 'My Laravel College Project');
    }
}
```
Now, `{{ $appName }}` will be accessible automatically in **any** `.blade.php` file across your application without explicitly passing it from routes or controllers.

---

## 7. Laravel Response

When a route or controller processes a request, it must return a response. Laravel converts simple strings and arrays into full HTTP response objects automatically.

### A. Attaching Headers to Responses
You can add custom HTTP headers to the response using the `header()` method. You can chain multiple headers together.

```php
Route::get('/custom-response', function () {
    return response('Hello World', 200)
            ->header('Content-Type', 'text/plain')
            ->header('X-Header-One', 'Header Value 1')
            ->header('X-Header-Two', 'Header Value 2');
});
```

### B. Attaching Cookies to Responses
You can attach cookies to the outgoing response using the `cookie()` method. By default, all cookies generated by Laravel are encrypted and signed so they cannot be modified by the client.

```php
Route::get('/set-cookie', function () {
    return response('Cookie has been set!')
            ->cookie('user_preference', 'dark_mode', 60); // name, value, minutes
});
```

### C. JSON Response
The `json` method automatically sets the `Content-Type` header to `application/json` and converts the given array to JSON using the `json_encode` PHP function.

```php
Route::get('/api/users', function () {
    return response()->json([
        'status' => 'Success',
        'data' => [
            ['id' => 1, 'name' => 'Anshuman'],
            ['id' => 2, 'name' => 'Rahul']
        ]
    ]);
});
```

---

## 8. Laravel Redirections

Redirect responses instruct the user's browser to navigate to a different URL.

### A. Simple Redirections
```php
// Redirects directly to a specific URL
Route::get('/old-url', function () {
    return redirect('/new-url');
});
```

### B. Redirecting to Named Routes
If your route has a name defined using the `name()` method, you can redirect to it using the `redirect()->route()` helper. This is useful because if you change the actual URL path later, you do not have to update all redirect statements.

```php
// 1. Defining a named route
Route::get('/dashboard/home', function () {
    return view('dashboard');
})->name('dashboard');

// 2. Redirecting to the named route
Route::get('/login-success', function () {
    return redirect()->route('dashboard');
});

// 3. Redirecting with route parameters
Route::get('/go-to-user/{id}', function ($id) {
    return redirect()->route('user.profile', ['id' => $id]);
});
```

### C. Redirecting to Controller Actions
You can also generate redirects to controller actions. To do this, pass the controller and action name to the `action` method.

```php
use App\Http\Controllers\UserController;

Route::get('/manage', function () {
    // Redirects to UserController's show method with dynamic parameter
    return redirect()->action([UserController::class, 'show'], ['id' => 1]);
});
```

---
*Created for study/reference on Laravel Class Notes.*
