<?php

require_once __DIR__ . '/../Config/Database.php';

class Director
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
            ->query('SELECT * FROM diretor')
            ->fetchAll(PDO::FETCH_ASSOC);
    }
    public function dataCheck($data)
    {
        if (
            !$data || empty($data['matricula']) || empty($data['nome']) || empty($data['nivelAcesso'])
            || empty($data['status_conta'])
        ) {
            Response::json(['error' => "Falta dados para criar diretor"], 400);
        }
    }
    public function find($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM diretor WHERE id_diretor = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data, $user_id)
    {
        $stmt = $this->db->prepare(
            'INSERT INTO diretor (matricula,nome,nivelAcesso,id_usuario) VALUES (?,?,?,?)'
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
            'UPDATE diretor SET matricula = ?,nome = ?,nivelAcesso = ? WHERE id_diretor = ?'
        );
        return $stmt->execute([
            $data['matricula'],
            $data['nome'],
            $data['nivelAcesso'],
            $id
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare('DELETE FROM diretor WHERE id_diretor = ?');
        return $stmt->execute([$id]);
    }

    public function setConnection($connection)
    {
        $this->db = $connection;
    }
}
