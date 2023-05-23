<?php

namespace Com\Daw2\Controllers;

class LogsController extends \Com\Daw2\Core\BaseController
{

    public function loginView()
    {
        $data = array(
            'titulo' => 'Página de inicio',
        );
        
        $this->view->showViews(array('login.view.php'), $data);
    }

    public function registrar()
    {
        $data = array(
            'titulo' => 'Login',
        );
        $modelo = new \Com\Daw2\Models\LogsModel();
        $data['registro'] = $modelo->registrar($_POST);
        $this->view->showViews(array('login.view.php'), $data);
    }
}
