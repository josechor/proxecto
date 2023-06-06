<?php

namespace Com\Daw2\Controllers;

use function PHPSTORM_META\type;

class ReservarPistaController extends \Com\Daw2\Core\BaseController
{

    public function ReservarPista()
    {
        $data = array(
            'titulo' => 'Reserva pistas',
        );
        $this->view->showViews(array('templates/header.view.php', 'reservarPista.view.php', 'templates/footer.view.php'), $data);
    }

    //Reserva pistas de padel
    public function reservaPistaPadel()
    {
        $data = array(
            'titulo' => 'Reserva padel',
        );
        $data['mensaje'] = "";
        if (isset($_SESSION['mensaje'])) {
            $data['mensaje'] = $_SESSION['mensaje'];
            unset($_SESSION['mensaje']);
        }
        $data['fechaActual'] = date('d-m-Y');

        if (!isset($_GET['fechaVer']) || empty($_GET['fechaVer'])) {
            $_GET['fechaVer'] = date('d-m-Y');
            $data['fechaVer'] = date('d-m-Y');
        } else {
            if (strtotime($_GET['fechaVer']) >= strtotime(date('d-m-Y', strtotime("+3 days", strtotime($data['fechaActual'])))) || strtotime($_GET['fechaVer']) < strtotime($data['fechaActual'])) {
                $_GET['fechaVer'] = date('d-m-Y');
                $data['fechaVer'] = date('d-m-Y');
            }
            $data['fechaVer'] = $_GET['fechaVer'];
        }
        $data['opciones'] = $this->opcionesPadel($data['fechaVer']);
        $this->view->showViews(array('templates/header.view.php', 'reservaPistaPadel.view.php', 'templates/footer.view.php'), $data);
    }

    //Creación de todos los mensajes que vamos a introducir en la tabla de la view
    public function opcionesPadel($fecha)
    {
        $modelo = new \Com\Daw2\Models\PistasModel;
        $opciones = [];
        $horaInicial = date('d-m-Y H:i:s', strtotime('+9 hour', strtotime($fecha)));
        for ($i = 0; $i < 12; $i++) {
            $opciones[$i]['color'] = "";
            $opciones[$i]['reservar'] = false;
            $fechamas8 = date('d-m-Y H:i:s', strtotime("$i hour", strtotime($horaInicial)));
            $fechaHoras = date('H:i', strtotime($fechamas8));
            $opciones[$i]['hora'] = $fechaHoras;
            $opciones[$i]['fechaCompleta'] = $fechamas8;
            $opciones[$i]['jugadores'] = 4;
            $disponibilidad = $modelo->comprobarDisponibilidadPadel($fechamas8);
            if (count($disponibilidad) > 0) {
                if ($disponibilidad[0]['id_usuario'] == $_SESSION['usuario']['id']) {
                    $opciones[$i]['estado'] = "Reserva personal";
                    $opciones[$i]['color'] = "green";
                } else {
                    $opciones[$i]['estado'] = "Pista reservada";
                    $opciones[$i]['color'] = "red";
                }
            } else {
                if (strtotime($fechamas8) < strtotime(date('d-m-Y H:i:s'))) {
                    $opciones[$i]['estado'] = "Fuera de hora";
                } else {
                    $opciones[$i]['estado'] = "Disponible";
                    $opciones[$i]['reservar'] = true;
                }
            }
        }
        return $opciones;
    }

    //Funcion para reservar la pista de padel
    public function reservarPistaPadelPeticion()
    {

        $data['errores'] = $this->erroresPadel($_POST);

        if (count($data['errores']) == 0) {
            $modelo = new \Com\Daw2\Models\PistasModel;
            $modelo->reservarPistaPadel($_POST['fecha']);
            $_SESSION['mensaje'] = "Reserva completada con exito";
        } else {
            $_SESSION['mensaje'] = "No se pudo completar la reserva, recargue la página intentar solucionar el error";
        }
        header('Location: /reservarPistaPadel');
    }

    //Comprobar los errores de que pueda tener la reserva de pista de padel
    function erroresPadel($post)
    {
        $errores = [];
        $fecha = $post['fecha'];
        if (!empty($fecha)) {
            $fechaActual = date('d-m-Y H:i:s'); // Obtener la fecha y hora actual
            $fechaLimite = date('d-m-Y', strtotime('+3 days'));
            if (strtotime($fecha) >= strtotime($fechaActual)) {
                // Comprobar que la fecha no es mayor a la fecha actual (solo días)
                if (strtotime($fecha) >= strtotime($fechaLimite)) {
                    $errores['fecha'] = "La fecha es mayor a la fecha actual (solo días).";
                } else {
                    $model = new \Com\Daw2\Models\PistasModel();
                    count($model->comprobarDisponibilidadPadel($fecha)) > 0 ? $errores['fecha'] = "Esta fecha ya esta reservada" : "";
                }
            } else {
                $errores['fecha'] = "La fecha es menor a la fecha actual (incluyendo horas, minutos y segundos).";
            }
        } else {
            $errores['fecha'] = "La fecha no puede estar vacia";
        }
        return $errores;
    }

