<?php 

require_once __DIR__ . '/../Models/Director.php';
require_once __DIR__ . '/../Utils/Response.php';

class DirectorController{
    private $diretor;

    public function __construct()
    {
        $this->diretor = new Director();
    }

    public function index(){
        Response::json($this->diretor->all());
    }

    public function show($id){
        $diretor = $this->diretor->find($id);

        if(!$diretor){
            Response::json(["error" => "Diretor não encontrado"], 404);
        }

        Response::json($diretor);
    }

    public function store($data, $user_id){
        //$data = json_decode(file_get_contents('php://input'), true);

        if (!$data || empty($data['matricula']) || empty($data['nome']) || empty($data['nivelAcesso']) || empty($user_id)){
            Response::json(['error' => "Dados inválidos"], 400);
        }

        $this->diretor->create($data, $user_id);
        Response::json(["message" => "Diretor cadastrado com sucesso"], 201);
    }

    public function update($id){
        $data = json_decode(file_get_contents('php://input'), true);

        if(!$this->diretor->find($id)){
            Response::json(["error" => "Diretor não encontrado"], 404);
        }
        $this->diretor->update($id, $data);
        Response::json(["message" => "Diretor atualizado"]);        
    }

    public function destroy($id){
        if(!$this->diretor->find($id)){
            Response::json(["message" => "Diretor não encontrado"], 404);
        }

        $this->diretor->delete($id);
        Response::json(["message" => "Diretor removido com sucesso"]);
    }
}