<?php 

require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../Utils/Response.php';
require_once __DIR__ . '/../Config/Database.php';
require_once __DIR__ . '/../Models/Student.php';
require_once __DIR__ . '/../Models/Teacher.php';

class UserController{
    private $user;
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
        $this->user = new User();
    }

    public function index(){
        Response::json($this->user->all());
    }

    public function show($id){
        $user = $this->user->find($id);

        if(!$user){
            Response::json(["error" => "Usuário não encontrado"], 404);
        }

        Response::json($user);
    }

    public function store(){
        $data = json_decode(file_get_contents('php://input'), true);

        if (!$data || empty($data['matricula_usuario']) || empty($data['senha_hash']) || empty($data['tipo_usuario']) 
            || empty($data['status_conta'])){
            Response::json(['error' => "Dados inválidos para criar usuário"], 400);
        }
        try {
            $this->db->beginTransaction();
            $this->user->setConnection($this->db);
            $user_id = $this->user->create($data);

            switch ($data['tipo_usuario']) {
                case 'Diretor':
                    $diretor = new Director();
                    $diretor->dataCheck($data);
                    $diretor->setConnection($this->db);
                    $diretor->create($data, $user_id);
                    break;
                case 'Aluno':
                    $aluno = new Student();
                    $aluno->dataCheck($data);
                    $aluno->setConnection($this->db);
                    $aluno->create($data, $user_id);
                    break;
                case 'Professor':
                    $professor = new Teacher();
                    $professor->dataCheck($data);
                    $professor->setConnection($this->db);
                    $professor->create($data, $user_id);
                    break;              
            }    
            $this->db->commit();        
        } catch (\Throwable $th) {
            Response::json(["error" => "Problema ao incluir usuario " . $th], 404);
        }
        Response::json(["message" => "Usuário cadastrado com sucesso"], 201);
    }

    public function update($id){
        $data = json_decode(file_get_contents('php://input'), true);

        if(!$this->user->find($id)){
            Response::json(["error" => "Usuário não encontrado"], 404);
        }
        $this->user->update($id, $data);
        Response::json(["message" => "Usuário atualizado"]);        
    }

    public function destroy($id){
        if(!$this->user->find($id)){
            Response::json(["message" => "Usuário não encontrado"], 404);
        }

        $this->user->delete($id);
        Response::json(["message" => "Usuário removido com sucesso"]);
    }
}