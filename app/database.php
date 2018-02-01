<?php
/**
 * Created by PhpStorm.
 * User: nick
 * Date: 30/01/2018
 * Time: 00:38
 */

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule();

$capsule->addConnection([
    'driver' => 'mysql',
    'host' => 'localhost',
    'username' => '',
    'password' => '',
    'database' => '',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => ''
]);

$capsule->bootEloquent();