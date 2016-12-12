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

3. Open a console terminal, apply migrations with following commands:
    ```
    php yii migrate --migrationPath=@vendor/dektrium/yii2-user/migrations
    php yii migrate --migrationPath=@yii/rbac/migrations
    php yii migrate --migrationPath=@vendor/black-lamp/blcms-languages/migrations
    php yii migrate --migrationPath=@vendor/black-lamp/yii2-multi-lang/migration
    php yii migrate --migrationPath=@vendor/black-lamp/yii2-seo/migrations
    php yii migrate --migrationPath=@vendor/black-lamp/blcms-redirect/migrations
    php yii migrate --migrationPath=@vendor/black-lamp/yii2-articles/common/migrations
    php yii migrate --migrationPath=@vendor/black-lamp/blcms-staticpage/migrations
    php yii migrate --migrationPath=@vendor/black-lamp/blcms-shop/migrations
    php yii migrate --migrationPath=@vendor/black-lamp/blcms-cart/migrations
    php yii migrate --migrationPath=@vendor/black-lamp/blcms-payment/migrations
    php yii migrate --migrationPath=@vendor/black-lamp/blcms-gallery/migrations
    php yii migrate --migrationPath=@uran1980/yii/modules/i18n/migrations
    php yii migrate --migrationPath=@yii/log/migrations
    php yii migrate
    ```
    or
    ```
    php yii migrate --migrationPath=@vendor/dektrium/yii2-user/migrations --interactive=0 && php yii migrate --migrationPath=@yii/rbac/migrations --interactive=0 && php yii migrate --migrationPath=@vendor/black-lamp/blcms-languages/migrations --interactive=0 && php yii migrate --migrationPath=@vendor/black-lamp/yii2-multi-lang/migration --interactive=0 && php yii migrate --migrationPath=@vendor/black-lamp/yii2-seo/migrations --interactive=0 && php yii migrate --migrationPath=@vendor/black-lamp/blcms-redirect/migrations --interactive=0 && php yii migrate --migrationPath=@vendor/black-lamp/yii2-articles/common/migrations --interactive=0 && php yii migrate --migrationPath=@vendor/black-lamp/blcms-staticpage/migrations --interactive=0 && php yii migrate --migrationPath=@vendor/black-lamp/blcms-shop/migrations --interactive=0 && php yii migrate --migrationPath=@vendor/black-lamp/blcms-cart/migrations --interactive=0 && php yii migrate --migrationPath=@vendor/black-lamp/blcms-payment/migrations --interactive=0 && php yii migrate --migrationPath=@vendor/black-lamp/blcms-rbac/migrations --interactive=0 && php yii migrate --interactive=0 php yii migrate --migrationPath=@vendor/black-lamp/blcms-gallery/migrations --interactive=0 && php yii migrate --migrationPath=@uran1980/yii/modules/i18n/migrations --interactive=0 && php yii migrate --migrationPath=@yii/log/migrations --interactive=0 && php yii migrate --interactive=0
    ```
4. Open a console terminal, execute the `rbac/init` command.

5. Adjust a params accordingly:
    - The `emailHost`, `emailPort`, `novaPoshtaApiKey` in `frontend/config/params.php`.
    - The `infoEmailPassword` in `frontend/config/params-local.php`.