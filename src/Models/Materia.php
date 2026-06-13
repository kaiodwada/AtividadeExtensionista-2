<?php

require_once __DIR__ . '/../Config/Database.php';

class Materia {
    private $db;

    public function __construct()
    {
       $this->db = Database::connect();
    }

    public function all(){
        return $this->db 
        ->query('SELECT m.id_materia,
                        m.nomeMateria,
                        m.id_professor,
                        p.id_professor,
                        p.matricula,
                        p.nome,
                        p.nivelAcesso
                 FROM materias as m
                 INNER JOIN professor as p ON m.id_materia = p.id_professor')
        ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id){
        $stmt = $this->db->prepare('SELECT * FROM materias WHERE id_materia = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data){
        $stmt = $this->db->prepare(
            'INSERT INTO materias (nomeMateria,id_professor) VALUES (?,?)'
        );
        return $stmt->execute([
            $data['nomeMateria'],
            $data['id_professor']
        ]);
    }

    public function update($id, $data){
        $stmt = $this->db->prepare(
            'UPDATE materias SET nomeMateria = ?,id_professor = ? WHERE id_materia = ?'
        );
        return $stmt->execute([
            $data['nomeMateria'],
            $data['id_professor'],
            $id
        ]);        
    }

    public function delete($id){
        $stmt = $this->db->prepare('DELETE FROM materias WHERE id_materia = ?');
        return $stmt->execute([$id]);
    }
}