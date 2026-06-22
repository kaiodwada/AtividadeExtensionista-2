<?php

require_once __DIR__ . '/../Controllers/LoginController.php';
require_once __DIR__ . '/../Controllers/PerformanceController.php';
require_once __DIR__ . '/../Controllers/MateriaController.php';
require_once __DIR__ . '/../Controllers/AnnouncementController.php';
require_once __DIR__ . '/../Controllers/DirectorController.php';
require_once __DIR__ . '/../Controllers/TeacherController.php';
require_once __DIR__ . '/../Controllers/TurmaController.php';
require_once __DIR__ . '/../Controllers/UserController.php';
require_once __DIR__ . '/../Controllers/StudentController.php';
require_once __DIR__ . '/../Middlewares/AuthMiddleware.php';

//Limpa a URI
$request_uri = trim($_SERVER['REQUEST_URI'], '/');

if (strpos($request_uri, 'ProjetoFinal/') === 0) {
    $request_uri = substr($request_uri, 13,); //Retira  ProjetoFinal/
}
// Remover '/public' do início da URI se estiver presente
if (strpos($request_uri, 'public/') === 0) {
    $request_uri = substr($request_uri, 7); // Remove 'public/'
}
// Remove '/api' da uri se estiver presente
if (strpos($request_uri, 'api/') === 0) {
    $request_uri = substr($request_uri, 4); // Remove 'api/'
}

$uri = explode('/', trim($request_uri, '/'));
$method = $_SERVER['REQUEST_METHOD'];

if ($uri[0] === 'login' && $method === 'POST') {
    $auth = new LoginController();
    $auth->login();
    exit;
}

if ($uri[0] === 'logout' && $method === 'GET') {
    $auth = new LoginController();
    $auth->logout();
    exit;
}
if ($uri[0] === 'usuario' && $method === 'GET') {
    $user = new UserController();
    $user->show($uri[1]);
    exit;
}

if ($uri[0] === 'usuario' && $method === 'POST') {
    $user = new UserController();
    $user->store();
    exit;
}

if ($uri[0] === 'turma' && $method === 'POST') {
    $user = new TurmaController();
    $user->store();
    exit;
}

if ($uri[0] === 'turma' && $method === 'GET') {
    $user = new TurmaController();
    $user->index();
    exit;
}

if ($uri[0] === 'performance' && $method === 'POST') {
    $user = new PerformanceController();
    $user->store();
    exit;
}

if ($uri[0] === 'performance' && $method === 'GET') {
    $user = new PerformanceController();
    $user->show($uri[1]);
    exit;
}
if ($uri[0] === 'performance' && $method === 'PUT') {
    $user = new PerformanceController();
    $user->update($uri[1]);
    exit;
}

if ($uri[0] === 'updateDesempenho' && $method === 'GET') {
    $user = new PerformanceController();
    $user->index($uri[1]);
    exit;        
}

if ($uri[0] === 'comunicado' && $method === 'POST') {
    $user = new AnnouncementController();
    $user->store();
    exit;
}

if ($uri[0] === 'comunicado' && $method === 'GET') {
    $user = new AnnouncementController();
    $user->index($uri[1]);
    exit;
}
if ($uri[0] === 'comunicado' && $method === 'PUT') {
    $user = new AnnouncementController();
    $user->update($uri[1]);
    exit;
}

if ($uri[0] === 'materia' && $method === 'POST') {
    $user = new MateriaController();
    $user->store();
    exit;
}

if ($uri[0] === 'materia' && $method === 'GET') {
    $user = new MateriaController();
    $user->index();
    exit;
}
if ($uri[0] === 'materias' && $method === 'GET') {
    $user = new TeacherController();
    $user->showSubjects($uri[1]);
    exit;
}
if ($uri[0] === 'alunoComunicados' && $method === 'GET') {
    $user = new StudentController();
    $user->returnAnnoun($uri[1]);
    exit;
}

if ($uri[0] === 'meuPerfil' && $method === 'GET') {
    switch ($uri[2]) {
        case 'Diretor':
            $user = new DirectorController();
            $user->show($uri[1]);
            exit;
        case 'Aluno':
            $user = new StudentController();
            $user->show($uri[1]);
            exit;
        case 'Professor':
            $user = new TeacherController();
            $user->show($uri[1]);
            exit;
    }
}
if ($uri[0] === 'meuPerfil' && $method === 'PUT') {
    switch ($uri[2]) {
        case 'Diretor':
            $user = new DirectorController();
            $user->show($uri[1]);
            exit;
        case 'Aluno':
            $user = new StudentController();
            $user->show($uri[1]);
            exit;
        case 'Professor':
            $user = new TeacherController();
            $user->newPassword($uri[1]);
            exit;
    }
}
if ($uri[0] === 'aluno' && $method === 'GET') {
    $user = new StudentController();
    $user->index();
    exit;
}
if ($uri[0] === 'professor' && $method === 'GET') {
    $user = new TeacherController();
    $user->index();
    exit;
}

if($uri[0] === 'desativarUsuario' && $method === 'PUT'){
    $user = new UserController();
    $user->desactivate($uri[1]);
    exit;
}


//Descobre o tipo de controller usando operador ternário
$get_controller = isset($uri[0]) ? trim($uri[0]) : '';

if (empty($get_controller)) {
    Response::json(["error" => "Rota inválida"], 400);
}

$actual_controller = ucfirst($get_controller) . 'Controller';

$map = [
    'diretor' => 'DirectorController',
    'materia' => 'MateriaController'
];

if (array_key_exists($get_controller, $map)) {
    $actual_controller = $map[$get_controller];
}

//Pega o nome do arquivo http://localhost/ProjetoFinal/src/Controllers/
$fileController = __DIR__ . '/../Controllers/' . $actual_controller . '.php';

//Verifica se existe o arquivo
if (!file_exists($fileController)) {
    Response::json(["error" => "Controller não possui definição"], 404);
}
// Pega o arquivo
require_once $fileController;

$controller = new $actual_controller();

AuthMiddleware::check();

switch ($method) {
    case 'GET':
        if (isset($uri[1])) {
            if (method_exists($controller, 'show')) {
                $controller->show($uri[1]);
            } else {
                Response::json(["error" => "Método não existe"], 405);
            }
        } else {
            $controller->index();
        }
        break;
    case 'POST':
        $controller->store();
        break;
    case 'PUT':
        if (isset($uri[1])) {
            $controller->update($uri[1]);
        } else {
            Response::json(["error" => "ID do diretor fornecido"], 400);
        }
        break;
    case 'DELETE':
        if (isset($uri[1])) {
            $controller->destroy($uri[1]);
        } else {
            Response::json(["error" => "ID do diretor não fornecido"], 400);
        }
        break;
}

Response::json(["error" => "Metodo não encontrado"], 400);
