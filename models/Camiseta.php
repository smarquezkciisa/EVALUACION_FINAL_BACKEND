
<?php
require_once __DIR__ . '/../database/conexion.php';

class Camiseta {
    public static function all() {
        $stmt = Database::connect()->query("SELECT * FROM camisetas");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id) {
        $stmt = Database::connect()->prepare("SELECT * FROM camisetas WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO camisetas (titulo, club, pais, tipo, color, precio, detalles, codigo_producto, precio_oferta) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['titulo'], $data['club'] ?? null, $data['pais'] ?? null,
            $data['tipo'] ?? null, $data['color'] ?? null,
            $data['precio'], $data['detalles'] ?? null,
            $data['codigo_producto'], $data['precio_oferta'] ?? null
        ]);
        return self::find($db->lastInsertId());
    }

    public static function update($id, $data) {
        $camiseta = self::find($id);
        if (!$camiseta) return ["error" => "No encontrada"];
        $stmt = Database::connect()->prepare("UPDATE camisetas SET titulo = ?, club = ?, pais = ?, tipo = ?, color = ?, precio = ?, detalles = ?, codigo_producto = ?, precio_oferta = ? WHERE id = ?");
        $stmt->execute([
            $data['titulo'] ?? $camiseta['titulo'],
            $data['club'] ?? $camiseta['club'],
            $data['pais'] ?? $camiseta['pais'],
            $data['tipo'] ?? $camiseta['tipo'],
            $data['color'] ?? $camiseta['color'],
            $data['precio'] ?? $camiseta['precio'],
            $data['detalles'] ?? $camiseta['detalles'],
            $data['codigo_producto'] ?? $camiseta['codigo_producto'],
            $data['precio_oferta'] ?? $camiseta['precio_oferta'],
            $id
        ]);
        return self::find($id);
    }

    public static function delete($id) {
        $stmt = Database::connect()->prepare("DELETE FROM camisetas WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
