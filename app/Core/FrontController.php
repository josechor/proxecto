<?php

namespace Com\Daw2\Core;

use Steampixel\Route;

class FrontController
{

    static function main()
    {
        session_start();
        if (isset($_SESSION['usuario']) && !empty($_SESSION['usuario'])) {
            Route::add(
                '/logout',
                function () {
                    $controlador = new \Com\Daw2\Controllers\LogsController();
                    $controlador->logout();
                },
                'get'
            );

            //Reserva de pistas
            Route::add(
                '/reservarPistaPadel',
                function () {
                    $controlador = new \Com\Daw2\Controllers\ReservarPistaController();
                    $controlador->reservaPistaPadel();
                },
                'get'
            );

            //Reserva de pistas de padel
            Route::add(
                '/reservarPistaPadel',
                function () {
                    $controlador = new \Com\Daw2\Controllers\ReservarPistaController();
                    $controlador->reservarPistaPadelPeticion();
                },
                'post'
            );
            Route::add(
                '/reservarPista',
                function () {
                    $controlador = new \Com\Daw2\Controllers\ReservarPistaController();
                    $controlador->ReservarPista();
                },
                'get'
            );

            
        }

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
            '/tarifas',
            function () {
                $controlador = new \Com\Daw2\Controllers\TarifasController();
                $controlador->tarifas();
            },
            'get'
        );
        Route::add(
            '/inscripciones',
            function () {
                $controlador = new \Com\Daw2\Controllers\InscripcionesController();
                $controlador->mostrarInscripciones();
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
