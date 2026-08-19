<?php
require_once "config/database.php";
require_once "classes/Aluno.php";
require_once "classes/AlunoRepository.php";

$repository = new AlunoRepository($pdo);

if (
    !isset($_GET["id"]) ||
    !is_numeric($_GET["id"])
) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET["id"];
$alunoBanco = $repository->buscarPorId($id);

if (!$alunoBanco) {
    header("Location: index.php");
    exit;
}

$nome = $alunoBanco["nome"];
$idade = $alunoBanco["idade"];
$matricula = $alunoBanco["matricula"];
$curso = $alunoBanco["curso"];

$erros = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"];
    $idade = $_POST["idade"];
    $matricula = $_POST["matricula"];
    $curso = $_POST["curso"];

    if (trim($nome) === "") $erros[] = "nome obrigatório";
    if (trim($idade) === "" || $idade < 0) {
        $erros[] = "Idade inválida";
    }
    if (trim($matricula) === "") $erros[] = "matricula obrigatória";
    if (trim($curso) === "") $erros[] = "curso obrigatório";

    if (empty($erros)) {
        $aluno = new Aluno(
            $nome,
            $idade,
            $matricula,
            $curso
        );

        $repository->atualizar($id, $aluno);

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
        <button type="submit">Salvar alterações</button>
    </form>

</body>

</html>