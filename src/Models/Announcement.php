<?php

require_once __DIR__ . '/../Config/Database.php';

class Announcement {
    private $db;

    public function __construct()
    {
       $this->db = Database::connect();
    }

    public function all(){
        return $this->db 
        ->query('SELECT * FROM comunicados')
        ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id){
        $stmt = $this->db->prepare('SELECT * FROM comunicados WHERE id_comunicado = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data){
        $stmt = $this->db->prepare(
            'INSERT INTO comunicados (id_professor,id_turma,texto_comunicado) VALUES (?,?,?)'
        );
        return $stmt->execute([
            $data['id_professor'],
            $data['id_turma'],
            $data['texto_comunicado']
        ]);
    }

    public function update($id, $data){
        $stmt = $this->db->prepare(
            'UPDATE comunicados SET texto_comunicado = ? WHERE id_comunicado = ?'
        );
        return $stmt->execute([
            $data['texto_comunicado'],
            $id
        ]);        
    }

    public function delete($id){
        $stmt = $this->db->prepare('DELETE FROM comunicados WHERE id_comunicado = ?');
        return $stmt->execute([$id]);
    }
}