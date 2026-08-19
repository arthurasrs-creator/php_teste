<?php 
require_once "config/database.php";
require_once "classes/Aluno.php";
require_once "classes/AlunoRepository.php";

$repository = new AlunoRepository($pdo);

$erros = [];

$nome = "";
$idade = "";
$matricula = "";
$curso = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nome = $_POST["nome"];
    $idade = $_POST["idade"];
    $matricula = $_POST["matricula"];
    $curso = $_POST["curso"];

    if (trim($nome) === "") $erros[] = "Nome obrigatório";
    if (trim($idade) === "" || $idade < 0){
        $erros[] = "Valor da idade inválida!";
    }
    if (trim($matricula) === "") $erros[] = "Matricula obrigatório";
    if (trim($curso) === "") $erros[] = "Curso obrigatório";

    if(empty($erros)){
        $aluno = new Aluno(
        $nome,
        $idade,
        $matricula,
        $curso
        );

        $repository->criar($aluno);

        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Aluno</title>
</head>
<body>
    <h1>Cadastrar novo aluno</h1>
    <form action="" method="POST">
        <label>Nome: </label>
        <input type="text" name="nome" value="<?= htmlspecialchars($nome) ?>">
        <br><br>
        <label>Idade: </label>
        <input type="number" name="idade" value="<?= htmlspecialchars($idade) ?>">
        <br><br>
        <label>Matricula: </label>
        <input type="text" name="matricula" value="<?= htmlspecialchars($matricula) ?>">
        <br><br>
        <label>Curso: </label>
        <input type="text" name="curso" value="<?= htmlspecialchars($curso) ?>">
        <br><br>
        <button type="submit">Cadastrar</button>
    </form>
    <?php if ($_SERVER["REQUEST_METHOD"] === "POST"): ?>
        <?php foreach ($erros as $erro): ?>
            <p><?= $erro ?></p>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>