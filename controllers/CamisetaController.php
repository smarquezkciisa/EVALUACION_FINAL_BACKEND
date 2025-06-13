
<?php
require_once __DIR__ . '/../models/Camiseta.php';

class CamisetaController {
    public static function index() {
        echo json_encode(Camiseta::all());
    }

    public static function show($id) {
        $camiseta = Camiseta::find($id);
        echo json_encode($camiseta ? $camiseta : ["error" => "No encontrada"]);
    }

    public static function store() {
        $data = json_decode(file_get_contents("php://input"), true);
        if (!isset($data['titulo'], $data['precio'], $data['codigo_producto'])) {
            http_response_code(400);
            echo json_encode(["error" => "Datos incompletos"]);
            return;
        }
        echo json_encode(Camiseta::create($data));
    }

    public static function update($id) {
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode(Camiseta::update($id, $data));
    }

    public static function destroy($id) {
        echo json_encode(Camiseta::delete($id));
    }
}
?>
