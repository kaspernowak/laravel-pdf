<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Prerequisites

Before you begin, ensure you have the following installed:
- PHP >= 7.4
- Composer - Dependency Manager for PHP
- Node.js and npm (Node package manager)
- Required libraries for running Puppeteer:
```
sudo apt-get install libasound2 libatk-bridge2.0-0 libatk1.0-0 libatspi2.0-0 libc6 libcairo2 libcups2 libdbus-1-3 libdrm2 libexpat1 libgbm1 libglib2.0-0 libnspr4 libnss3 libpango-1.0-0 libpangocairo-1.0-0 libstdc++6 libuuid1 libx11-6 libx11-xcb1 libxcb-dri3-0 libxcb1 libxcomposite1 libxcursor1 libxdamage1 libxext6 libxfixes3 libxi6 libxkbcommon0 libxrandr2 libxrender1 libxshmfence1 libxss1 libxtst6
```



## Installation

1. **Clone the repository:**
   ```
   git clone https://github.com/your/repository.git
   cd repository
   ```

2. **Install nvm (Node Version Manager) from within your laravel project root as the vhost user**
    ```
    curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.7/install.sh | bash
    ```
    ```
    source ~/.bashrc
    ```
    ```
    nvm install node
    ```

3. **Install PHP dependencies:**
   ```
   composer install
   ```

4. **Install JavaScript dependencies:**
   ```
   npm install
   ```

5. **Copy .env.example to .env and modify according to your environment:**
   ```
   cp .env.example .env
   ```

6. **Generate application key:**
   ```
   php artisan key:generate
   ```

7. **Make sure your SQLite database is created**
   ```
   touch database/database.sqlite
   ```
8. **Run database migrations (make sure you have configured your database in .env before running the migrations):**
   ```
   php artisan migrate
   ```

9. **Set up the Node.js executable path:**
   - Find the directory path of the Node.js binary (looks like `/home/laravel/.nvm/versions/node/v22.0.0/bin`):
     ```
     dirname $(nvm which current)
     ```
   - Set the BROWSERSHOT_INCLUDE_PATH in your .env with the path found above:
     ```
     BROWSERSHOT_INCLUDE_PATH=/path/to/your/node/bin
     ```

10. **Make sure your application is running from an OpenLiteSpeed Virtual Host, and update the `APP_URL` in .env**

## Testing instructions

**Test node and puppeteer setup**
1. Navigate to your project root.
2. Run `test-pptr.cjs` from your CLI with node:
    ```
    node test-pptr.cjs
    ```
4. See the Chromium path in your console output.
3. This should just work if node and puppeteer is installed correctly, check `npm list` to verify that puppeteer is installed, if you get any errors.

**Test PDF saving from browser**
1. Navigate to /test-pdf and check if a `hello_world.pdf` pdf file has been saved successfully to your projects `/public` directory.
- This always fails for me.

**Test PDF saving from CLI using your Virtual Host executable user (depends on your OpenLiteSpeed setup)**
1. Navigate to your project root.
2. Run the `/test-pdf` route with the custom `route:call` command:
    ```
    php artisan route:call /test-pdf
    ```
- This always works for me.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
