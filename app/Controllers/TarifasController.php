<?php

namespace Com\Daw2\Controllers;

class TarifasController extends \Com\Daw2\Core\BaseController {

    public function tarifas() {
        $data = array(
            'titulo' => 'Tarifas',
        );
        $modelo = new \Com\Daw2\Models\TarifasModel();
        $data['tarifas'] = $modelo->getAll();
        $this->view->showViews(array('templates/header.view.php', 'tarifas.view.php', 'templates/footer.view.php'), $data);
    }
    
}
