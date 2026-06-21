<?php 

require_once __DIR__ . '/../Models/Teacher.php';
require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../Utils/Response.php';

class TeacherController{
    private $professor;
    private $user;

    public function __construct()
    {
        $this->professor = new Teacher();
        $this->user = new User();
    }

    public function index(){
        Response::json($this->professor->all());
    }

    public function showSubjects($id){
        $id_prof_user = $this->user->returnTeacher($id);

        if($id_prof_user){
            $id_real = $id_prof_user['id_professor'];
        }else{
            Response::json(["error" => "Professor não encontrado",], 401);
        }
        $objMaterias = $this->professor->teacherSubjects($id_real);
        Response::json($objMaterias);
    }

    public function show($id){
        $professor = $this->professor->find($id);

        if(!$professor){
            Response::json(["error" => "Professor não encontrado"], 404);
        }

        Response::json($professor);
    }

    public function store($data, $user_id){
        //$data = json_decode(file_get_contents('php://input'), true);

        if (!$data || empty($data['matricula']) || empty($data['nome']) || empty($data['nivelAcesso']) || empty($user_id)){
            Response::json(['error' => "Dados inválidos"], 400);
        }

        $this->professor->create($data, $user_id);
        Response::json(["message" => "Professor cadastrado com sucesso"], 201);
    }

    public function update($id){
        $data = json_decode(file_get_contents('php://input'), true);

        if(!$this->professor->find($id)){
            Response::json(["error" => "Professor não encontrado"], 404);
        }
        $this->professor->update($id, $data);
        Response::json(["message" => "Professor atualizado"]);        
    }

    public function newPassword($id){
        $data = json_decode(file_get_contents('php://input'), true);

        if(!$this->user->find($id)){
            Response::json(["error" => "Professor não encontrado"], 404);
        }
        $this->professor->passUpdate($id, $data);

        Response::json(["message" => "Professor atualizado"]);   
    }

    public function destroy($id){
        if(!$this->professor->find($id)){
            Response::json(["message" => "Professor não encontrado"], 404);
        }

        $this->professor->delete($id);
        Response::json(["message" => "Professor removido com sucesso"]);
    }
}