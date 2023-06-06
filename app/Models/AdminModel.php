<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

class AdminModel extends \Com\Daw2\Core\BaseModel {
    function getAll(): array {
        $stmt = $this->pdo->query('SELECT * FROM tarifas');
        return $stmt->fetchAll();
    }
}