<?php 

require_once __DIR__ . '/../Models/Announcement.php';
require_once __DIR__ . '/../Utils/Response.php';

class AnnouncementController{
    private $announcement;

    public function __construct()
    {
        $this->announcement = new Announcement();
    }

    public function index(){
        Response::json($this->announcement->all());
    }

    public function show($id){
        $announcement = $this->announcement->find($id);

        if(!$announcement){
            Response::json(["error" => "Comunicado não encontrado"], 404);
        }

        Response::json($announcement);
    }

    public function store(){
        $data = json_decode(file_get_contents('php://input'), true);
        if (!$data || empty($data['id_professor']) || empty($data['id_turma']) || empty($data['texto_comunicado'])){
            Response::json(['error' => "Dados inválidos "], 400);
        }

        $this->announcement->create($data);
        Response::json(["message" => "Comunicado  cadastrado com sucesso"], 201);
    }

    public function update($id){
        $data = json_decode(file_get_contents('php://input'), true);

        if(!$this->announcement->find($id)){
            Response::json(["error" => "Comunicado não encontrado"], 404);
        }
        $this->announcement->update($id, $data);
        Response::json(["message" => "Comunicado atualizado"]);        
    }

    public function destroy($id){
        if(!$this->announcement->find($id)){
            Response::json(["message" => "Comunicado não encontrada"], 404);
        }

        $this->announcement->delete($id);
        Response::json(["message" => "Comunicado removida com sucesso"]);
    }
}
