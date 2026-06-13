<?php 

require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../Utils/Response.php';

class LoginController{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function login() {
         $data = json_decode(file_get_contents('php://input'), true);
         $matricula = $data['matricula'];
         $senha = $data['senha'];
         $this->user->login($matricula, $senha);
    }

    public function logout(){
        $this->user->logout();
    }    
    public function index(){
        //Response::json($this->user->login($matr, $senha));
        Response::json(["error" => "Index não existe"], 404);
    }

    public function show($id){
        $user = $this->user->find($id);

        if(!$user){
            Response::json(["error" => "User não encontrado"], 404);
        }
        Response::json($user);
    }
}