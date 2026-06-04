# Unit III: Controllers, Blade and Advanced Routing

This study guide explains the creation and usage of basic and resource controllers, the details of the Blade templating engine, advanced routing features, and URL generation helpers.

---

## 1. Basic Controllers

Controllers group related request-handling logic into a single class. They are stored in the [app/Http/Controllers/](file:///c:/Users/anshu/OneDrive/Desktop/Laravel/Chapter_1/app/Http/Controllers) directory.

### A. Creating a Controller
You can create a new controller using the Artisan command:
```bash
php artisan make:controller UserController
```
This generates a basic controller class:
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id)
    {
        return view('user.profile', ['user' => $id]);
    }
}
```

### B. Controller Routing
To map a route to a controller's method, pass an array containing the controller's class and the method name to the route definition:
```php
use App\Http\Controllers\UserController;

Route::get('/user/{id}', [UserController::class, 'show']);
```

### C. Controller Middleware
Middleware may be assigned to the controller's routes in your route files:
```php
Route::get('/profile', [UserController::class, 'show'])->middleware('auth');
```
Alternatively, in Laravel 11/10, controllers can implement the `HasMiddleware` interface or you can define middleware grouping in your routes.

---

## 2. Restful Resource Controllers

A Resource Controller generates routes for all common CRUD (Create, Read, Update, Delete) actions with a single line of code.

### A. Creating a Resource Controller
Add the `--resource` option to the `make:controller` command:
```bash
php artisan make:controller PostController --resource
```
This generates 7 default methods in your controller:
* `index()` - Display a listing of the resource.
* `create()` - Show the form for creating a new resource.
* `store()` - Store a newly created resource in storage.
* `show($id)` - Display the specified resource.
* `edit($id)` - Show the form for editing the specified resource.
* `update(Request $request, $id)` - Update the specified resource in storage.
* `destroy($id)` - Remove the specified resource from storage.

### B. Registering a Resource Route
Instead of writing 7 separate routes, use `Route::resource()` in your routes file:
```php
use App\Http\Controllers\PostController;

Route::resource('posts', PostController::class);
```

#### Resource Route Map:
| Verb | URI | Action | Route Name |
| :--- | :--- | :--- | :--- |
| GET | `/posts` | index | `posts.index` |
| GET | `/posts/create` | create | `posts.create` |
| POST | `/posts` | store | `posts.store` |
| GET | `/posts/{post}` | show | `posts.show` |
| GET | `/posts/{post}/edit` | edit | `posts.edit` |
| PUT/PATCH | `/posts/{post}` | update | `posts.update` |
| DELETE | `/posts/{post}` | destroy | `posts.destroy` |

---

## 3. Blade Templating Engine

Blade is the simple yet powerful templating engine provided with Laravel. Blade views are compiled into plain PHP code and cached until they are modified.

### A. PHP Output
To display variables or PHP expressions, use curly braces:
* **Escaped Output (Safe):** Uses `htmlspecialchars` to prevent XSS attacks.
  ```html
  Hello, {{ $name }}
  ```
* **Raw Output (Unescaped):** Use when you need to render HTML code stored in variables.
  ```html
  {!! $htmlContent !!}
  ```

### B. Control Structures (Conditional & Loop Directives)

#### 1. Conditionals:
* **@if / @else:**
  ```blade
  @if ($role == 'admin')
      <p>Welcome Admin!</p>
  @elseif ($role == 'manager')
      <p>Welcome Manager!</p>
  @else
      <p>Welcome User!</p>
  @endif
  ```
* **@unless (Equivalent to `if (!...)`):**
  ```blade
  @unless (Auth::check())
      <p>Please log in.</p>
  @endunless
  ```
* **Checking Variable Status:**
  * `@isset($var)` ... `@endisset`
  * `@empty($var)` ... `@endempty`

#### 2. Loops:
* **@foreach (Most common for arrays/collections):**
  ```blade
  @foreach ($users as $user)
      <li>{{ $user->name }}</li>
  @endforeach
  ```
* **@forelse (Combines `@foreach` and `@empty` check):**
  ```blade
  @forelse ($users as $user)
      <li>{{ $user->name }}</li>
  @empty
      <p>No users found.</p>
  @endforelse
  ```

### C. Template Inheritance

Template inheritance allows you to create a master layout containing the design shell (header, sidebar, footer) and extend it in other child views.

#### 1. Defining a Layout (`resources/views/layouts/app.blade.php`):
```blade
<!DOCTYPE html>
<html>
<head>
    <title>My Site - @yield('title')</title>
