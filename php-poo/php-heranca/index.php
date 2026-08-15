<?php
interface Apresentavel{
    public function apresentar() : string;
}

abstract class Pessoa{
    protected string $nome;
    protected int $idade;

    public function __construct(
        string $nome,
        int $idade
    ){
        $this->nome = $nome;
        $this->idade = $idade;
    }
}

class Aluno extends Pessoa implements Apresentavel{
    private string $matricula;
    private string $curso;

    public function __construct(
        string $nome,
        int $idade,
        string $matricula,
        string $curso
    ){
        parent::__construct($nome, $idade);

        $this->matricula = $matricula;
        $this->curso = $curso;
    }

    public function apresentar() : string{
        return "Olá meu nome eh " . $this->nome . ", tenho " . $this->idade . " anos, e curso " . $this->curso . " e minha matricula eh " . $this->matricula;
    }
}
class Professor extends Pessoa implements Apresentavel{
    private string $disciplina;

    public function __construct(
        string $nome,
        int $idade,
        string $disciplina
    ){
        parent::__construct($nome, $idade);
        $this->disciplina = $disciplina;
    }

    public function apresentar(): string{
        return "Olá meu nome eh " . $this->nome . ", tenho " . $this->idade . " sou professor de " . $this->disciplina;
    }
}

class Produto implements Apresentavel{
    private string $nome;
    private float $preco;

    public function __construct(
        string $nome,
        float $preco
    ){
        $this->nome = $nome;
        $this->preco = $preco;
    }

    public function apresentar(): string
    {
        return "Produto: ". $this->nome . " | Preço: " . $this->preco;
    }
}
$aluno = new Aluno("Arthur", 22, "2026015", "Engenharia da Computação");
$professor =  new Professor("Arthur", 23, "Front-end");
$produto =  new Produto("IPhone", 7500);

$itens = [$aluno, $professor, $produto];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php foreach ($itens as $item): ?>
        <h2><?= $item->apresentar() ?></h2>
    <?php endforeach; ?>
</body>
</html>