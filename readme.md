Since Databases and keys are different, downloading this directly probably won't work.

There is no initial admin user. A new user must be created and set as admin, probably with php artisan tinker. Once an admin exsits, that admin can make other users admins as well.

Email configs use log as driver and localhost as host. This writes the password reset email to the log file in storage/log instead of actually sending an email. I have not found a service that works yet, but I got the closest with Amazon SES

TODO: Replace birthday with date interface rather than strings
When admin resets a user password, send a message
Set up actual emails instead of logs

Current Capabilities:

User create, edit info
Admin create, edit user info, look at user list, give users admin permissions
User reset password
Admin reset password (when hitting button, email will send with no notification yet. Check log)
Admin middleware (admin 'get' pages can only be accessed by admin)

Changed files
App/User.php
App/Http/Controllers (various)
App/Http/Middleware (AdminMiddleware)
Resources/Views (various)
Various database migrations





# Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
