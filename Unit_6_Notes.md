# Unit VI: Getting Started with Databases, MongoDB & Rest APIs

This study guide explains database interaction in Laravel, including migrations, model creation, query builder operations, database seeding, integration with MongoDB, Eloquent ORM CRUD operations, and REST API implementation.

---

## 1. Model Creation

A **Model** is a PHP class that represents a database table. In Laravel, every database table has a corresponding model that is used to interact with that table.

### A. Creating a Model
Use the Artisan command to create a new model:
```bash
php artisan make:model Product
```
*Models are stored in the [app/Models/](file:///c:/Users/anshu/OneDrive/Desktop/Laravel/Chapter_1/app/Models) directory.*

### B. Creating a Model and Migration together (Recommended)
You can generate a database migration at the same time by adding the `-m` flag:
```bash
php artisan make:model Product -m
```

### C. Configuring the Model
By default, Laravel assumes the table name is the plural form of the model class name (e.g., `Product` model maps to `products` table). You can customize this and other parameters inside the Model class:
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Customize table name
    protected $table = 'my_products';

    // Customize primary key column (default is 'id')
    protected $primaryKey = 'product_id';

    // Disable timestamps ('created_at' and 'updated_at')
    public $timestamps = false;

    // Define columns allowed for mass assignment
    protected $fillable = ['name', 'description', 'price'];
}
```

---

## 2. Database Migrations

Migrations are like version control for your database, allowing your team to define and modify the application's database schema in PHP.

### A. Creating a Migration
Generate a migration file using Artisan:
```bash
php artisan make:migration create_products_table
```
*Migration files are stored in the `database/migrations/` directory.*

### B. Migration Structure
Every migration file contains an `up()` method (to create/modify tables) and a `down()` method (to reverse the action).
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Primary key (auto-increment)
            $table->string('name'); // VARCHAR column
            $table->text('description')->nullable(); // TEXT column (optional)
            $table->decimal('price', 8, 2); // DECIMAL column
            $table->timestamps(); // Adds created_at and updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
```

### C. Migration Commands
* **Run migrations:** Runs all outstanding migrations.
  ```bash
  php artisan migrate
  ```
* **Rollback migrations:** Reverses the last batch of migrations.
  ```bash
  php artisan migrate:rollback
  ```
* **Reset Database:** Drops all tables and re-runs all migrations from the beginning.
  ```bash
  php artisan migrate:fresh
  ```

---

## 3. CRUD using Query Builder

Laravel's **Query Builder** provides a clean PHP interface for creating and running database queries. It uses the `DB` facade.

```php
use Illuminate\Support\Facades\DB;
```

### A. CREATE (Insert)
```php
DB::table('users')->insert([
    'name' => 'Anshuman',
    'email' => 'anshuman@example.com',
    'created_at' => now(),
]);
```

### B. READ (Select)
* **Retrieve all records:**
  ```php
  $users = DB::table('users')->get();
  ```
* **Retrieve a single record:**
  ```php
  $user = DB::table('users')->where('id', 1)->first();
  ```
* **Filtering and specific columns selection:**
  ```php
  $activeUsers = DB::table('users')
                  ->select('name', 'email')
                  ->where('status', 'active')
                  ->get();
  ```

### C. UPDATE
```php
DB::table('users')
    ->where('id', 1)
    ->update(['name' => 'Anshuman Kumar']);
```

### D. DELETE
```php
DB::table('users')
    ->where('id', 1)
    ->delete();
```

---

## 4. Database Seeding

Seeders allow you to populate your database tables with dummy/initial data for testing purposes.

### A. Creating a Seeder
```bash
php artisan make:seeder UserSeeder
```
*Seeder files are located in `database/seeders/`.*

### B. Defining Seeder Data
Open the created `UserSeeder.php` file and add the seed data inside the `run()` method:
```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Demo User',
            'email' => 'demo@example.com',
            'password' => bcrypt('password123'),
        ]);
    }
}
```

### C. Calling Seeders
You register all seeders inside the main `DatabaseSeeder.php` file:
```php
public function run(): void
{
    $this->call([
        UserSeeder::class,
    ]);
}
```
Run the seeding command in your terminal:
```bash
php artisan db:seed
```

