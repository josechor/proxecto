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
        $tamPagina = 5;
        $data = [];
        $modelo = new \Com\Daw2\Models\PistasModel();
        $cont = $modelo->countPadel($_GET);
        $paginas =floor(($cont / $tamPagina));
        if($cont%$tamPagina != 0){
            $paginas++;
        }
        if(!isset($_GET['page']) || empty($_GET['page'])){
            $_GET['page'] = 1;
        }
        if($_GET['page'] <=0){
            $_GET['page'] = 1;
        }else if($_GET['page'] > $paginas){
            $_GET['page'] = $paginas;
        }
        $data['paginaActual'] = $_GET['page'];
        $data['nPaginas'] = $paginas;
        $data['datos'] = $modelo->mostrarReservasPadel($_GET,$tamPagina);
        $this->view->showViews(array('templates/header.view.php', 'verReservasPadel.view.php'), $data);
    }

    public function verReservasTenis(){
        $tamPagina = 5;
        $data = [];
        $modelo = new \Com\Daw2\Models\PistasModel();
        $cont = $modelo->countTenis($_GET);
        $paginas =floor(($cont / $tamPagina));
        if($cont%$tamPagina != 0){
            $paginas++;
        }
        if(!isset($_GET['page']) || empty($_GET['page'])){
            $_GET['page'] = 1;
        }
        if($_GET['page'] <=0){
            $_GET['page'] = 1;
        }else if($_GET['page'] > $paginas){
            $_GET['page'] = $paginas;
        }
        $data['paginaActual'] = $_GET['page'];
        $data['nPaginas'] = $paginas;
        $data['datos'] = $modelo->mostrarReservasTenis($_GET,$tamPagina);
        $this->view->showViews(array('templates/header.view.php', 'verReservasTenis.view.php'), $data);
    }

    public function verUsuarios(){
        $tamPagina = 5;
        $data = [];
        $modelo = new \Com\Daw2\Models\LogsModel();
        if(isset($_SESSION['mensaje']) && !empty($_SESSION['mensaje'])){
            $data['mensaje'] = $_SESSION['mensaje'];
            unset($_SESSION['mensaje']);
        }
        $cont = $modelo->countUsuarios($_GET);
        $paginas =floor(($cont / $tamPagina));
        if($cont%$tamPagina != 0){
            $paginas++;
        }
        if(!isset($_GET['page']) || empty($_GET['page'])){
            $_GET['page'] = 1;
        }
        if($_GET['page'] <=0){
            $_GET['page'] = 1;
        }else if($_GET['page'] > $paginas){
            $_GET['page'] = $paginas;
        }
        $data['paginaActual'] = $_GET['page'];
        $data['nPaginas'] = $paginas;
        $data['datos'] = $modelo->mostrarUsuarios($_GET,$tamPagina);
        $this->view->showViews(array('templates/header.view.php', 'usuarios.view.php'), $data);
    }
    public function borrarUser(){
        $modelo = new \Com\Daw2\Models\LogsModel();
        if($_GET['id'] == $_SESSION['usuario']['id']){
            $_SESSION['mensaje'] = "No puedes borrarte a ti mismo";
        }else{
            $borrar = $modelo->borrarUser($_GET); 
            $_SESSION['mensaje'] = $borrar;
        }
        header('Location: verUsuarios');
    }
    public function cambiarRol(){
        $modelo = new \Com\Daw2\Models\LogsModel();
        if($_GET['id'] == $_SESSION['usuario']['id']){
            $_SESSION['mensaje'] = "No puedes cambiarte el rol a ti mismo";
        }else{
            $cambioRol = $modelo->cambioRol($_GET);
            $_SESSION['mensaje'] = "Cambio realizado";
        }
        header('Location: verUsuarios');
    }

    public function verInscripcionGym(){
        $tamPagina = 5;
        $data = [];
        $modelo = new \Com\Daw2\Models\InscripcionesModel();
        $cont = $modelo->countGym($_GET);
        $paginas =floor(($cont / $tamPagina));
        if($cont%$tamPagina != 0){
            $paginas++;
        }
        if(!isset($_GET['page']) || empty($_GET['page'])){
            $_GET['page'] = 1;
        }
        if($_GET['page'] <=0){
            $_GET['page'] = 1;
        }else if($_GET['page'] > $paginas){
            $_GET['page'] = $paginas;
        }
        $data['paginaActual'] = $_GET['page'];
        $data['nPaginas'] = $paginas;
        $data['datos'] = $modelo->mostrarInscriocionesGym($_GET,$tamPagina);
        $this->view->showViews(array('templates/header.view.php', 'verReservasGym.view.php'), $data);
    }

    public function verInscripcionPiscina(){
        $tamPagina = 5;
        $data = [];
        $modelo = new \Com\Daw2\Models\InscripcionesModel();
        $cont = $modelo->countPiscina($_GET);
        $paginas =floor(($cont / $tamPagina));
        if($cont%$tamPagina != 0){
            $paginas++;
        }
        if(!isset($_GET['page']) || empty($_GET['page'])){
            $_GET['page'] = 1;
        }
        if($_GET['page'] <=0){
            $_GET['page'] = 1;
        }else if($_GET['page'] > $paginas){
            $_GET['page'] = $paginas;
        }
        $data['paginaActual'] = $_GET['page'];
        $data['nPaginas'] = $paginas;
        $data['datos'] = $modelo->mostrarInscriocionesPiscina($_GET,$tamPagina);
        $this->view->showViews(array('templates/header.view.php', 'verReservasPiscina.view.php'), $data);
    }
}