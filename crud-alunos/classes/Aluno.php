<?php
class Aluno
{
    private string $nome;
    private int $idade;
    private string $matricula;
    private string $curso;

    public function __construct(
        string $nome,
        int $idade,
        string $matricula,
        string $curso
    ) {
        $this->nome = $nome;
        $this->idade = $idade;
        $this->matricula = $matricula;
        $this->curso = $curso;
    }

    public function getNome(): string
    {
        return $this->nome;
    }
    public function getIdade(): int
    {
        return $this->idade;
    }
    public function getMatricula(): string
    {
        return $this->matricula;
    }
    public function getCurso(): string
    {
        return $this->curso;
    }
} 
?>