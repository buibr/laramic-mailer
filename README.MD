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

#### Usage
Add your mail configurations directly in the database (SMTP host, port, encryption, etc.).
When sending emails, the plugin will fetch the necessary mailer configuration from the database and apply it on the fly.
You can define and manage multiple mailers for different purposes, all stored in the database.

Example to use of Dynami MailServer server and laramic with defualt laravel functionality:

```php
// from
Mail::to($request->user())->send(new OrderShipped($order));

// to
Laramic::use($ticketCommunication->mailServer)
    ->to($request->user())
    ->send(new InvoiceEmail(Invoice $invoice));
```

All other laravel Mail or MailManager methods as parent layer of Laramic can be used normaly. See: https://laravel.com/docs/11.x/mail[url](https://laravel.com/docs/11.x/mail)]

#### Testing
```php
<?php
use Laramic\Mailers\Facades\Laramic;
use Laramic\Mailers\Models\Laramic;

// Call this method to send test email to authenticated user
Laramic::testMail(MailServer $mailServer);

// Call this method to ping the email server, if configuration is wrong, then the ping will fail.
Laramic::ping(MailServer $mailServer);
```

