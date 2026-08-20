<?php
require_once __DIR__ . "/Aluno.php";
require_once __DIR__ . "/AlunoRepository.php";

class AlunoController
{
    private AlunoRepository $repository;

    public function __construct(
        AlunoRepository $repository
    ) {
        $this->repository = $repository;
    }

    public function validarDados(Aluno $aluno): array
    {
        $erros = [];

        if (trim($aluno->getNome()) === "") $erros[] = "Nome obrigatório";
        if ($aluno->getIdade() <= 0) {
            $erros[] = "Idade Inválida";
        }
        if (trim($aluno->getMatricula()) === "") $erros[] = "Matricula obrigatória";
        if (trim($aluno->getCurso()) === "") $erros[] = "Curso obrigatório";

        return $erros;
    }

    public function criar(Aluno $aluno): array
    {
        $erros = $this->validarDados($aluno);

        if (!empty($erros)) {
            return $erros;
        }
        $this->repository->criar($aluno);

        return [];
    }

    public function atualizar(
        int $id,
        Aluno $aluno
    ): array {

        $alunoBanco = $this->repository->buscarPorId($id);

        if (!$alunoBanco) {
            return ["Aluno não encontrado!"];
        }

        $erros = $this->validarDados($aluno);

        if (!empty($erros)) {
            return $erros;
        }
        
        $this->repository->atualizar($id, $aluno);

        return [];
    }

    public function excluir(int $id): array
    {
        $erros = [];

        $alunoBanco = $this->repository->buscarPorId($id);

        if (!$alunoBanco) {
            $erros[] = "Usuario não encontrado!";
        } else {
            $this->repository->excluir($id);
        }

        return $erros;
    }
}
