<?php

namespace Com\Daw2\Controllers;

class InscripcionesController extends \Com\Daw2\Core\BaseController {

    public function mostrarInscripciones() {
        $data = array(
            'titulo' => 'Inscripciones',
        );        
        $this->view->showViews(array('templates/header.view.php', 'inscripciones.view.php', 'templates/footer.view.php'), $data);
    }
    
}
