<p align="center">
        <img src="https://banners.beyondco.de/inertiaTrans.png?theme=dark&packageManager=composer+require&packageName=iammarjamal%2Finertiatrans&pattern=architect&style=style_1&description=simple+translation+sync+between+Laravel+and+any+frontend+framework.&md=1&showWatermark=0&fontSize=150px&images=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg" width="100%" alt="inertiaTrans">
</p>

# InertiaTrans
inertiaTrans is a Laravel package for sync between Laravel and any frontend framework using inertia.js.
<br /><br />

## 📌 Requirements  
- **Laravel** `^12`  
- **Node.js** `^20`  
<br />

## 🚀 Installation  
You can install the package via Composer:

```bash
composer require iammarjamal/inertiatrans
```
<br />

## 📚 Usage  

### 1⃣ Start Install NPM Package
Run the following command in the terminal to install dependencies:

```bash
php artisan inertiaTrans:install
```

This watcher monitors Blade files and automatically extracts translatable text into Laravel's language files.
<br /><br />

### 2⃣ Define Translations in Blade Files  
You can now use `@useTheme()` and `@TransSFC()` in any Blade file within the `resources/views` directory.
<br />

## ✨ Example Usage  
```html
<div>
   ...
   <p>@useTheme('hello_world')</p>
</div>

@TransSFC('ar')
[
   'hello_world' => 'اهلاً بالعالم',
]
@endTransSFC

@TransSFC('en')
[
   'hello_world' => 'Hello World',
]
@endTransSFC
```
<br />

## 🔍 How It Works  
1. **Translating Text**:  
   - The `@useTheme('hello_world')` directive retrieves the corresponding translation for the active language.
   - The `@TransSFC('ar')` and `@TransSFC('en')` blocks define translations for Arabic (`ar`) and English (`en`).

2. **Automatic Language File Updates**:  
   - The watcher reads these Blade files and updates the Laravel language files.
   - Translations are stored in `lang/[lang]/app.php` using the format `[sfc.pathBladeFile.key]`.
<br />

## 📝 Example of the Generated Language File (`lang/en/app.php`)  
```php
return [
   'sfc.home.pages.index.hello_world' => 'Hello World',
];
```

This makes it easy to manage translations directly within Blade files while ensuring they are structured within Laravel's language system.
<br /><br />

## Credits  
- [iammarjamal](https://github.com/iammarjamal)
<br /><br />

## License  
The MIT License (MIT). Please see [License File](LICENSE) for more information.
