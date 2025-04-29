<p align="center">
  <img src="https://banners.beyondco.de/inertiaTrans.png?theme=dark&packageManager=composer+require&packageName=iammarjamal%2Finertiatrans&pattern=architect&style=style_1&description=simple+translation+sync+between+Laravel+and+any+frontend+framework.&md=1&showWatermark=0&fontSize=150px&images=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg"
       alt="InertiaTrans" width="100%" />
</p>

## Overview
**InertiaTrans** is a Laravel package that synchronizes your Laravel translation files with any JavaScript front-end framework. Continue to maintain your translations in `lang/**` as usual, and InertiaTrans will convert them into a JavaScript-friendly format on each page load.


## Requirements
- **Laravel** ```^12```
- **Node.js** ```^20```  


## 🚀 Installation

1. Install via Composer:  
   ```bash
   composer require iammarjamal/inertiatrans
   ```
2. Publish and install the NPM dependencies:  
   ```bash
   php artisan inertiaTrans:install
   ```
   

## 📚 Usage

### 1. Add the Blade directive

In your main Blade layout (e.g. `resources/views/app.blade.php`), include the `@inertiaTrans` directive inside `<head>`:

```blade
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    @viteReactRefresh
    @vite([
        'resources/js/app.jsx',
        "resources/js/pages/{$page['component']}.jsx"
    ])
    @inertiaHead

    {{-- Include translations as a JS object --}}
    @inertiaTrans
</head>
<body class="bg-white dark:bg-black text-gray-800 flex items-center justify-center min-h-screen p-6 lg:p-8">
    @inertia
</body>
</html>
```

### 2. Use translations in your front-end

#### React Example

```jsx
import { __, trans } from 'inertia-translations';

export default function Welcome() {
  return (
    <div>
      <h1 className="text-3xl font-bold">
        { trans("app.HelloWorld") }
      </h1>
      <h1 className="text-3xl font-bold">
        { __("app.HelloWorld") }
      </h1>
    </div>
  );
}
```

#### Vue Example

```vue
<script setup>
import { __, trans } from 'inertia-translations';
</script>

<template>
  <div>
    <h1>{{ trans("app.HelloWorld") }}</h1>
    <h1>{{ __("app.HelloWorld") }}</h1>
  </div>
</template>
```

## 🔍 How It Works

1. **Laravel translations**  
   - You keep your translation files in `lang/**` as usual.  
   - The `@inertiaTrans` directive gathers them and injects a single JavaScript object into your page.

2. **Caching in Production**  
   - In `APP_ENV=production`, translations are cached for performance.  
   - After updating any translation file, run:
     ```bash
     php artisan optimize:clear
     ```
     to clear the cache and load the latest strings.
     

## ✨ Credits
- **Creator:** [iammarjamal](https://github.com/iammarjamal)


## 📄 License
This package is released under the MIT License. See the [LICENSE](LICENSE) file for details.
