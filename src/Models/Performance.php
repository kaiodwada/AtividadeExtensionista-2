<?php

require_once __DIR__ . '/../Config/Database.php';

class Performance {
    private $db;

    public function __construct()
    {
       $this->db = Database::connect();
    }

    public function all(){
        return $this->db 
        ->query('SELECT * FROM desempenhoprovas')
        ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id){
        $stmt = $this->db->prepare('SELECT * FROM desempenhoprovas WHERE id_desempenho = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data){
        $stmt = $this->db->prepare(
            'INSERT INTO desempenhoprovas (id_aluno,id_turma,id_materia,nota_primeira_prova) VALUES (?,?,?,?)'
        );
        return $stmt->execute([
            $data['id_aluno'],
            $data['id_turma'],
            $data['id_materia'],
            $data['nota_primeira_prova']
        ]);
    }

    public function update($id, $data){
        $stmt = $this->db->prepare(
            'UPDATE desempenhoprovas SET nota_segunda_prova = ? WHERE id_desempenho = ?'
        );
        return $stmt->execute([
            $data['nota_segunda_prova'],
            $id
        ]);        
    }

    public function delete($id){
        $stmt = $this->db->prepare('DELETE FROM desempenhoprovas WHERE id_desempenho = ?');
        return $stmt->execute([$id]);
    }

}