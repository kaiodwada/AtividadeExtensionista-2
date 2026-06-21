<?php

require_once __DIR__ . '/../Config/Database.php';

class Performance
{
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function all($id)
    {
        $stmt = $this->db->prepare('SELECT d.id_desempenho,
	                                       a.nome,
                                           a.tipoEnsino,
                                           t.nomeTurma,
                                           m.nomeMateria,
                                           d.nota_primeira_prova,
                                           d.nota_segunda_prova,
                                           ROUND((d.nota_primeira_prova + d.nota_segunda_prova) / 2, 1) AS media_atual
                                FROM desempenhoprovas d 
                                INNER JOIN aluno a ON a.id_aluno = d.id_aluno
                                INNER JOIN materias m ON m.id_materia = d.id_materia
                                INNER JOIN turma t ON t.id_turma = d.id_turma
                                INNER JOIN professor p ON p.id_professor = m.id_professor
                                WHERE p.id_professor = ?');
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $stmt = $this->db->prepare('SELECT  m.nomeMateria,
                                            dp.nota_primeira_prova,
                                            dp.nota_segunda_prova,
                                            ROUND((dp.nota_primeira_prova + dp.nota_segunda_prova) / 2, 1) AS Media
                                        FROM desempenhoProvas dp
                                        INNER JOIN aluno a ON dp.id_aluno = a.id_aluno
                                        INNER JOIN materias m ON dp.id_materia = m.id_materia
                                        WHERE a.id_usuario = ?');
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function returnOne($id){
                $stmt = $this->db->prepare('SELECT * from desempenhoprovas 
                                            WHERE id_desempenho = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
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

    public function update($id, $data)
    {
        $stmt = $this->db->prepare(
            'UPDATE desempenhoprovas SET nota_primeira_prova = ?, nota_segunda_prova = ? WHERE id_desempenho = ?'
        );
        return $stmt->execute([
            $data['nota_primeira_prova'],
            $data['nota_segunda_prova'],
            $id
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare('DELETE FROM desempenhoprovas WHERE id_desempenho = ?');
        return $stmt->execute([$id]);
    }
}