    public function reservaPistaTenis()
    {
        $data = array(
            'titulo' => 'Reserva tenis',
        );
        $data['mensaje'] = "";
        if (isset($_SESSION['mensaje'])) {
            $data['mensaje'] = $_SESSION['mensaje'];
            unset($_SESSION['mensaje']);
        }
        $data['fechaActual'] = date('d-m-Y');

        if (!isset($_GET['fechaVer']) || empty($_GET['fechaVer'])) {
            $_GET['fechaVer'] = date('d-m-Y');
            $data['fechaVer'] = date('d-m-Y');
        } else {
            if (strtotime($_GET['fechaVer']) >= strtotime(date('d-m-Y', strtotime("+3 days", strtotime($data['fechaActual'])))) || strtotime($_GET['fechaVer']) < strtotime($data['fechaActual'])) {
                $_GET['fechaVer'] = date('d-m-Y');
                $data['fechaVer'] = date('d-m-Y');
            }
            $data['fechaVer'] = $_GET['fechaVer'];
        }
        $data['opciones'] = $this->opcionesTenis($data['fechaVer']);
        $this->view->showViews(array('templates/header.view.php', 'reservaPistaTenis.view.php', 'templates/footer.view.php'), $data);
    }

    public function opcionesTenis($fecha)
    {
        $modelo = new \Com\Daw2\Models\PistasModel;
        $opciones = [];
        $horaInicial = date('d-m-Y H:i:s', strtotime('+9 hour', strtotime($fecha)));
        for ($i = 0; $i < 12; $i++) {
            $opciones[$i]['color'] = "";
            $opciones[$i]['reservar'] = false;
            $fechamas8 = date('d-m-Y H:i:s', strtotime("$i hour", strtotime($horaInicial)));
            $fechaHoras = date('H:i', strtotime($fechamas8));
            $opciones[$i]['hora'] = $fechaHoras;
            $opciones[$i]['fechaCompleta'] = $fechamas8;
            $opciones[$i]['jugadores'] = 4;
            $disponibilidad = $modelo->comprobarDisponibilidadTenis($fechamas8);
            if (count($disponibilidad) > 0) {
                if ($disponibilidad[0]['id_usuario'] == $_SESSION['usuario']['id']) {
                    $opciones[$i]['estado'] = "Reserva personal";
                    $opciones[$i]['color'] = "green";
                } else {
                    $opciones[$i]['estado'] = "Pista reservada";
                    $opciones[$i]['color'] = "red";
                }
            } else {
                if (strtotime($fechamas8) < strtotime(date('d-m-Y H:i:s'))) {
                    $opciones[$i]['estado'] = "Fuera de hora";
                } else {
                    $opciones[$i]['estado'] = "Disponible";
                    $opciones[$i]['reservar'] = true;
                }
            }
        }
        return $opciones;
    }

    public function reservarPistaTenisPeticion()
    {

        $data['errores'] = $this->erroresTenis($_POST);

        if (count($data['errores']) == 0) {
            $modelo = new \Com\Daw2\Models\PistasModel;
            $modelo->reservarPistaTenis($_POST['fecha']);
            $_SESSION['mensaje'] = "Reserva completada con exito";
        } else {
            $_SESSION['mensaje'] = "No se pudo completar la reserva, recargue la página intentar solucionar el error";
        }
        header('Location: /reservarPistaTenis');
    }

    function erroresTenis($post)
    {
        $errores = [];
        $fecha = $post['fecha'];
        if (!empty($fecha)) {
            $fechaActual = date('d-m-Y H:i:s'); // Obtener la fecha y hora actual
            $fechaLimite = date('d-m-Y', strtotime('+3 days'));
            if (strtotime($fecha) >= strtotime($fechaActual)) {
                // Comprobar que la fecha no es mayor a la fecha actual (solo días)
                if (strtotime($fecha) >= strtotime($fechaLimite)) {
                    $errores['fecha'] = "La fecha es mayor a la fecha actual (solo días).";
                } else {
                    $model = new \Com\Daw2\Models\PistasModel();
                    count($model->comprobarDisponibilidadTenis($fecha)) > 0 ? $errores['fecha'] = "Esta fecha ya esta reservada" : "";
                }
            } else {
                $errores['fecha'] = "La fecha es menor a la fecha actual (incluyendo horas, minutos y segundos).";
            }
        } else {
            $errores['fecha'] = "La fecha no puede estar vacia";
        }
        return $errores;
    }
}
