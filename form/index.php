<?php
$erros = [];

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
        <input type="text" name="nome" value="<?= $nome ?? "" ?>">

        <br><br>

        <label>Idade:</label>
        <input type="number" name="idade" value="<?= $idade ?? "" ?>">

        <br><br>

        <label>Matrícula</label>
        <input type="text" name="matricula" value="<?= $matricula ?? "" ?>">

        <br><br>

        <label>Curso</label>
        <input type="text" name="curso" value="<?= $curso ?? "" ?>">

        <br><br>

        <button type="submit">Enviar</button>
    </form>
    <?php if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($erros)): ?>
        <?php foreach ($erros as $erro): ?>
            <p><?= $erro ?></p>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if ($_SERVER["REQUEST_METHOD"] === "POST" && empty($erros)): ?>
        <h1>Aluno Cadastrado</h1>
        <h2><?= $nome ?></h2>
        <h2><?= $idade ?></h2>
        <h2><?= $matricula ?></h2>
        <h2><?= $curso ?></h2>
    <?php endif; ?>
</body>

</html>