</head>
<body>
    <header>Site Header</header>

    <div class="content">
        @yield('content') <!-- Placeholder for child content -->
    </div>

    <footer>Site Footer</footer>
</body>
</html>
```

#### 2. Extending a Layout in a Child View (`resources/views/home.blade.php`):
```blade
@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
    <h1>Welcome to the Home Page</h1>
    <p>This is the page content loaded dynamically into the layout.</p>
@endsection
```

---

## 4. Advanced Routing

Laravel offers advanced options for structuring, filtering, and securing application endpoints.

### A. Named Routes
Names allow you to generate URLs or redirects easily:
```php
Route::get('/user/profile', [UserProfileController::class, 'show'])->name('profile');
```

### B. Secure Routes (HTTPS/SSL)
You can enforce HTTPS on certain routes or generate secure URLs:
```php
// Generate absolute HTTPS URL
$url = secure_url('user/profile');
```
*Note: In production, forcing HTTPS is usually done using middleware or web server configurations (Apache/Nginx).*

### C. Parameter Constraints
Apply pattern checks globally or locally on parameters:
```php
Route::get('/user/{id}', function ($id) { ... })->whereNumber('id');
Route::get('/user/{name}', function ($name) { ... })->whereAlpha('name');
```

### D. Route Groups & Prefixing
Route groups allow you to share route attributes, such as middleware, namespaces, or prefixes, across a large number of routes without needing to define them on each individual route.

```php
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    // Matches '/admin/dashboard'
    Route::get('/dashboard', [AdminController::class, 'index']);
    
    // Matches '/admin/users'
    Route::get('/users', [AdminController::class, 'users']);
});
```

### E. Domain Routing (Subdomain Routing)
Route groups can also be used to handle subdomain routing. Subdomains can be assigned route parameters just like route URIs:
```php
Route::domain('{account}.myapp.com')->group(function () {
    Route::get('/user/{id}', function ($account, $id) {
        return "Subdomain Account: $account, User ID: $id";
    });
});
```

---

## 5. URL Generation

Laravel provides helper functions to generate URLs for your application. This is useful when creating links in your HTML views.

### A. The Current URL
```php
// Get the current URL without query string
$current = url()->current();

// Get the current URL including query string
$full = url()->full();

// Get the URL of the previous request
$previous = url()->previous();
```

### B. Generating Framework URLs
* **URL Helper:** Generates an absolute path to the given URI.
  ```php
  // Returns: http://your-domain.com/posts/1
  $url = url('/posts/1');
  ```
* **Route Helper:** Generates a URL for a named route.
  ```php
  // Returns: http://your-domain.com/user/profile
  $url = route('profile');
  
  // With parameters
  $url = route('user.show', ['id' => 1]);
  ```
* **Action Helper:** Generates a URL for a controller action.
  ```php
  // Returns: http://your-domain.com/user/1
  $url = action([UserController::class, 'show'], ['id' => 1]);
  ```

### C. Asset URLs
Assets (images, CSS, JavaScript files) are stored in the [public/](file:///c:/Users/anshu/OneDrive/Desktop/Laravel/Chapter_1/public) folder. The `asset()` helper generates a URL for an asset:
```php
// Returns: http://your-domain.com/css/app.css
$url = asset('css/app.css');

// Returns: https://your-domain.com/js/app.js (using HTTPS)
$url = secure_asset('js/app.js');
```

---
*Created for study/reference on Laravel Class Notes.*
