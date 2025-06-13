
<?php
header("Content-Type: application/json");

$uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$method = $_SERVER["REQUEST_METHOD"];

// Eliminar prefijo /public si existe
$uri = preg_replace("#^/public#", "", $uri);

require_once __DIR__ . '/../controllers/CamisetaController.php';
require_once __DIR__ . '/../controllers/ClienteController.php';
require_once __DIR__ . '/../controllers/TallaController.php';

// Rutas para Camisetas
if (preg_match("#^/camisetas$#", $uri)) {
    if ($method === 'GET') CamisetaController::index();
    elseif ($method === 'POST') CamisetaController::store();
}
elseif (preg_match("#^/camisetas/([0-9]+)$#", $uri, $matches)) {
    if ($method === 'GET') CamisetaController::show($matches[1]);
    elseif ($method === 'PUT') CamisetaController::update($matches[1]);
    elseif ($method === 'DELETE') CamisetaController::destroy($matches[1]);
}

// Rutas para Clientes
elseif (preg_match("#^/clientes$#", $uri)) {
    if ($method === 'GET') ClienteController::index();
    elseif ($method === 'POST') ClienteController::store();
}
elseif (preg_match("#^/clientes/([0-9]+)$#", $uri, $matches)) {
    if ($method === 'GET') ClienteController::show($matches[1]);
    elseif ($method === 'PUT') ClienteController::update($matches[1]);
    elseif ($method === 'DELETE') ClienteController::destroy($matches[1]);
}

// Rutas para Tallas
elseif (preg_match("#^/tallas$#", $uri)) {
    if ($method === 'GET') TallaController::index();
    elseif ($method === 'POST') TallaController::store();
}
elseif (preg_match("#^/tallas/([0-9]+)$#", $uri, $matches)) {
    if ($method === 'GET') TallaController::show($matches[1]);
    elseif ($method === 'PUT') TallaController::update($matches[1]);
    elseif ($method === 'DELETE') TallaController::destroy($matches[1]);
}

else {
    http_response_code(404);
    echo json_encode(["error" => "Ruta no encontrada"]);
}
?>
