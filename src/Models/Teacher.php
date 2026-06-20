<?php

require_once __DIR__ . '/../Config/Database.php';

class Teacher
{
    private $db;

    public function __construct($connection = null)
    {
        if ($connection !== null) {
            $this->db = $connection;
        } else {
            $this->db = Database::connect();
        }
    }

    public function all()
    {
        return $this->db
            ->query('SELECT * FROM professor')
            ->fetchAll(PDO::FETCH_ASSOC);
    }
    public function dataCheck($data)
    {
        if (!$data || empty($data['matricula']) || empty($data['nome']) || empty($data['nivelAcesso'])) {
            Response::json(['error' => "Falta dados para criar professor"], 400);
        }
    }
    public function find($id)
    {
        $stmt = $this->db->prepare('SELECT p.id_professor,
                                           p.matricula,
                                           p.nome,
                                           p.nivelAcesso
                                         FROM professor p 
                                         INNER JOIN usuarios u ON u.id_usuario = p.id_usuario
                                         WHERE p.id_usuario = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data, $user_id)
    {
        $stmt = $this->db->prepare(
            'INSERT INTO professor (matricula,nome,nivelAcesso,id_usuario) VALUES (?,?,?,?)'
        );
        return $stmt->execute([
            $data['matricula'],
            $data['nome'],
            $data['nivelAcesso'],
            $user_id
        ]);
    }

    public function update($id, $data)
    {
        $stmt = $this->db->prepare(
            'UPDATE professor SET matricula = ?,nome = ?,nivelAcesso = ? WHERE id_professor = ?'
        );
        return $stmt->execute([
            $data['matricula'],
            $data['nome'],
            $data['nivelAcesso'],
            $id
        ]);
    }
    public function passUpdate($id, $data)
    {
        $stmt = $this->db->prepare(
            'UPDATE usuarios SET senha_hash = ? WHERE id_usuario = ?'
        );
        return $stmt->execute([
            $data['senha_hash'],
            $id
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare('DELETE FROM professor WHERE id_professor = ?');
        return $stmt->execute([$id]);
    }

    public function setConnection($connection)
    {
        $this->db = $connection;
    }
}