---

## 5. Using MongoDB with Laravel

MongoDB is a popular NoSQL document database. You can integrate MongoDB with Laravel using the official community package: `mongodb/laravel-mongodb`.

### A. Installation
Install the MongoDB integration via Composer:
```bash
composer require mongodb/laravel-mongodb
```

### B. Environment Configuration (`.env`)
Update the database connection details to match your MongoDB server:
```env
DB_CONNECTION=mongodb
MONGODB_URI=mongodb://127.0.0.1:27017
MONGODB_DATABASE=laravel_mongodb
```

### C. Database Configurations (`config/database.php`)
Register the mongodb connection:
```php
'connections' => [
    'mongodb' => [
        'driver' => 'mongodb',
        'dsn' => env('MONGODB_URI', 'mongodb://localhost:27017'),
        'database' => env('MONGODB_DATABASE', 'laravel'),
    ],
]
```

### D. MongoDB Model Setup
Instead of extending Laravel's standard Eloquent Model, your model must extend the MongoDB Eloquent Model:
```php
<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model; // Import MongoDB Model

class Article extends Model
{
    protected $connection = 'mongodb'; // Force using MongoDB connection
    protected $collection = 'articles'; // MongoDB equivalent of 'table'
    protected $fillable = ['title', 'content'];
}
```

---

## 6. CRUD using Eloquent ORM

Eloquent ORM is Laravel's built-in Active Record implementation. It allows you to perform database actions using PHP models instead of raw SQL or the Query Builder.

### A. CREATE
* **Method 1: Creating object instance:**
  ```php
  $user = new User;
  $user->name = 'Rahul';
  $user->email = 'rahul@example.com';
  $user->save();
  ```
* **Method 2: Mass Assignment (Requires `$fillable` array in Model):**
  ```php
  $user = User::create([
      'name' => 'Rahul',
      'email' => 'rahul@example.com',
  ]);
  ```

### B. READ
* **Retrieve all users:** `$users = User::all();`
* **Find a user by primary key:** `$user = User::find(1);`
* **Find a user or throw a 404 error if not found:** `$user = User::findOrFail(1);`
* **Filtering query:**
  ```php
  $users = User::where('status', 'active')
               ->orderBy('name', 'asc')
               ->take(10)
               ->get();
  ```

### C. UPDATE
Retrieve the model first, modify attributes, and save:
```php
$user = User::find(1);
$user->email = 'new_email@example.com';
$user->save();
```

### D. DELETE
```php
// Method 1: Retrieve and delete
$user = User::find(1);
$user->delete();

// Method 2: Delete by primary keys directly
User::destroy(1);
User::destroy([1, 2, 3]);
```

---

## 7. Implementing REST APIs

REST APIs allow external clients (Mobile apps, React/Vue frontends) to communicate with your backend using JSON data.

### A. Route Registration (`routes/api.php`)
API routes do not use session state or CSRF tokens. They are defined in the `routes/api.php` file and are automatically prefixed with `/api` (e.g., `/api/products`).

```php
use App\Http\Controllers\Api\ProductController;

Route::apiResource('products', ProductController::class);
```

### B. Creating an API Controller
API controllers do not require HTML view rendering methods like `create()` or `edit()`. Create one using Artisan:
```bash
php artisan make:controller Api/ProductController --api
```

### C. REST API Controller Implementation Example:
```php
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // GET /api/products
    public function index()
    {
        $products = Product::all();
        return response()->json($products, 200);
    }

    // POST /api/products
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|numeric',
        ]);

        $product = Product::create($validated);
        
        return response()->json([
            'message' => 'Product Created Successfully!',
            'data' => $product
        ], 21); // 201 Created
    }

    // GET /api/products/{id}
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product, 200);
    }

    // PUT/PATCH /api/products/{id}
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'string|max:100',
            'price' => 'numeric',
        ]);

        $product->update($validated);

        return response()->json([
            'message' => 'Product Updated Successfully!',
            'data' => $product
        ], 200);
    }

    // DELETE /api/products/{id}
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted successfully!'], 200);
    }
}
```

---
*Created for study/reference on Laravel Class Notes.*
