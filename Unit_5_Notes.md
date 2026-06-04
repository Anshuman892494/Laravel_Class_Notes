# Unit V: Laravel Form Validation

This study guide explains Laravel's form security measures (CSRF, Method Spoofing), input validation syntax, built-in validation rules, custom validation rules, handling error messages, and form repopulation.

---

## 1. CSRF (Cross-Site Request Forgery) Field

**CSRF** is an exploit where unauthorized commands are transmitted from a user that the web application trusts. Laravel automatically protects your application from CSRF attacks.

### A. How Laravel Handles CSRF:
Laravel generates a random CSRF security token for each active user session. When processing HTML forms, you must include a hidden token field. The framework's `VerifyCsrfToken` middleware will check if the token in the request matches the token stored in the user's session.

### B. Usage in Blade:
Simply place the `@csrf` directive inside your form:
```blade
<form method="POST" action="/register">
    @csrf
    <!-- Form Inputs -->
</form>
```
This is compiled into the following HTML:
```html
<input type="hidden" name="_token" value="aBcDeF1234567890xyz...">
```

---

## 2. Method Field (Method Spoofing)

HTML forms do not support HTTP verbs other than `GET` and `POST`. Therefore, when defining `PUT`, `PATCH`, or `DELETE` routes, you cannot define them directly in the `<form>` method attribute.

### A. Method Spoofing:
Laravel uses "Method Spoofing" to solve this. You define the form method as `POST`, and then inject the desired HTTP verb using the `@method` Blade directive.

### B. Usage in Blade:
```blade
<form action="/user/update/5" method="POST">
    @csrf
    @method('PUT') <!-- Spoofs the PUT request -->
    
    <input type="text" name="name" value="Anshuman">
    <button type="submit">Update</button>
</form>
```
This compiles into the following HTML:
```html
<input type="hidden" name="_method" value="PUT">
```

---

## 3. Laravel Form Validation

Validation is the process of ensuring that user input is clean, secure, and meets formatting requirements before storing it in the database.

### A. The `$request->validate()` Method:
You can call the `validate` method directly on the incoming `Request` object in your controller. If validation fails, Laravel automatically redirects the user back to their previous location with the error messages and old inputs flashed to the session.

### B. Controller Validation Example:
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request)
    {
        // Validate incoming request
        $validatedData = $request->validate([
            'username' => 'required|string|max:50|unique:users',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed', // Must match password_confirmation field
        ]);

        // If validation passes, code continues...
        // Save user to database using $validatedData
        return redirect('/dashboard')->with('success', 'User registered successfully!');
    }
}
```

---

## 4. Built-in Validation Rules

Laravel contains dozens of built-in validation rules. Here are the most commonly used ones:

| Rule | Description | Example |
| :--- | :--- | :--- |
| `required` | Field must be present and not empty. | `'name' => 'required'` |
| `email` | Field must be a valid email format. | `'email' => 'email'` |
| `unique:table,column` | Field value must not exist in the DB table. | `'email' => 'unique:users,email'` |
| `min:value` | Minimum length (strings) or size (numeric/files). | `'password' => 'min:8'` |
| `max:value` | Maximum length (strings) or size (numeric/files). | `'bio' => 'max:255'` |
| `numeric` | Field must be a number (integer or float). | `'age' => 'numeric'` |
| `confirmed` | Field must match another field named `{field}_confirmation`. | `'password' => 'confirmed'` |
| `nullable` | Field can be empty or null (useful for optional inputs). | `'phone' => 'nullable\|numeric'` |

*Note: You can write multiple rules separated by a pipe `|` (e.g., `'required|email'`) or as an array (e.g., `['required', 'email']`).*

---

## 5. Displaying Error Messages

If validation fails, the `$errors` variable is shared with all your views automatically. It is an instance of `MessageBag`, which contains error messages.

### A. Displaying All Errors at the Top:
```blade
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
```

### B. Displaying a Field-Specific Error (Recommended):
Use the `@error` directive to target a specific field:
```blade
<div class="form-group">
    <label for="email">Email Address</label>
    <input type="text" name="email" id="email" class="@error('email') is-invalid @enderror">
    
    @error('email')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
```
*(The `$message` variable is automatically loaded with the specific validation error message for that field).*

---

## 6. Custom Validation Rules

When the built-in rules do not meet your business requirements, you can write custom validation rules.

### A. Creating a Custom Rule Class:
Generate a new rule class using Artisan:
```bash
php artisan make:rule Uppercase
```
This generates the class in `app/Rules/Uppercase.php`.

### B. Implementation:
Edit the generated rule to check if the input is uppercase:
```php
<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Uppercase implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (strtoupper($value) !== $value) {
            $fail('The :attribute must be uppercase.');
        }
    }
}
```

### C. Using the Custom Rule in a Controller:
Instantiate the rule class in the validation array:
```php
use App\Rules\Uppercase;

$request->validate([
    'username' => ['required', 'string', new Uppercase],
]);
```

---

## 7. Repopulating Forms (Old Input)

When validation fails, users are sent back to the form page. You should always repopulate the form fields so the user doesn't have to re-type everything.

* **Text Inputs / Textarea:**
  ```html
  <input type="text" name="username" value="{{ old('username') }}">
  <textarea name="bio">{{ old('bio') }}</textarea>
  ```
* **Select Dropdown:**
  ```html
  <select name="country">
      <option value="IN" {{ old('country') == 'IN' ? 'selected' : '' }}>India</option>
      <option value="US" {{ old('country') == 'US' ? 'selected' : '' }}>USA</option>
  </select>
  ```
* **Checkbox / Radio Buttons:**
  ```html
  <input type="checkbox" name="agree" value="1" {{ old('agree') ? 'checked' : '' }}> Agree to Terms
  ```

---
*Created for study/reference on Laravel Class Notes.*
