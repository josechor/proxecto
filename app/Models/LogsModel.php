<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

class LogsModel extends \Com\Daw2\Core\BaseModel
{
    function registrar($post)
    {
        if (isset($post['correo']) && $post['correo'] != '') {
            $conf = $this->pdo->prepare('SELECT * FROM usuarios WHERE correo = ?');
            $conf->execute([$post['correo']]);
            if (count($conf->fetchAll()) > 0) {
                return array("error" => true, "lugarError"=>"registrarCorreo", "errorMensaje" => "Correo existente");
            }
        } else {
            return array("error" => true, "lugarError"=>"registrarCorreo", "errorMensaje" => "Correo no valido");
        }
        if (isset($post['contraseña']) && $post['contraseña'] != '') {
            $conf = $this->pdo->query('SELECT * FROM usuarios');
            $users = $conf->fetchAll();
            foreach ($users as $user) {
                if (password_verify($post['contraseña'], $user['contraseña'])) {
                    return array("error" => true, "lugarError"=>"registrarContraseña", "errorMensaje" => "contraseña existente");

                }
            }
        } else {
            return array("error" => true, "lugarError"=>"registrarContraseña", "errorMensaje" => "Contraseña no valida");
        }
        $post['contraseña'] = password_hash($post['contraseña'],PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare('INSERT INTO usuarios(nombre,contraseña,correo) values(?,?,?)');
        $stmt->execute([
            $post['nombre'],
            $post['contraseña'],
            $post['correo']

        ]);
        return false;
    }
}
