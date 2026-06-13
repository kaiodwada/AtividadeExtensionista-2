<?php 

require_once __DIR__ . '/../Models/Turma.php';
require_once __DIR__ . '/../Utils/Response.php';

class TurmaController{
    private $turma;

    public function __construct()
    {
        $this->turma = new Turma();
    }

    public function index(){
        Response::json($this->turma->all());
    }
/*
    public function show($id){
        $turma = $this->turma->find($id);

        if(!$turma){
            Response::json(["error" => "turma não encontrado"], 404);
        }

        Response::json($turma);
    }
*/
    public function store(){
        $data = json_decode(file_get_contents('php://input'), true);

        if (!$data || empty($data['nomeTurma']) || empty($data['id_professor'])){
            Response::json(['error' => "Dados inválidos para criar turma"], 400);
        }
        $this->turma->create($data);
        Response::json(["message" => "Turma cadastrado com sucesso"], 201);
    }
/*
    public function update($id){
        $data = json_decode(file_get_contents('php://input'), true);

        if(!$this->turma->find($id)){
            Response::json(["error" => "Turma não encontrado"], 404);
        }
        $this->turma->update($id, $data);
        Response::json(["message" => "Turma atualizado"]);        
    }

    public function destroy($id){
        if(!$this->turma->find($id)){
            Response::json(["message" => "Turma não encontrado"], 404);
        }

        $this->turma->delete($id);
        Response::json(["message" => "Turma removido com sucesso"]);
    }
*/    
}