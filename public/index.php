<?php

require_once "./../core/bootstrap.php";

use Core\Base\Route;
use Core\Base\Request;

Route::direct(
    Request::uri(),
    Request::method()
);
