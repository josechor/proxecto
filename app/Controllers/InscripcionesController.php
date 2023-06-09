<?php

namespace Com\Daw2\Controllers;

class InscripcionesController extends \Com\Daw2\Core\BaseController
{

    public function mostrarInscripciones()
    {
        $data = array(
            'titulo' => 'Inscripciones',
        );
        $this->view->showViews(array('templates/header.view.php', 'inscripciones.view.php', 'templates/footer.view.php'), $data);
    }

    public function mostrarPiscinaInscribirse()
    {
        $data = array(
            'titulo' => 'Inscripciones piscina',
        );
        
        $this->view->showViews(array('templates/header.view.php', 'piscinaInscribirse.view.php', 'templates/footer.view.php'), $data);
    }

    public function mostrarGymInscribirse()
    {
        $data = array(
            'titulo' => 'Inscripciones piscina',
        );
        $this->view->showViews(array('templates/header.view.php', 'gymInscribirse.view.php', 'templates/footer.view.php'), $data);
    }

    public function gymRegister()
    {
        $data = array(
            'titulo' => 'Registro gym',
        );
        $data['input'] = filter_var_array($_POST,FILTER_SANITIZE_SPECIAL_CHARS);

        $data['errores'] = $this->filtros($_POST);
        if(count($data['errores'])){
            $this->view->showViews(array('templates/header.view.php', 'gymInscribirse.view.php', 'templates/footer.view.php'), $data);
        }else{
            $modelo = new \Com\Daw2\Models\InscripcionesModel;
            $modelo->inscribirGym($_POST);
        }
    }

    public function piscinaInscribirse()
    {
        $data = array(
            'titulo' => 'Registro gym',
        );
        $data['input'] = filter_var_array($_POST,FILTER_SANITIZE_SPECIAL_CHARS);

        $data['errores'] = $this->filtros($_POST);
        if(count($data['errores'])){
            $this->view->showViews(array('templates/header.view.php', 'piscinaInscribirse.view.php', 'templates/footer.view.php'), $data);
        }else{
            $modelo = new \Com\Daw2\Models\InscripcionesModel;
            $modelo->inscribirsePiscina($_POST);
        }
    }

    public function filtros($post)
    {
        $errores = [];
        if (isset($post['nombre']) && !empty($post['nombre'])) {
            $nombre = trim($post['nombre']);
            if (!preg_match('/^[a-zA-Z ]+$/', $nombre)) {
                $errores['nombre'] = "Solo letras y espacios";
            }
        } else {
            $errores['nombre'] = "No puede estar vacio";
        }

        if (isset($post['email']) && !empty($post['email'])) {
            if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
                $errores['email'] = "Email no valido";
            }
        } else {
            $errores['email'] = "No puede estar vacio";
        }

        if (isset($post['dni']) && !empty($post['dni'])) {
            $dni = trim(strtoupper($post['dni']));
            // Verificar longitud
            if (strlen($dni) !== 9) {
                $errores['dni'] = "Dni incorrecto";
            } else {
                $numero = substr($dni, 0, 8);
                $letra = substr($dni, -1);

                // Verificar que el número contenga solo dígitos
                if (!is_numeric($numero)) {
                    $errores['dni'] = "Dni incorrecto";
                } else {

                    $letras = 'TRWAGMYFPDXBNJZSQVHLCKE';
                    $letra_esperada = $letras[$numero % 23];

                    // Verificar que la letra sea correcta
                    if ($letra !== $letra_esperada) {
                        $errores['dni'] = "Dni incorrecto";
                    }
                }
            }
        } else {
            $errores['dni'] = "No puede estar vacio";
        }

        if (isset($post['años']) && !empty($post['años'])) {
            if ($post['años'] < 14 || $post['años'] > 90) {
                $errores['años'] = "Tienes que tener entre 3 y 90 años";
            }
        } else {
            $errores['años'] = "No puede estar vacio";
        }

        if (!isset($post['localizacion']) || empty($post['localizacion'])) {
            $errores['localizacion'] = "No puede estar vacio";
        }

        return $errores;
    }
}
