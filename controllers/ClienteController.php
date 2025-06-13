
<?php
require_once __DIR__ . '/../models/Cliente.php';

class ClienteController {
    public static function index() {
        echo json_encode(Cliente::all());
    }

    public static function show($id) {
        $cliente = Cliente::find($id);
        echo json_encode($cliente ? $cliente : ["error" => "No encontrado"]);
    }

    public static function store() {
        $data = json_decode(file_get_contents("php://input"), true);
        if (!isset($data['nombre_comercial'], $data['rut'], $data['categoria'])) {
            http_response_code(400);
            echo json_encode(["error" => "Datos incompletos"]);
            return;
        }
        echo json_encode(Cliente::create($data));
    }

    public static function update($id) {
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode(Cliente::update($id, $data));
    }

    public static function destroy($id) {
        echo json_encode(Cliente::delete($id));
    }
}
?>
