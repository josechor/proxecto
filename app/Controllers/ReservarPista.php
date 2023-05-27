<?php

namespace Com\Daw2\Controllers;

class ReservarPista extends \Com\Daw2\Core\BaseController {

    public function ReservarPista() {
        $data = array(
            'titulo' => 'Reserva pistas',
        );        
        $this->view->showViews(array('templates/header.view.php', 'reservarPista.view.php', 'templates/footer.view.php'), $data);
    }

    public function reservaPistaPadel() {
        $data = array(
            'titulo' => 'Reserva padel',
        );        
        $this->view->showViews(array('templates/header.view.php', 'reservaPistaPadel.view.php', 'templates/footer.view.php'), $data);
    }
    
}
