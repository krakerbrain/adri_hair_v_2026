<?php
/**
 * Receptor de publicaciones (API Endpoint) para el sitio cliente Adri Hair Style
 */

header('Content-Type: application/json');

// 1. Validar método POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'error' => 'Método no permitido. Debe ser POST.']);
    exit();
}

// 2. Validar API Key de seguridad
$headers = getallheaders();
$apiKey = $headers['X-API-Key'] ?? $headers['x-api-key'] ?? '';

// API Key configurada para Adri Hair Style
define('API_KEY', 'adri_secret_site_key_2026');

if ($apiKey !== API_KEY) {
    http_response_code(401);
    echo json_encode(['ok' => false, 'error' => 'API Key no válida o ausente. Acceso denegado.']);
    exit();
}

// 3. Obtener el payload JSON enviado por la plataforma
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!$data || empty($data['titulo']) || empty($data['texto'])) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'Datos inválidos o incompletos para publicar.']);
    exit();
}

// 4. Persistencia local: Guardar el post en un archivo posts.json
// En producción, aquí podrías insertar el registro en una base de datos MySQL (ej: tabla "posts")
$postsFile = __DIR__ . '/posts.json';
$posts = [];

if (file_exists($postsFile)) {
    $existingContent = file_get_contents($postsFile);
    $posts = json_decode($existingContent, true) ?: [];
}

// Generar estructura de post con fecha y id único
$nuevoPost = [
    'id' => uniqid('post_'),
    'titulo' => $data['titulo'],
    'texto' => $data['texto'],
    'imagen_url' => $data['imagen_url'],
    'nombre_autor' => $data['nombre_autor'] ?? 'Autor',
    'foto_autor_url' => $data['foto_autor_url'] ?? '',
    'fuente_titulo' => $data['fuente_titulo'] ?? '',
    'fuente_texto' => $data['fuente_texto'] ?? '',
    'color_primario' => $data['color_primario'] ?? '',
    'color_texto' => $data['color_texto'] ?? '',
    'fecha_publicacion' => date('Y-m-d H:i:s')
];

// Insertar el nuevo post al inicio del listado
array_unshift($posts, $nuevoPost);

// Guardar los datos en el archivo
if (file_put_contents($postsFile, json_encode($posts, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) === false) {
    http_response_code(500);
    echo json_encode(['ok' => false, 'error' => 'No se pudo escribir el archivo posts.json en el servidor de destino.']);
    exit();
}

// 5. Responder éxito a la plataforma
echo json_encode(['ok' => true]);
