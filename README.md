<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Laravel 首次部署步骤

- Git pull
- 本地安装composer，控制台cd到仓库目录composer install
- 将根目录.env.sample复制为.env 修改里面的MYSQL相关信息
- 执行php artisan key:generate
- 执行php artisan storage:link
- 执行php artisan migrate
- 执行php artisan db:seed

## pull之后的操作

首次部署后，每次pull后只需执行php artisan migrate
如有新的包加入则执行composer update
或者新的seed则执行php artisan db:seed --class=指定seeder

## 模型

- Users

## 相关教程

- [用户认证](https://laravel-china.org/docs/laravel/5.6/authentication)
- [权限](https://laravel-china.org/docs/laravel/5.6/authorization)
- [前端](https://laravel-china.org/docs/laravel/5.6/blade)


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
