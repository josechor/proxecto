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

            //Ver la reserva de pistas de padel
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
                '/reservarPistaTenis',
                function () {
                    $controlador = new \Com\Daw2\Controllers\ReservarPistaController();
                    $controlador->reservaPistaTenis();
                },
                'get'
            );

            //Reserva de pistas de padel
            Route::add(
                '/reservarPistaTenis',
                function () {
                    $controlador = new \Com\Daw2\Controllers\ReservarPistaController();
                    $controlador->reservarPistaTenisPeticion();
                },
                'post'
            );

            Route::add(
                '/inscribirseGym',
                function () {
                    $controlador = new \Com\Daw2\Controllers\InscripcionesController();
                    $controlador->mostrarGymInscribirse();
                },
                'get'
            );

            Route::add(
                '/inscribirseGym',
                function () {
                    $controlador = new \Com\Daw2\Controllers\InscripcionesController();
                    $controlador->gymRegister();
                },
                'post'
            );

            Route::add(
                '/inscribirsePiscina',
                function () {
                    $controlador = new \Com\Daw2\Controllers\InscripcionesController();
                    $controlador->mostrarPiscinaInscribirse();
                },
                'get'
            );
            Route::add(
                '/inscribirsePiscina',
                function () {
                    $controlador = new \Com\Daw2\Controllers\InscripcionesController();
                    $controlador->piscinaInscribirse();
                },
                'post'
            );
            Route::add(
                '/borrarInscribirseGym',
                function () {
                    $controlador = new \Com\Daw2\Controllers\InscripcionesController();
                    $controlador->borrarInscripcionGym();
                },
                'post'
            );
            Route::add(
                '/borrarInscribirsePiscina',
                function () {
                    $controlador = new \Com\Daw2\Controllers\InscripcionesController();
                    $controlador->borrarInscripcionPiscina();
                },
                'post'
            );




            if ($_SESSION['usuario']['rol'] == 1) {
                Route::add(
                    '/admin',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\AdministracionController();
                        $controlador->adminitracionVer();
                    },
                    'get'
                );
                Route::add(
                    '/administrarTarifas',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\AdministracionController();
                        $controlador->mostrarTarifas();
                    },
                    'get'
                );
                Route::add(
                    '/administrarTarifas',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\AdministracionController();
                        $controlador->cambiarTarifa();
                    },
                    'post'
                );
                Route::add(
                    '/verReservasPadel',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\AdministracionController();
                        $controlador->verReservasPadel();
                    },
                    'get'
                );
                Route::add(
                    '/verReservasTenis',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\AdministracionController();
                        $controlador->verReservasTenis();
                    },
                    'get'
                );
                Route::add(
                    '/verUsuarios',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\AdministracionController();
                        $controlador->verUsuarios();
                    },
                    'get'
                );
                Route::add(
                    '/borrarUser',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\AdministracionController();
                        $controlador->borrarUser();
                    },
                    'get'
                );
                Route::add(
                    '/cambiarRol',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\AdministracionController();
                        $controlador->cambiarRol();
                    },
                    'get'
                );
                
                Route::add(
                    '/verInscripcionesGimnasio',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\AdministracionController();
                        $controlador->verInscripcionGym();
                    },
                    'get'
                );

                Route::add(
                    '/verInscripcionesPiscina',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\AdministracionController();
                        $controlador->verInscripcionPiscina();
                    },
                    'get'
                );
            }
        }


        //Parte de codigo que lo que hace es llevarte de vuelta al login porque no puedes seguir sin estar logueado
        //Llevar al login


        Route::add(
            '/reservarPistaPadel',
            function () {
                $controlador = new \Com\Daw2\Controllers\LogsController();
                $controlador->loginView();
            },
            'get'
        );

        //Reserva de pistas de padel
        Route::add(
            '/reservarPistaPadel',
            function () {
                $controlador = new \Com\Daw2\Controllers\LogsController();
                $controlador->loginView();
            },
            'post'
        );

        Route::add(
            '/reservarPistaTenis',
            function () {
                $controlador = new \Com\Daw2\Controllers\LogsController();
                $controlador->loginView();
            },
            'get'
        );

        //Reserva de pistas de padel
        Route::add(
            '/reservarPistaTenis',
            function () {
                $controlador = new \Com\Daw2\Controllers\LogsController();
                $controlador->loginView();
            },
            'post'
        );
        Route::add(
            '/inscribirseGym',
            function () {
                $controlador = new \Com\Daw2\Controllers\LogsController();
                $controlador->loginView();
            },
            'get'
        );

        Route::add(
            '/inscribirseGym',
            function () {
                $controlador = new \Com\Daw2\Controllers\LogsController();
                $controlador->loginView();
            },
            'post'
        );

        Route::add(
            '/inscribirsePiscina',
            function () {
                $controlador = new \Com\Daw2\Controllers\LogsController();
                $controlador->loginView();
            },
            'get'
        );
        Route::add(
            '/inscribirsePiscina',
            function () {
                $controlador = new \Com\Daw2\Controllers\LogsController();
                $controlador->loginView();
            },
            'post'
        );
        Route::add(
            '/borrarInscribirseGym',
            function () {
                $controlador = new \Com\Daw2\Controllers\LogsController();
                $controlador->loginView();
            },
            'post'
        );
        Route::add(
            '/borrarInscribirsePiscina',
            function () {
                $controlador = new \Com\Daw2\Controllers\LogsController();
                $controlador->loginView();
            },
            'post'
        );

        //Paginas que puedes ver sin estar logueado
        //Ver la reserva pistas
        Route::add(
            '/reservarPista',
            function () {
                $controlador = new \Com\Daw2\Controllers\ReservarPistaController();
                $controlador->ReservarPista();
            },
            'get'
        );
        //Inscripciones de gimnasio y piscina
        Route::add(
            '/inscripciones',
            function () {
                $controlador = new \Com\Daw2\Controllers\InscripcionesController();
                $controlador->mostrarInscripciones();
            },
            'get'
        );

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
