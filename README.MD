Laramic Mailer is a Laravel plugin that allows dynamic email configuration based on database-stored settings. This package makes it easy to manage multiple mail configurations and send emails without hardcoding your email settings in .env files.

## Features 
- Dynamic Mail Configuration: Fetch mail settings from the database and apply them on the fly.
- Seamless Integration: Easily integrates with Laravel's native mail functionality.
- Multi-Mailer Support: Supports multiple mailers for different use cases.
- Flexible Setup: Define your own mailer configurations in the database, including SMTP host, port, encryption, and more.
- Configurable Sender Info: Dynamically configure "From" name and address for each mail.
- Extensible: Customize how mail configurations are stored and retrieved.

## Installation

#### Step 1: Install via Composer
To install the package, run the following command:
```Bash
composer require buibr/laramic-mailer
```

#### Step 2: Publish Configuration and Migration
After installation, publish the configuration and migration files:
```Bash
php artisan vendor:publish --tag=laramic-mailer-config
php artisan migrate
```
