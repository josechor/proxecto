<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

class InscripcionesModel extends \Com\Daw2\Core\BaseModel {

    function verInscripcionGym(){
        $sql = "SELECT * FROM inscripciones_gimnasio where id_usuario = :id";
        
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->execute([
            "id" => $_SESSION['usuario']['id'],
        ]);
        return $stmt->fetchAll();
    }

    function verInscripcionPiscina(){
        $sql = "SELECT * FROM inscripciones_piscina where id_usuario = :id";
        
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->execute([
            "id" => $_SESSION['usuario']['id'],
        ]);
        return $stmt->fetchAll();
    }

    function borrarInscripcionPiscina($dni){
        $sql = "SELECT * FROM inscripciones_piscina where dni = :dni and id_usuario = :id";
        
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->execute([
            "dni" => $dni,
            "id" => $_SESSION['usuario']['id']
        ]);

        if(count($stmt->fetchAll()) > 0){
            $sen = $this->pdo->prepare("DELETE FROM inscripciones_piscina WHERE dni = :dni and id_usuario = :id");
            $sen->execute([
                "dni" => $dni,
                "id" => $_SESSION['usuario']['id']
            ]);
            return true;
        }else{
            return false;
        }
    }

    function borrarInscripcionGym($dni){
        $sql = "SELECT * FROM inscripciones_gimnasio where dni = :dni and id_usuario = :id";
        
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->execute([
            "dni" => $dni,
            "id" => $_SESSION['usuario']['id']
        ]);

        
        if(count($stmt->fetchAll()) > 0){
            $sen = $this->pdo->prepare("DELETE FROM inscripciones_gimnasio WHERE dni = :dni and id_usuario = :id");
            $sen->execute([
                "dni" => $dni,
                "id" => $_SESSION['usuario']['id']
            ]);
            return true;
        }else{
            return false;
        }
    }

    function inscribirGym($post){
        $sql = "INSERT INTO inscripciones_gimnasio (id_usuario,nombreCompleto,email,dni,años,ncuenta) values (:id_usuario,:nombreCompleto,:email,:dni,:anos,:ncuenta)";
        
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->execute([
            "id_usuario" => $_SESSION['usuario']['id'],
            "nombreCompleto" => $post['nombre'],
            "email" => $post['email'],
            "dni" => $post['dni'],
            "anos" => $post['años'],
            "ncuenta" => $post['ncuenta'],
        ]);
    }

    function inscribirsePiscina($post){
        $sql = "INSERT INTO inscripciones_piscina (id_usuario,nombreCompleto,email,dni,años,ncuenta) values (:id_usuario,:nombreCompleto,:email,:dni,:anos,:ncuenta)";
        
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->execute([
            "id_usuario" => $_SESSION['usuario']['id'],
            "nombreCompleto" => $post['nombre'],
            "email" => $post['email'],
            "dni" => $post['dni'],
            "anos" => $post['años'],
            "ncuenta" => $post['ncuenta'],
        ]);
    }

    function filtros($filtros)
    {
        $condiciones = [];
        $parametros = [];

        if (isset($filtros['nombre']) && !empty($filtros['nombre'])) {
            $condiciones[] = 'nombreCompleto LIKE :nombre';
            $parametros['nombre'] = '%' . $filtros['nombre'] . '%';
        }

        if (isset($filtros['correo']) && !empty($filtros['correo'])) {
            $condiciones[] = 'email LIKE :correo';
            $parametros['correo'] = '%' . $filtros['correo'] . '%';
        }
        if (isset($filtros['dni']) && !empty($filtros['dni'])) {
            $condiciones[] = 'dni LIKE :dni';
            $parametros['dni'] = '%' . $filtros['dni'] . '%';
        }
        if (isset($filtros['años']) && !empty($filtros['años'])) {
            $condiciones[] = 'años = :anos';
            $parametros['anos'] = $filtros['años'];
        }
        if (isset($filtros['ncuenta']) && !empty($filtros['ncuenta'])) {
            $condiciones[] = 'ncuenta LIKE :ncuenta';
            $parametros['ncuenta'] = '%' . $filtros['ncuenta'] . '%';
        }

        if (isset($filtros['fechaMin']) && !empty($filtros['fechaMin'])) {
            $filtros['fechaMin'] .= ":00";
            $filtros['fechaMin'] = str_replace("T", " ", $filtros['fechaMin']);
            $condiciones[] = 'fecha_inscripcion >= :fechaMin';
            $parametros['fechaMin'] = $filtros['fechaMin'];
        }
        if (isset($filtros['fechaMax']) && !empty($filtros['fechaMax'])) {
            $filtros['fechaMax'] .= ":00";
            $filtros['fechaMax'] = str_replace("T", " ", $filtros['fechaMax']);
            $condiciones[] = 'fecha_inscripcion <= :fechaMax';
            $parametros['fechaMax'] = $filtros['fechaMax'];
        }

        return array('condiciones' => $condiciones, 'parametros' => $parametros);
    }

    

