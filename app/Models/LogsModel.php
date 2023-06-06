<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

class LogsModel extends \Com\Daw2\Core\BaseModel
{

    function login($nombre, $contraseña){
        $sql = "SELECT * FROM usuarios WHERE nombre = :username ";
        
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->execute([
            "username" => $nombre
        ]);
        
        if($stmt->rowCount() == 1){
            
            $userDates = $stmt->fetchAll()[0];
            if(password_verify($contraseña, $userDates['contraseña'])){
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
}
