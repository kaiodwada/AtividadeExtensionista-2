<?php

require_once __DIR__ . '/../Config/Database.php';

class Announcement
{
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function all()
    {
        return $this->db
            ->query('SELECT c.id_professor, 
                            c.id_comunicado,
                            c.id_turma, 
                            c.titulo, 
                            c.info_status, 
                            c.texto_comunicado,
                            c.data_envio,
                            p.id_professor,
                            p.nome,
                            t.nomeTurma,
                            t.id_turma
                    FROM comunicados as c 
                    INNER JOIN professor as p ON p.id_professor = c.id_professor
                    INNER JOIN turma as t ON t.id_turma = c.id_turma')
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM comunicados WHERE id_comunicado = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $stmt = $this->db->prepare(
            'INSERT INTO comunicados (id_professor,id_turma,texto_comunicado, info_status,titulo) VALUES (?,?,?,?,?)'
        );
        return $stmt->execute([
            $data['id_professor'],
            $data['id_turma'],
            $data['texto_comunicado'],
            $data['info_status'],
            $data['titulo']
        ]);
    }

    public function update($id, $data)
    {
        $stmt = $this->db->prepare(
            'UPDATE comunicados SET id_turma = ?, titulo = ?, id_professor = ? ,info_status = ?, texto_comunicado = ? WHERE id_comunicado = ?'
        );
        return $stmt->execute([
            $data['id_turma'],
            $data['titulo'],
            $data['id_professor'],
            $data['info_status'],
            $data['texto_comunicado'],
            $id
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare('DELETE FROM comunicados WHERE id_comunicado = ?');
        return $stmt->execute([$id]);
    }
}
