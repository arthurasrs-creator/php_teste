<?php
require_once "config/database.php";
require_once "classes/Aluno.php";
require_once "classes/AlunoRepository.php";

session_start();

$repository = new AlunoRepository($pdo);

$indiceEdicao = null;
$alunoEdicao = null;

if (
    isset($_GET["editar"]) &&
    is_numeric($_GET["editar"])
) {

    $id = (int) $_GET["editar"];

    $alunoEdicao = $repository->buscarPorId($id);

    if ($alunoEdicao) {
        $indiceEdicao = $id;

        $nome = $alunoEdicao["nome"];
        $idade = $alunoEdicao["idade"];
        $matricula = $alunoEdicao["matricula"];
        $curso = $alunoEdicao["curso"];
    } else {
        $indiceEdicao = null;
    }
}

if (
    isset($_GET["excluir"]) &&
    is_numeric($_GET["excluir"])
) {
    $id = (int) $_GET["excluir"];

    $repository->excluir($id);

    header("Location: index.php");
    exit;
}



$erros = [];
$aluno = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST["indice"])) {
        $indiceEdicao = (int) $_POST["indice"];
    }

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

    if (empty($erros)) {
        $aluno = new Aluno(
            $nome,
            (int) $idade,
            $matricula,
            $curso
        );

        if (isset($_POST["id"])) {
            $id =  (int) $_POST["id"];

            $repository->atualizar($id, $aluno);
        } else {
            $repository->criar($aluno);
        }
        header("Location: index.php");
        exit;
    }
}

$alunos = $repository->listar();

?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD ALUNOS</title>
</head>

<body>
    <form method="POST">
        <?php if ($indiceEdicao !== null): ?>
            <input type="hidden" name="id" value="<?= $indiceEdicao ?>">

        <?php endif; ?>
        <label>Nome:</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($nome ?? "") ?>">

        <br><br>

        <label>Idade:</label>
        <input type="number" name="idade" value="<?= $idade ?? "" ?>">

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

    <h1>Alunos Cadastrados</h1>
    <?php if (empty($alunos)): ?>
        <p>Sem alunos cadastrados</p>
    <?php else: ?>
        <?php foreach ($alunos as $aluno): ?>
            <h2>ID: <?= htmlspecialchars($aluno["id"]) ?></h2>
            <h2>Nome: <?= htmlspecialchars($aluno["nome"]) ?></h2>
            <h2>Idade: <?= htmlspecialchars($aluno["idade"]) ?></h2>
            <h2>Matricula: <?= htmlspecialchars($aluno["matricula"]) ?></h2>
            <h2>Curso: <?= htmlspecialchars($aluno["curso"]) ?></h2>
            <a href="?editar=<?= $aluno["id"] ?>">Editar</a>
            <a href="?excluir=<?= $aluno["id"] ?>">Excluir</a>
            <hr>
        <?php endforeach; ?>
    <?php endif; ?>

</body>

</html>