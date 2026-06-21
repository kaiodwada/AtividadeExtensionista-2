<?php

require_once __DIR__ . '/../Models/Performance.php';
require_once __DIR__ . '/../Utils/Response.php';
require_once __DIR__ . '/UserController.php';

class PerformanceController
{
    private $performance;
    private $user;

    public function __construct()
    {
        $this->performance = new Performance();
        $this->user = new UserController();
    }

    public function index($id)
    {
        $id_professor = $this->returnProfessor($id);

        if ($id_professor) {
            $id = $id_professor['id_professor'];
        } else {
            Response::json(["error" => "Professor não encontrado",], 401);
        }

        Response::json($this->performance->all($id));
    }

    public function returnProfessor($id)
    {
        return $this->user->returnTeacher($id);
    }

    public function show($id)
    {
        $performance = $this->performance->find($id);

        if (!$performance) {
            Response::json(["error" => "Performance não encontrada"], 401);
        }

        Response::json($performance);
    }

    public function store()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (!$data || empty($data['id_aluno']) || empty($data['id_turma']) || empty($data['id_materia']) || empty($data['nota_primeira_prova'])) {
            Response::json(['error' => "Dados inválidos "], 400);
        }

        $this->performance->create($data);
        Response::json(["message" => "Desempenho cadastrado com sucesso"], 201);
    }

    public function update($id)
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (!$this->performance->returnOne($id)) {
            Response::json(["error" => "Performance não encontrada"], 401);
        }
        $this->performance->update($id, $data);
        Response::json(["message" => "Performance atualizada"], 200);
    }

    public function destroy($id)
    {
        if (!$this->performance->returnOne($id)) {
            Response::json(["message" => "Performance não encontrada"], 401);
        }

        $this->performance->delete($id);
        Response::json(["message" => "Performance removida com sucesso"], 200);
    }
}
