<?php

require_once __DIR__ . '/../Config/Database.php';

class Student
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
            ->query('SELECT a.nome,
                            a.matricula,
                            a.idade,
                            a.tipoEnsino,
                            a.nivelAcesso,
                            a.id_usuario,
                            u.tipo_usuario,
                            u.status_conta,
                            u.id_usuario,
                            u.data_criacao
                    FROM aluno as a 
                    INNER JOIN usuarios u ON u.id_usuario = a.id_usuario')
            ->fetchAll(PDO::FETCH_ASSOC);
    }
    public function dataCheck($data)
    {
        if (
            !$data || empty($data['matricula']) || empty($data['nome']) || empty($data['idade']) || empty($data['tipoEnsino']) || empty($data['nivelAcesso'])
            || empty($data['status_conta'] || empty($data['id_turma']))
        ) {
            Response::json(['error' => "Falta dados para criar aluno"], 400);
        }
    }
    public function find($id)
    {
        $stmt = $this->db->prepare('SELECT a.id_aluno,
                                           a.matricula,
                                           a.nome,
                                           a.idade,
                                           a.tipoEnsino,
                                           a.nivelAcesso,
                                           a.id_turma,
                                           a.id_usuario,
                                           u.id_usuario,
                                           u.matricula_usuario,
                                           u.senha_hash,
                                           u.tipo_usuario,
                                           u.status_conta,
                                           u.data_criacao,
                                           t.id_turma,
                                           t.nomeTurma,
                                           t.id_professor
                                    FROM aluno as a
                                    INNER JOIN usuarios as u ON u.id_usuario = ?
                                    INNER JOIN turma t ON a.id_turma = t.id_turma');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data, $user_id)
    {
        $stmt = $this->db->prepare(
            'INSERT INTO aluno (matricula,nome,idade,tipoEnsino,nivelAcesso,id_turma,id_usuario) VALUES (?,?,?,?,?,?,?)'
        );
        return $stmt->execute([
            $data['matricula'],
            $data['nome'],
            $data['idade'],
            $data['tipoEnsino'],
            $data['nivelAcesso'],
            $data['id_turma'],
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

    public function returnAnnoun($id)
    {
        $stmt = $this->db->prepare('SELECT c.titulo,
                                           c.info_status, 
                	                       c.texto_comunicado,
                                           c.data_envio,
                                           p.nome
                                    FROM comunicados as c
                                    INNER JOIN aluno a ON a.id_turma = c.id_turma
                                    INNER JOIN turma t ON t.id_turma = c.id_turma
                                    INNER JOIN professor p ON p.id_professor = c.id_professor
                                    WHERE a.id_aluno = ?');
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function setConnection($connection)
    {
        $this->db = $connection;
    }
}
