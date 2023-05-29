<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

class ReservarPistasModel extends \Com\Daw2\Core\BaseModel
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
}
