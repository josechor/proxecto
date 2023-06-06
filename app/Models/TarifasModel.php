<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

class TarifasModel extends \Com\Daw2\Core\BaseModel {
    function getAll(): array {
        $stmt = $this->pdo->query('SELECT * FROM tarifas');
        return $stmt->fetchAll();
    }

    function cambiarTarifa($post) {
        $precioNuevo = $post['precio'];
        $nombre = $post['nombre'];
        $stmt = $this->pdo->prepare("UPDATE tarifas SET precio = :precio where nombre = :nombre");
        $stmt->execute([
            "precio" => $precioNuevo,
            "nombre" => $nombre
        ]);
        return $stmt->fetchAll();
    }

}