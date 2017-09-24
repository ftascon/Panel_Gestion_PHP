<?php

//header('Content-Type: text/html; charset=utf-8');
//    print_r($_SERVER["SERVER_NAME"]);
switch ($_SERVER['SERVER_NAME']) {
    case "localhost":
        define('BASE_URL', 'http://' . $_SERVER['SERVER_NAME'] . '/admin/');
        define('BASE_PATH', $_SERVER['DOCUMENT_ROOT'] . '/admin');

        ini_set('display_errors', 1);

        function mi_autocargador($clase) {
//            echo BASE_PATH . '/dal/' . strtolower($clase) . '_db.php';
            include BASE_PATH . '/dal/' . strtolower($clase) . '_db.php';
        }

        break;
    default:
        define('BASE_URL', 'http://' . $_SERVER['SERVER_NAME'] . '/');
        define('BASE_PATH', $_SERVER['DOCUMENT_ROOT']);

        function mi_autocargador($clase) {
            include BASE_PATH . '/dal/' . strtolower($clase) . '_db.php';
        }

        break;
}

//------------------------------------------------- autoloader dal define------------------------------------------------------------



session_start();

spl_autoload_register('mi_autocargador');

//------------------------------------------------ instanciar controlador bbdd ------------------------------------------------------
//echo BASE_PATH . '/includes/functions.php';
require_once BASE_PATH . '/dal/database.php';
require_once BASE_PATH . '/includes/functions.php';