    function mostrarInscriocionesGym($filtros,$tamPag)
    {
        $order = "desc";
        if (isset($filtros['order']) && $filtros['order'] == "fecha_asc") {
            $order = "asc";
        }

        $pagina = isset($filtros['page']) && $filtros['page'] > 0 ? (int) $filtros['page'] : 1;        
        $registroInicial = ($pagina - 1) * $tamPag;        
        $limit = "LIMIT $registroInicial, $tamPag";

        $procesado = $this->filtros($filtros);
        $condiciones = $procesado['condiciones'];
        $parametros = $procesado['parametros'];

        if (count($parametros) > 0) {
            $stmt = $this->pdo->prepare('SELECT * FROM inscripciones_gimnasio INNER JOIN usuarios ON inscripciones_gimnasio.id_usuario = usuarios.id WHERE ' . implode(' AND ', $condiciones) . " ORDER BY fecha_inscripcion " . $order." ".$limit);
            $stmt->execute($parametros);
            return $stmt->fetchAll();
        } else {
            $stmt = $this->pdo->prepare('SELECT * FROM inscripciones_gimnasio INNER JOIN usuarios ON inscripciones_gimnasio.id_usuario = usuarios.id ORDER BY fecha_inscripcion ' . $order." ".$limit);
            $stmt->execute($parametros);
            $datos = $stmt->fetchAll();
            foreach ($datos as $num => $d) {
                unset($datos[$num]['contraseña']);
            }
            return $datos;
        }
    }

    function countGym($filtros) {
        $procesado = $this->filtros($filtros);
        
        $condiciones = $procesado['condiciones'];
        $parametros = $procesado['parametros'];
        
        if(count($parametros) > 0){
            $sql = 'SELECT * FROM inscripciones_gimnasio INNER JOIN usuarios ON inscripciones_gimnasio.id_usuario = usuarios.id WHERE '.implode(" AND ", $condiciones);
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($parametros);
            $res = $stmt->fetchAll();
            return count($res);
        }
        else{
            $stmt = $this->pdo->query('SELECT * FROM inscripciones_gimnasio INNER JOIN usuarios ON inscripciones_gimnasio.id_usuario = usuarios.id');
            $res = $stmt->fetchAll();
            return count($res);
        }
    }

    function mostrarInscriocionesPiscina($filtros,$tamPag)
    {
        $order = "desc";
        if (isset($filtros['order']) && $filtros['order'] == "fecha_asc") {
            $order = "asc";
        }

        $pagina = isset($filtros['page']) && $filtros['page'] > 0 ? (int) $filtros['page'] : 1;        
        $registroInicial = ($pagina - 1) * $tamPag;        
        $limit = "LIMIT $registroInicial, $tamPag";

        $procesado = $this->filtros($filtros);
        $condiciones = $procesado['condiciones'];
        $parametros = $procesado['parametros'];

        if (count($parametros) > 0) {
            $stmt = $this->pdo->prepare('SELECT * FROM inscripciones_piscina INNER JOIN usuarios ON inscripciones_piscina.id_usuario = usuarios.id WHERE ' . implode(' AND ', $condiciones) . " ORDER BY fecha_inscripcion " . $order." ".$limit);
            $stmt->execute($parametros);
            return $stmt->fetchAll();
        } else {
            $stmt = $this->pdo->prepare('SELECT * FROM inscripciones_piscina INNER JOIN usuarios ON inscripciones_piscina.id_usuario = usuarios.id ORDER BY fecha_inscripcion ' . $order." ".$limit);
            $stmt->execute($parametros);
            $datos = $stmt->fetchAll();
            foreach ($datos as $num => $d) {
                unset($datos[$num]['contraseña']);
            }
            return $datos;
        }
    }

    function countPiscina($filtros) {
        $procesado = $this->filtros($filtros);
        
        $condiciones = $procesado['condiciones'];
        $parametros = $procesado['parametros'];
        
        if(count($parametros) > 0){
            $sql = 'SELECT * FROM inscripciones_piscina INNER JOIN usuarios ON inscripciones_piscina.id_usuario = usuarios.id WHERE '.implode(" AND ", $condiciones);
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($parametros);
            $res = $stmt->fetchAll();
            return count($res);
        }
        else{
            $stmt = $this->pdo->query('SELECT * FROM inscripciones_piscina INNER JOIN usuarios ON inscripciones_piscina.id_usuario = usuarios.id');
            $res = $stmt->fetchAll();
            return count($res);
        }
    }
}