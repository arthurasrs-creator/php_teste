<?php
session_start();

require_once "config/database.php";
require_once "classes/Aluno.php";
require_once "classes/AlunoRepository.php";

$repository = new AlunoRepository($pdo);

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
    
    <?php if (isset($_SESSION["mensagem"])): ?>
        <p><?= htmlspecialchars($_SESSION["mensagem"]) ?></p>
        <?php unset($_SESSION["mensagem"]) ?>
    <?php endif; ?>

    <h1>Alunos Cadastrados</h1>
    <a href="criar.php">Cadastrar novo aluno</a>
    <?php if (empty($alunos)): ?>
        <p>Sem alunos cadastrados</p>
    <?php else: ?>
        <?php foreach ($alunos as $aluno): ?>
            <h2>ID: <?= htmlspecialchars($aluno["id"]) ?></h2>
            <h2>Nome: <?= htmlspecialchars($aluno["nome"]) ?></h2>
            <h2>Idade: <?= htmlspecialchars($aluno["idade"]) ?></h2>
            <h2>Matricula: <?= htmlspecialchars($aluno["matricula"]) ?></h2>
            <h2>Curso: <?= htmlspecialchars($aluno["curso"]) ?></h2>
            <a href="editar.php?id=<?= $aluno["id"] ?>">Editar</a>
            <a href="excluir.php?id=<?= $aluno["id"] ?>">Excluir</a>
            <hr>
        <?php endforeach; ?>
    <?php endif; ?>
</body>

</html>