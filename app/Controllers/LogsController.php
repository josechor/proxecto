<?php

namespace Com\Daw2\Controllers;

class LogsController extends \Com\Daw2\Core\BaseController
{

    public function loginView()
    {
        $data = array(
            'titulo' => 'Login view',
        );

        $this->view->showViews(array('login.view.php'), $data);
    }
    public function login()
    {
        $modelUser = new \Com\Daw2\Models\LogsModel();

        $data['inputL'] = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);

        //en este caso solo el username dará error


        $user = $modelUser->login($_POST['nombre'], $_POST['contraseña']);

        if (is_null($user)) {
            $data['error'] = "El usuario o la contraseña son incorrectos";
            $this->view->show('login.view.php', $data);
        } else {
            //Al llegar aqui ya está logeado con éxito
            $_SESSION['usuario'] = $user;
            header('Location: /inicio');

        }
    }

    public function registerView()
    { {
            $data = array(
                'titulo' => 'Registro view',
            );

            $this->view->showViews(array('register.view.php'), $data);
        }
    }

    public function registrar()
    {
        $data = array(
            'titulo' => 'registro',
        );
        $data['inputs'] = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        $errores = $this->error($_POST);
        if (is_array($errores) && count($errores) == 0) {
            $modelo = new \Com\Daw2\Models\LogsModel();
            $data['registro'] = $modelo->registrar($_POST);
            $data['confirmar'] = "Registro completado correctamente";
            $this->view->showViews(array('login.view.php'), $data);
        } else {
            $data['error'] = $errores;
            $this->view->showViews(array('register.view.php'), $data);
        }
    }

    public function logout(){
        session_destroy();
        header('Location: /inicio');
    }


    public function error($post)
    {
        $errores = [];

        //USERNAME
        if (isset($post['nombre']) && !empty($post['nombre'])) {

            if (preg_match("/[^A-Za-z0-9]/", $post['nombre'])) {
                $errores['registro']['nombre'] = "El nombre de ususario debe de estar formado solo por letras y números";
            }
        } else {
            $errores['registro']['nombre'] = "El nombre de usuario no puede estar en blanco";
        }

        //PASSWORD

        if (isset($post['contraseña']) && !empty($post['contraseña'])) {

            if (preg_match("/[^A-Za-z0-9.]/", $post['contraseña'])) {
                $errores['registro']['contraseña'] = "La contraseñ debe estar formada solo por letras, números y \".\"";
            }

            if (!preg_match("/[A-Z]{1,}/", $post['contraseña'])) {
                $errores['registro']['contraseña'] = "La contraseña debe contener una letra mayúscula mínimo";
            }

            if (!preg_match("/[a-z]{1,}/", $post['contraseña'])) {
                $errores['registro']['contraseña'] = "La contraseña debe contener una letra minúscula mínimo";
            }

            if (!preg_match("/[0-9]{1,}/", $post['contraseña'])) {
                $errores['registro']['contraseña'] = "La contraseña debe contener un número como mínimo";
            }
        } else {
            $errores['registro']['contraseña'] = "La contraseña no puede estar en blanco";
        }

        //CORREO
        if (!isset($_POST['correo']) || !filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL)) {
            $errores['registro']['correo'] = "Correo no válido";
        } else {
            $modelo = new \Com\Daw2\Models\LogsModel();
            if ($modelo->comprabarCorreo($_POST['correo'])) {
                $errores['registro']['correo'] = "Correo ya en uso";
            }
        }

        return $errores;
    }
}
