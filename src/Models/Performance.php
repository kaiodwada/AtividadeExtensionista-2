<?php

require_once __DIR__ . '/../Config/Database.php';

class Performance
{
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function all()
    {
        return $this->db
            ->query('SELECT a.nome,
                            a.id_aluno,
                            a.tipoEnsino,
                            t.nomeTurma,
                            m.nomeMateria,
                            dp.nota_primeira_prova,
                            dp.nota_segunda_prova,
                            ROUND((dp.nota_primeira_prova + dp.nota_segunda_prova) / 2, 1) AS media_final
                            FROM desempenhoProvas dp
                            INNER JOIN Aluno a ON dp.id_aluno = a.id_aluno
                            INNER JOIN Turma t ON dp.id_turma = t.id_turma
                            INNER JOIN Materias m ON dp.id_materia = m.id_materia
                            ORDER BY t.nomeTurma, a.nome, m.nomeMateria;')
            ->fetchAll(PDO::FETCH_ASSOC);
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
            'UPDATE desempenhoprovas SET nota_segunda_prova = ? WHERE id_desempenho = ?'
        );
        return $stmt->execute([
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
