
<?php
require_once __DIR__ . '/../models/Talla.php';

class TallaController {
    public static function index() {
        echo json_encode(Talla::all());
    }

    public static function show($id) {
        $talla = Talla::find($id);
        echo json_encode($talla ? $talla : ["error" => "No encontrada"]);
    }

    public static function store() {
        $data = json_decode(file_get_contents("php://input"), true);
        if (!isset($data['nombre'])) {
            http_response_code(400);
            echo json_encode(["error" => "Nombre requerido"]);
            return;
        }
        echo json_encode(Talla::create($data));
    }

    public static function update($id) {
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode(Talla::update($id, $data));
    }

    public static function destroy($id) {
        echo json_encode(Talla::delete($id));
    }
}
?>
