<?php

require_once __DIR__ . '/../Config/Database.php';

class Turma {
    private $db;

    public function __construct()
    {
       $this->db = Database::connect();
    }

    public function all(){
        return $this->db 
        ->query('SELECT t.id_turma,
                        t.nomeTurma,
                        t.id_professor,
                        p.id_professor,
                        p.nome
                 FROM turma as t 
                 INNER JOIN professor as p ON t.id_professor = p.id_professor')
        ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id){
        $stmt = $this->db->prepare('SELECT * FROM turma WHERE id_turma = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data){
        $stmt = $this->db->prepare(
            'INSERT INTO turma (nomeTurma,id_professor) VALUES (?,?)'
        );
        return $stmt->execute([
            $data['nomeTurma'],
            $data['id_professor']
        ]);
    }

    public function update($id, $data){
        $stmt = $this->db->prepare(
            'UPDATE turma SET id_professor = ? WHERE id_turma = ?'
        );
        return $stmt->execute([
            $data['id_professor'],
            $id
        ]);        
    }

    public function delete($id){
        $stmt = $this->db->prepare('DELETE FROM turma WHERE id_turma = ?');
        return $stmt->execute([$id]);
    }

}