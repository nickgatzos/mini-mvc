<?php
/**
 * Created by PhpStorm.
 * User: nick
 * Date: 28/01/2018
 * Time: 11:39
 * Description: Initialisation file gets all core components of app
 */
$dir = ''; //! EDIT THIS. POINT TO DIRECTORY THAT HOLDS `app` IF YOU KEEP IT 1 FOLDER DOWN. ELSE ASSIGN $_SERVER['DOCUMENT_ROOT'] VALUE

// Composer autoload
require_once "{$dir}/vendor/autoload.php";

require_once __DIR__ . '/database.php'; // Require the database logic
require_once __DIR__ . '/core/App.php'; // Require the core App class
require_once __DIR__ . '/core/Controller.php'; // Require the core Controller class