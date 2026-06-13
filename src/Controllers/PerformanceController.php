<?php 

require_once __DIR__ . '/../Models/Performance.php';
require_once __DIR__ . '/../Utils/Response.php';

class PerformanceController{
    private $performance;

    public function __construct()
    {
        $this->performance = new Performance();
    }

    public function index(){
        Response::json($this->performance->all());
    }

    public function show($id){
        $performance = $this->performance->find($id);

        if(!$performance){
            Response::json(["error" => "Performance não encontrada"], 404);
        }

        Response::json($performance);
    }

    public function store(){
        $data = json_decode(file_get_contents('php://input'), true);

        if (!$data || empty($data['id_aluno']) || empty($data['id_turma']) || empty($data['id_materia']) || empty($data['nota_primeira_prova'])){
            Response::json(['error' => "Dados inválidos "], 400);
        }

        $this->performance->create($data);
        Response::json(["message" => "Desempenho cadastrado com sucesso"], 201);
    }

    public function update($id){
        $data = json_decode(file_get_contents('php://input'), true);

        if(!$this->performance->find($id)){
            Response::json(["error" => "Performance não encontrada"], 404);
        }
        $this->performance->update($id, $data);
        Response::json(["message" => "Performance atualizada"]);        
    }

    public function destroy($id){
        if(!$this->performance->find($id)){
            Response::json(["message" => "Performance não encontrada"], 404);
        }

        $this->performance->delete($id);
        Response::json(["message" => "Performance removida com sucesso"]);
    }
}