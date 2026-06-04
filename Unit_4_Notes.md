# Unit IV: URL Generation, Request Data, Emails, Localization & Sessions

This study guide covers how to retrieve input data, handle file uploads, configure and send emails, implement multi-language support (localization), and manage user sessions.

---

## 1. Request Data

When a user submits a form or requests a page, they send input data. Laravel's `Illuminate\Http\Request` class provides methods to inspect and retrieve this data.

### A. Retrieving Input
* **Retrieving All Input:** Returns an array of all input data.
  ```php
  $input = $request->all();
  ```
* **Retrieving Individual Values:**
  ```php
  // Get a specific value (returns null if not present)
  $name = $request->input('name');
  
  // Get a value with a default fallback
  $name = $request->input('name', 'Anonymous');
  
  // Direct property access
  $name = $request->name;
  ```
* **Retrieving Query String Values:** (Data from URLs like `?page=2`)
  ```php
  $page = $request->query('page');
  ```
* **Determining Input Existence:**
  ```php
  // Checks if the value is present in the request
  if ($request->has('email')) { ... }
  
  // Checks if the value is present and is NOT empty
  if ($request->filled('email')) { ... }
  ```

### B. Old Input
Laravel allows you to keep input from the current request during the next request. This is commonly used to repopulate forms after validation fails.

* **Flashing Input to Session:**
  ```php
  // Flash all inputs to the session
  $request->flash();
  
  // Flash only specific inputs
  $request->flashOnly(['username', 'email']);
  ```
* **Retrieving Old Input in Blade:**
  Use the global `old()` helper inside form fields:
  ```html
  <input type="text" name="username" value="{{ old('username') }}">
  ```

### C. Uploaded Files
Laravel makes handling file uploads simple using the `file` method or direct property access.

* **Retrieving Uploaded File:**
  ```php
  $file = $request->file('photo');
  // OR
  $file = $request->photo;
  ```
* **Checking If File Existed and Is Valid:**
  ```php
  if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
      // File exists and was uploaded successfully
  }
  ```
* **Storing Uploaded Files:**
  By default, files are stored in the local `storage/app` directory.
  ```php
  // Stores in a directory called 'photos' with a random unique name
  $path = $request->photo->store('photos');
  
  // Stores file with a custom name
  $path = $request->photo->storeAs('photos', 'profile_picture.jpg');
  ```

### D. Cookies
* **Retrieving Cookies:**
  ```php
  $value = $request->cookie('name');
  ```
* **Attaching Cookies to Outgoing Responses:**
  ```php
  return response('Hello')->cookie('name', 'value', $minutes);
  ```

---

## 2. Sending Emails

Laravel provides a clean, simple email API powered by the Symfony Mailer component.

### A. Mail Configuration
Mail configuration is done inside the `.env` file using SMTP settings:
```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### B. Creating a Mailable
In Laravel, each email sent by your application is represented as a "Mailable" class. Create one using Artisan:
```bash
php artisan make:mail OrderShipped
```
This generates the class in `app/Mail/OrderShipped.php`.

### C. Structure of a Mailable Class
A Mailable class contains methods to configure the email envelope, contents, and attachments.
```php
<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    public $order; // Public variables are automatically available in the mail view

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Order Has Shipped!',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.orders.shipped', // Points to resources/views/emails/orders/shipped.blade.php
        );
    }
}
```

### D. Sending the Email
To send the email, use the `Mail` facade:
```php
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;

Route::get('/send-email', function () {
    $order = ['id' => 1024, 'total' => '$150.00'];
    
    Mail::to('customer@example.com')->send(new OrderShipped($order));
    
    return 'Email Sent!';
});
```

---

## 3. Laravel Localization

Localization allows your application to support multiple languages.

### A. Translation Files Directory
Translation strings are stored in files within the `lang` (or `resources/lang`) directory.
For example:
* `lang/en/messages.php`
* `lang/es/messages.php`

### B. Creating Translation Files
Each translation file returns an array of keyed strings:
```php
// lang/en/messages.php
return [
    'welcome' => 'Welcome to our application!',
    'login' => 'Please log in.',
];
```
```php
// lang/es/messages.php
return [
    'welcome' => '¡Bienvenido a nuestra aplicación!',
    'login' => 'Por favor inicia sesión.',
];
```

### C. Displaying Translated Strings in Blade
Use the `__` helper function to print translated lines:
```blade
<h1>{{ __('messages.welcome') }}</h1>
<p>{{ __('messages.login') }}</p>
```

### D. Changing Locale Dynamically
By default, the application language is set in `config/app.php` (`'locale' => 'en'`).
You can change the language dynamically at runtime:
```php
use Illuminate\Support\Facades\App;

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'es'])) {
        App::setLocale($locale);
        session()->put('locale', $locale); // Keep the preference in user session
    }
    return redirect()->back();
});
```

---

## 4. Laravel Sessions

HTTP is stateless. Sessions provide a way to store information about the user across multiple requests.

### A. Configuration
Session options are located in `config/session.php`. The default driver is `file`, but for production databases, `database`, `redis`, or `memcached` are commonly used.

### B. Accessing Session Data

#### 1. Via Request Instance:
```php
Route::get('/session-get', function (Request $request) {
    $name = $request->session()->get('user_name');
    
    // With default fallback value
    $role = $request->session()->get('role', 'Guest');
    
    return $name;
});
```

#### 2. Via Global Helper:
```php
// Get a key
$name = session('user_name');

// Get a key with a default
$role = session('role', 'Guest');
```

### C. Storing Session Data

#### 1. Put (Persistent for Session):
Stores a key/value pair in the session database/file.
```php
// Via Request instance
$request->session()->put('user_id', 42);

// Via Global helper
session(['user_role' => 'Administrator']);
```

#### 2. Flash (One-time use):
Stores the data *only* for the next HTTP request. Useful for status alerts.
```php
$request->session()->flash('status', 'Profile updated successfully!');
```
*In Blade, you check and display it:*
```blade
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
```

### D. Deleting Session Data

#### 1. Forget (Delete Specific Key):
```php
// Remove a single key
$request->session()->forget('user_role');

// Remove multiple keys
$request->session()->forget(['user_role', 'user_id']);
```

#### 2. Pull (Get & Then Delete):
Retrieves the value of a key and removes it from the session immediately.
```php
$role = $request->session()->pull('user_role', 'default');
```

#### 3. Flush (Delete Everything):
Clears all session variables.
```php
$request->session()->flush();
```

---
*Created for study/reference on Laravel Class Notes.*
