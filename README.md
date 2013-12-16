# Yii2 Blog Demo

This is a sample blog application using Yii2.

## Installation

Use Composer to install this application:

```
$ git clone git://github.com/mzhs/yii2-blog-demo.git
cd yii2-blog-demo
composer install
```

Edit `config/web.php`and`config/console.php`:

```php
<?php
return [
    // ...
    'components' => [
        // ...
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=YOUR_DB_NAME',
            'username' => 'YOUR_DB_USERNAME',
            'password' => 'YOUR_DB_PASSWORD',
            'charset' => 'utf8',
        ],
    ],
    // ...
];
```

Run the migrations:

```
$ php yii migrate
yes
```

Create a new user:

```
$ php yii register <username> <password>
```
