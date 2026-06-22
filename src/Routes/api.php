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
    $request_uri = substr($request_uri, 13,);
}
if (strpos($request_uri, 'public/') === 0) {
    $request_uri = substr($request_uri, 7);
}
// Remove '/api' da uri se estiver presente
if (strpos($request_uri, 'api/') === 0) {
    $request_uri = substr($request_uri, 4);
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
    $user = new UserController();
    $user->newPassword($uri[1]);
    exit;
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

if ($uri[0] === 'desativarUsuario' && $method === 'PUT') {
    $user = new UserController();
    $user->desactivate($uri[1]);
    exit;
}

if ($uri[0] === 'addNotas' && $method === 'POST') {
    $user = new PerformanceController();
    $user->store();
    exit;
}
