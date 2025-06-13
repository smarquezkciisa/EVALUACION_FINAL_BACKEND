
<?php
require_once __DIR__ . '/../database/conexion.php';

class Cliente {
    public static function all() {
        $stmt = Database::connect()->query("SELECT * FROM clientes");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id) {
        $stmt = Database::connect()->prepare("SELECT * FROM clientes WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO clientes (nombre_comercial, rut, direccion, categoria, contacto_nombre, contacto_email, porcentaje_oferta) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['nombre_comercial'], $data['rut'],
            $data['direccion'] ?? null,
            $data['categoria'], $data['contacto_nombre'] ?? null,
            $data['contacto_email'] ?? null,
            $data['porcentaje_oferta'] ?? 0
        ]);
        return self::find($db->lastInsertId());
    }

    public static function update($id, $data) {
        $cliente = self::find($id);
        if (!$cliente) return ["error" => "No encontrado"];
        $stmt = Database::connect()->prepare("UPDATE clientes SET nombre_comercial=?, rut=?, direccion=?, categoria=?, contacto_nombre=?, contacto_email=?, porcentaje_oferta=? WHERE id=?");
        $stmt->execute([
            $data['nombre_comercial'] ?? $cliente['nombre_comercial'],
            $data['rut'] ?? $cliente['rut'],
            $data['direccion'] ?? $cliente['direccion'],
            $data['categoria'] ?? $cliente['categoria'],
            $data['contacto_nombre'] ?? $cliente['contacto_nombre'],
            $data['contacto_email'] ?? $cliente['contacto_email'],
            $data['porcentaje_oferta'] ?? $cliente['porcentaje_oferta'],
            $id
        ]);
        return self::find($id);
    }

    public static function delete($id) {
        $stmt = Database::connect()->prepare("DELETE FROM clientes WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
