<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

class PistasModel extends \Com\Daw2\Core\BaseModel
{


    function reservarPistaPadel($fecha)
    {
        $userId = $_SESSION['usuario']['id'];
        $sql = "INSERT INTO reservaPadel (id_usuario, fecha_reserva) VALUES(:id_usuario,:fecha_reserva)";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            "id_usuario" => $userId,
            "fecha_reserva" => date('Y-m-d H:i:s', strtotime($fecha))
        ]);
        return $stmt->fetchAll();
    }
    function comprobarDisponibilidadPadel($fecha)
    {
        $sql = "SELECT * FROM reservaPadel WHERE fecha_reserva = :fecha_reserva ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            "fecha_reserva" => date('Y-m-d H:i:s', strtotime($fecha))
        ]);
        return $stmt->fetchAll();
    }

    function comprobarDisponibilidadTenis($fecha)
    {
        $sql = "SELECT * FROM reservaTenis WHERE fecha_reserva = :fecha_reserva ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            "fecha_reserva" => date('Y-m-d H:i:s', strtotime($fecha))
        ]);
        return $stmt->fetchAll();
    }

    function reservarPistaTenis($fecha)
    {
        $userId = $_SESSION['usuario']['id'];
        $sql = "INSERT INTO reservaTenis (id_usuario, fecha_reserva) VALUES(:id_usuario,:fecha_reserva)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            "id_usuario" => $userId,
            "fecha_reserva" => date('Y-m-d H:i:s', strtotime($fecha))
        ]);
        return $stmt->fetchAll();
    }

    function filtrosPadel($filtros)
    {
        $condiciones = [];
        $parametros = [];

        if (isset($filtros['nombre']) && !empty($filtros['nombre'])) {
            $condiciones[] = 'usuarios.nombre LIKE :nombre';
            $parametros['nombre'] = '%' . $filtros['nombre'] . '%';
        }

        if (isset($filtros['correo']) && !empty($filtros['correo'])) {
            $condiciones[] = 'usuarios.correo LIKE :correo';
            $parametros['correo'] = '%' . $filtros['correo'] . '%';
        }

        if (isset($filtros['fechaMin']) && !empty($filtros['fechaMin'])) {
            $filtros['fechaMin'] .= ":00";
            $filtros['fechaMin'] = str_replace("T", " ", $filtros['fechaMin']);
            $condiciones[] = 'fecha_reserva >= :fechaMin';
            $parametros['fechaMin'] = $filtros['fechaMin'];
        }
        if (isset($filtros['fechaMax']) && !empty($filtros['fechaMax'])) {
            $filtros['fechaMax'] .= ":00";
            $filtros['fechaMax'] = str_replace("T", " ", $filtros['fechaMax']);
            $condiciones[] = 'fecha_reserva <= :fechaMax';
            $parametros['fechaMax'] = $filtros['fechaMax'];
        }

        return array('condiciones' => $condiciones, 'parametros' => $parametros);
    }

    function mostrarReservasPadel($filtros,$tamPag)
    {
        $order = "desc";
        if (isset($filtros['order']) && $filtros['order'] == "fecha_asc") {
            $order = "asc";
        }

        $pagina = isset($filtros['page']) && $filtros['page'] > 0 ? (int) $filtros['page'] : 1;        
        $registroInicial = ($pagina - 1) * $tamPag;        
        $limit = "LIMIT $registroInicial, $tamPag";

        $procesado = $this->filtrosPadel($filtros);
        $condiciones = $procesado['condiciones'];
        $parametros = $procesado['parametros'];

        if (count($parametros) > 0) {
            $stmt = $this->pdo->prepare('SELECT * FROM reservaPadel INNER JOIN usuarios ON reservaPadel.id_usuario = usuarios.id WHERE ' . implode(' AND ', $condiciones) . " ORDER BY fecha_reserva " . $order." ".$limit);
            $stmt->execute($parametros);
            return $stmt->fetchAll();
        } else {
            $stmt = $this->pdo->prepare('SELECT * FROM reservaPadel INNER JOIN usuarios ON reservaPadel.id_usuario = usuarios.id ORDER BY fecha_reserva ' . $order." ".$limit);
            $stmt->execute($parametros);
            $datos = $stmt->fetchAll();
            foreach ($datos as $num => $d) {
                unset($datos[$num]['contraseña']);
            }
            return $datos;
        }
    }

    function countPadel($filtros) {
        $procesado = $this->filtrosPadel($filtros);
        
        $condiciones = $procesado['condiciones'];
        $parametros = $procesado['parametros'];
        
        if(count($parametros) > 0){
            $sql = 'SELECT * FROM reservaPadel INNER JOIN usuarios ON reservaPadel.id_usuario = usuarios.id WHERE '.implode(" AND ", $condiciones);
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($parametros);
            $res = $stmt->fetchAll();
            return count($res);
        }
        else{
            $stmt = $this->pdo->query('SELECT * FROM reservaPadel INNER JOIN usuarios ON reservaPadel.id_usuario = usuarios.id');
            $res = $stmt->fetchAll();
            return count($res);
        }
    }

    

    function countTenis($filtros) {
        $procesado = $this->filtrosPadel($filtros);
        
        $condiciones = $procesado['condiciones'];
        $parametros = $procesado['parametros'];
        
        if(count($parametros) > 0){
            $sql = 'SELECT * FROM reservaTenis INNER JOIN usuarios ON reservaPadel.id_usuario = usuarios.id WHERE '.implode(" AND ", $condiciones);
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($parametros);
            $res = $stmt->fetchAll();
            return count($res);
        }
        else{
            $stmt = $this->pdo->query('SELECT * FROM reservaTenis INNER JOIN usuarios ON reservaPadel.id_usuario = usuarios.id');
            $res = $stmt->fetchAll();
            return count($res);
        }
    }
}
