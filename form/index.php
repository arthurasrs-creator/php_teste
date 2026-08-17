<?php
class Aluno{
    private string $nome;
    private int $idade;
    private string $matricula;
    private string $curso;

    public function __construct(
        string $nome,
        int $idade,
        string $matricula,
        string $curso
    ){
        $this->nome = $nome;
        $this->idade = $idade;
        $this->matricula = $matricula;
        $this->curso = $curso;
    }

    public function getNome(): string{
        return $this->nome; 
    }
    public function getIdade(): string{
        return $this->idade; 
    }
    public function getMatricula(): string{
        return $this->matricula; 
    }
    public function getCurso(): string{
        return $this->curso; 
    }
}

$erros = [];
$aluno = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome =  $_POST["nome"];
    $idade =  $_POST["idade"];
    $matricula =  $_POST["matricula"];
    $curso =  $_POST["curso"];
    if (trim($nome) === "") $erros[] = "Nome obrigatório";
    if (trim($idade) === "" || $idade < 0) {
        $erros[] = "Valor da idade inválida!";
    }
    if (trim($matricula) === "") $erros[] =  "Matricula obrigatória";
    if (trim($curso) === "") $erros[] = "Curso obrigatório";
    if(empty($erros)){
        $aluno = new Aluno(
            $nome,
            (int) $idade,
            $matricula,
            $curso
        );
    }
}

?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="POST">
        <label>Nome:</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($nome ?? "") ?>">

        <br><br>

        <label>Idade:</label>
        <input type="number" name="idade" value="<?= htmlspecialchars($idade ?? "") ?>">

        <br><br>

        <label>Matrícula</label>
        <input type="text" name="matricula" value="<?= htmlspecialchars($matricula ?? "") ?>">

        <br><br>

        <label>Curso</label>
        <input type="text" name="curso" value="<?= htmlspecialchars($curso ?? "") ?>">

        <br><br>

        <button type="submit">Enviar</button>
    </form>
    <?php if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($erros)): ?>
        <?php foreach ($erros as $erro): ?>
            <p><?= $erro ?></p>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if ($aluno !== null): ?>
        <h1>Aluno Cadastrado</h1>
        <h2>Nome: <?= htmlspecialchars($aluno->getNome())  ?></h2>
        <h2>Idade: <?= htmlspecialchars($aluno->getIdade()) ?></h2>
        <h2>Matricula: <?= htmlspecialchars($aluno->getMatricula()) ?></h2>
        <h2>Curso: <?= htmlspecialchars($aluno->getCurso()) ?></h2>
    <?php endif; ?>
</body>

</html>