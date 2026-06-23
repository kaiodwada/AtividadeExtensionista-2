<?php 

require_once __DIR__ . '/../Models/Materia.php';
require_once __DIR__ . '/../Utils/Response.php';

class MateriaController{
    private $materia;

    public function __construct()
    {
        $this->materia = new Materia();
    }

    public function index(){
        Response::json($this->materia->all());
    }

    public function show($id){
        $materia = $this->materia->find($id);

        if(!$materia){
            Response::json(["error" => "materia não encontrado"], 404);
        }

        Response::json($materia);
    }

    public function store(){
        $data = json_decode(file_get_contents('php://input'), true);

        if (!$data || empty($data['nomeMateria']) || empty($data['id_professor'])){
            Response::json(['error' => "Dados inválidos"], 400);
        }

        $this->materia->create($data);
        Response::json(["message" => "Materia cadastrado com sucesso"], 201);
    }

    public function update($id){
        $data = json_decode(file_get_contents('php://input'), true);

        if(!$this->materia->find($id)){
            Response::json(["error" => "materia não encontrado"], 404);
        }
        $this->materia->update($id, $data);
        Response::json(["message" => "materia atualizado"]);        
    }

    public function destroy($id){
        if(!$this->materia->find($id)){
            Response::json(["message" => "materia não encontrado"], 404);
        }

        $this->materia->delete($id);
        Response::json(["message" => "materia removido com sucesso"]);
    }
}