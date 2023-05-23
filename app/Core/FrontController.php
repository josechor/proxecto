<?php

namespace Com\Daw2\Core;

use Steampixel\Route;

class FrontController
{

    static function main()
    {
        session_start();
        //Rutas que están disponibles para todos
        Route::add(
            '/',
            function () {
                $controlador = new \Com\Daw2\Controllers\InicioController();
                $controlador->index();
            },
            'get'
        );
        Route::add(
            '/inicio',
            function () {
                $controlador = new \Com\Daw2\Controllers\InicioController();
                $controlador->index();
            },
            'get'
        );

        Route::add(
            '/reservarPista',
            function () {
                $controlador = new \Com\Daw2\Controllers\ReservarPista();
                $controlador->ReservarPista();
            },
            'get'
        );
        Route::add(
            '/login',
            function () {
                $controlador = new \Com\Daw2\Controllers\LogsController();
                $controlador->loginView();
            },
            'get'
        );

        Route::add(
            '/login',
            function () {
                $controlador = new \Com\Daw2\Controllers\LogsController();
                $controlador->login();
            },
            'post'
        );
        Route::add(
            '/logout',
            function () {
                $controlador = new \Com\Daw2\Controllers\LogsController();
                $controlador->logout();
            },
            'get'
        );
        Route::add(
            '/registrar',
            function () {
                $controlador = new \Com\Daw2\Controllers\LogsController();
                $controlador->registerView();
            },
            'get'
        );

        Route::add(
            '/registrar',
            function () {
                $controlador = new \Com\Daw2\Controllers\LogsController();
                $controlador->registrar();
            },
            'post'
        );

        Route::add(
            '/tarifas',
            function () {
                $controlador = new \Com\Daw2\Controllers\TarifasController();
                $controlador->tarifas();
            },
            'get'
        );




        Route::pathNotFound(
            function () {
                $controller = new \Com\Daw2\Controllers\ErroresController();
                $controller->error404();
            }
        );

        Route::methodNotAllowed(
            function () {
                $controller = new \Com\Daw2\Controllers\ErroresController();
                $controller->error405();
            }
        );




        Route::run();
    }
}
