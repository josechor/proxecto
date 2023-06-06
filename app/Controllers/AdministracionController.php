<?php
declare(strict_types = 1);
namespace Com\Daw2\Controllers;

class AdministracionController extends \Com\Daw2\Core\BaseController {
    
    public function adminitracionVer() {
        $data = array(
            'titulo' => 'Administracion',
        );        
        $this->view->showViews(array('templates/header.view.php', 'admin.view.php'), $data);
    }

    public function mostrarTarifas(){
        $modelo = new \Com\Daw2\Models\TarifasModel();
        $data['tarifas'] = $modelo->getAll();
        $this->view->showViews(array('templates/header.view.php', 'cambiarTarifas.view.php'), $data);
    }

    public function cambiarTarifa(){
        $modelo = new \Com\Daw2\Models\TarifasModel();
        $modelo->cambiarTarifa($_POST);
        header('Location: /administrarTarifas');
    }

    public function verReservasPadel(){
        $data = [];
        $modelo = new \Com\Daw2\Models\PistasModel();
        $data['datos'] = $modelo->mostrarReservas($_GET);
        $this->view->showViews(array('templates/header.view.php', 'verReservasPadel.view.php'), $data);
    }
}