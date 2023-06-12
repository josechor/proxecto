<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

class LogsModel extends \Com\Daw2\Core\BaseModel
{

    function login($nombre, $contraseña)
    {
        $sql = "SELECT * FROM usuarios WHERE nombre = :username ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            "username" => $nombre
        ]);

        if ($stmt->rowCount() == 1) {

            $userDates = $stmt->fetchAll()[0];
            if (password_verify($contraseña, $userDates['contraseña'])) {
                unset($userDates['contraseña']);
                return $userDates;
            }
        }
        return null;
    }
    function registrar($post)
    {

        $post['contraseña'] = password_hash($post['contraseña'], PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare('INSERT INTO usuarios(nombre,contraseña,correo,rol) values(?,?,?,?)');
        $stmt->execute([
            $post['nombre'],
            $post['contraseña'],
            $post['correo'],
            2
        ]);
        return false;
    }

    function comprabarCorreo($correo)
    {
        $conf = $this->pdo->prepare('SELECT * FROM usuarios WHERE correo = ?');
        $conf->execute([$correo]);
        if (count($conf->fetchAll()) > 0) {
            return true;
        }
        return false;
    }

    function filtrosUsuarios($filtros)
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
        return array('condiciones' => $condiciones, 'parametros' => $parametros);
    }

    function mostrarUsuarios($filtros, $tamPag)
    {
        $order = "desc";
        if (isset($filtros['order']) && $filtros['order'] == "asc") {
            $order = "asc";
        }

        $pagina = isset($filtros['page']) && $filtros['page'] > 0 ? (int) $filtros['page'] : 1;
        $registroInicial = ($pagina - 1) * $tamPag;
        $limit = "LIMIT $registroInicial, $tamPag";

        $procesado = $this->filtrosUsuarios($filtros);
        $condiciones = $procesado['condiciones'];
        $parametros = $procesado['parametros'];

        if (count($parametros) > 0) {
            $stmt = $this->pdo->prepare('SELECT * FROM usuarios WHERE ' . implode(' AND ', $condiciones) . ' ORDER BY nombre ' . $order . " " . $limit);
            $stmt->execute($parametros);
            return $stmt->fetchAll();
        } else {
            $stmt = $this->pdo->prepare('SELECT * FROM usuarios ORDER BY nombre ' . $order . " " . $limit);
            $stmt->execute($parametros);
            $datos = $stmt->fetchAll();
            foreach ($datos as $num => $d) {
                unset($datos[$num]['contraseña']);
            }
            return $datos;
        }
    }


    function countUsuarios($filtros)
    {
        $procesado = $this->filtrosUsuarios($filtros);

        $condiciones = $procesado['condiciones'];
        $parametros = $procesado['parametros'];

        if (count($parametros) > 0) {
            $sql = 'SELECT * FROM usuarios WHERE ' . implode(" AND ", $condiciones);
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($parametros);
            $res = $stmt->fetchAll();
            return count($res);
        } else {
            $stmt = $this->pdo->query('SELECT * FROM usuarios');
            $res = $stmt->fetchAll();
            return count($res);
        }
    }

    function getAll(){
        $stmt = $this->pdo->query('SELECT * FROM usuarios');
        return count($stmt->fetchAll());
    }

    function borrarUser($get)
    {
        $primero = $this->getAll();
        $stmt = $this->pdo->prepare('DELETE FROM usuarios WHERE id = :id');
        $stmt->execute([
            "id" => $get['id'],
        ]);
        $segundo = $this->getAll();
        if($primero > $segundo){
            return "Borrado con exito";
        }else{
            return "No se ha podido borrar";
        }
    }

    function cambioRol($get){
        $stmt = $this->pdo->prepare('UPDATE usuarios SET rol = :rol WHERE id = :id');
        $stmt->execute([
            "rol" => $get['rol'],
            "id" => $get['id']
        ]);
        return $stmt->fetchAll();
    }
}
