<?php
class Usuario
{
    private string $nome;
    private int $idade;
    private string $profissao;

    public function __construct(
        string $nome,
        int $idade,
        string $profissao
    ) {
        $this->nome = $nome;
        $this->idade = $idade;
        $this->profissao = $profissao;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome)
    {
        if ($nome === "") {
            return;
        }
        return $this->nome = $nome;
    }

    public function getIdade(): int
    {
        return $this->idade;
    }
    public function setIdade(int $idade){
        if ($idade < 1){
            return;
        }
        return $this->idade = $idade;
    }

    public function getProfissao(): string
    {
        return $this->profissao;
    }

    public function setProfissao(string $profissao)
    {
        if ($profissao === "") {
            return;
        }
        return $this->profissao = $profissao;
    }
    public function apresentar(): string
    {
        return "Olá, meu nome eh " . $this->nome . ", tenho " . $this->idade . " anos e minha profissao eh " . $this->profissao;
    }
}

$usuario = new Usuario("Arthur", 22, "Programador/Professor");
$usuario->setNome("Arthur Simplicio");
$usuario->setIdade(-26);
$usuario->setIdade(26);
$usuario->setProfissao("Criador");
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1><?= $usuario->apresentar() ?></h1>
    <h2><?= $usuario->getNome() ?></h2>
    <h2><?= $usuario->getIdade() ?></h2>
    <h2><?= $usuario->getProfissao() ?></h2>
</body>

</html>