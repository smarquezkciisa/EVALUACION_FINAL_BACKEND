
<?php
require_once __DIR__ . '/../database/conexion.php';

class Talla {
    public static function all() {
        $stmt = Database::connect()->query("SELECT * FROM tallas");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id) {
        $stmt = Database::connect()->prepare("SELECT * FROM tallas WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO tallas (nombre) VALUES (?)");
        $stmt->execute([$data['nombre']]);
        return self::find($db->lastInsertId());
    }

    public static function update($id, $data) {
        $stmt = Database::connect()->prepare("UPDATE tallas SET nombre = ? WHERE id = ?");
        $stmt->execute([$data['nombre'], $id]);
        return self::find($id);
    }

    public static function delete($id) {
        $stmt = Database::connect()->prepare("DELETE FROM tallas WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
