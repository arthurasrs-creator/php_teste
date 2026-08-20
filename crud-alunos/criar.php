<?php 
session_start();

require_once "config/database.php";
require_once "classes/Aluno.php";
require_once "classes/AlunoRepository.php";
require_once "classes/AlunoController.php";

$repository = new AlunoRepository($pdo);
$controller = new AlunoController($repository);

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

    $aluno = new Aluno(
        $nome,
        (int) $idade,
        $matricula,
        $curso
    );

    $erros = $controller->criar($aluno);

    if(empty($erros)){
        $_SESSION["mensagem"] = "Aluno criado com sucesso!";
        
        header("Location: index.php");
        exit;
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