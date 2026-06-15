<?php 

require_once __DIR__ . '/../Models/Student.php';
require_once __DIR__ . '/../Utils/Response.php';

class StudentController{
    private $student;

    public function __construct()
    {
        $this->student = new Student();
    }

    public function index(){
        Response::json($this->student->all());
    }

    public function show($id){
        $student = $this->student->find($id);
        if(!$student){
            Response::json(["error" => "Aluno não encontrado"], 404);
        }
        Response::json($student);
    }

    public function store($data, $user_id){
        //$data = json_decode(file_get_contents('php://input'), true);

        if (!$data || empty($data['matricula']) || empty($data['nome']) || empty($data['nivelAcesso']) || empty($user_id)){
            Response::json(['error' => "Dados inválidos"], 400);
        }

        $this->student->create($data, $user_id);
        Response::json(["message" => "Aluno cadastrado com sucesso"], 201);
    }

    public function update($id){
        $data = json_decode(file_get_contents('php://input'), true);

        if(!$this->student->find($id)){
            Response::json(["error" => "Aluno não encontrado"], 404);
        }
        $this->student->update($id, $data);
        Response::json(["message" => "Aluno atualizado"]);        
    }

    public function destroy($id){
        if(!$this->student->find($id)){
            Response::json(["message" => "Aluno não encontrado"], 404);
        }

        $this->student->delete($id);
        Response::json(["message" => "Aluno removido com sucesso"]);
    }
}