<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

class InscripcionesModel extends \Com\Daw2\Core\BaseModel {
    function inscribirGym($post){
        $sql = "INSERT INTO inscripciones_gimnasio (id_usuario,nombreCompleto,email,dni,años,localizacion) values (:id_usuario,:nombreCompleto,:email,:dni,:anos,:localizacion)";
        
        var_dump($sql);
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->execute([
            "id_usuario" => $_SESSION['usuario']['id'],
            "nombreCompleto" => $post['nombre'],
            "email" => $post['email'],
            "dni" => $post['dni'],
            "anos" => $post['años'],
            "localizacion" => $post['localizacion'],
        ]);
    }

    function inscribirsePiscina($post){
        $sql = "INSERT INTO inscripciones_piscina (id_usuario,nombreCompleto,email,dni,años,localizacion) values (:id_usuario,:nombreCompleto,:email,:dni,:anos,:localizacion)";
        
        var_dump($sql);
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->execute([
            "id_usuario" => $_SESSION['usuario']['id'],
            "nombreCompleto" => $post['nombre'],
            "email" => $post['email'],
            "dni" => $post['dni'],
            "anos" => $post['años'],
            "localizacion" => $post['localizacion'],
        ]);
    }
}