<?php

namespace Com\Daw2\Controllers;

class ReservarPista extends \Com\Daw2\Core\BaseController {

    public function ReservarPista() {
        $data = array(
            'titulo' => 'Página de inicio',
        );        
        $this->view->showViews(array('templates/header.view.php', 'reservarPista.view.php', 'templates/footer.view.php'), $data);
    }
    
}
