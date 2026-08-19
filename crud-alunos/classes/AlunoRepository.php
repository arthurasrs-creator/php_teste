<?php
require_once __DIR__ . "/Aluno.php";

class AlunoRepository
{
    private PDO $pdo;

    public function __construct(
        PDO $pdo
    ) {
        $this->pdo = $pdo;
    }

    public function criar(Aluno $aluno): void
    {
        $sql = "
        INSERT INTO alunos (nome, idade, matricula, curso) 
        VALUES(:nome, :idade, :matricula, :curso)
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            "nome" => $aluno->getNome(),
            "idade" => $aluno->getIdade(),
            "matricula" => $aluno->getMatricula(),
            "curso" => $aluno->getCurso()
        ]);
    }

    public function listar(): array
    {
        $sql = "SELECT * FROM alunos";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId(int $id): array|false
    {
        $sql = "SELECT * FROM alunos WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            "id" => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizar(int $id, Aluno $aluno): void
    {
        $sql = "
            UPDATE alunos 
            SET nome = :nome,
                idade = :idade,
                matricula = :matricula,
                curso = :curso
            WHERE id = :id
            ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ":nome" => $aluno->getNome(),
            ":idade" => $aluno->getIdade(),
            ":matricula" => $aluno->getMatricula(),
            ":curso" => $aluno->getCurso(),
            ":id" => $id
        ]);
    }

    public function excluir(int $id): void
    {
        $sql = "DELETE FROM alunos WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            "id" => $id
        ]);
    }
}
