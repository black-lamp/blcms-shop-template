Installation
============

## Requirements

The minimum requirement by this project template is that your Web server supports PHP 5.4.0.

## Installing using Composer

With Composer installed, you can then install the application using the following commands:

    composer global require "fxp/composer-asset-plugin:^1.2.0"
    composer create-project --prefer-dist black-lamp/blcms-shop-template appname

## Preparing application

1. Open a console terminal, execute the `init` command and select `dev` as environment.

   ```
   php init
   ```

2. Create a new database and adjust the `components['db']` configuration in `common/config/main-local.php` accordingly.

3. Open a console terminal, apply migrations with command `php yii migrate`.