<?php
$usuario = ["nome" => "Arthur", "idade" => 22, "profissao" => "Programador/Professor"];
$linguagens = ["PHP", "Java", "Python", "Javascript"];

function verificarStatus(int $idade): string
{
    if ($idade >= 18) return "Maior de Idade";
    return "Menor de Idade";
}
$usuario["status"] = verificarStatus($usuario["idade"]);

$aluno = ["nome" => "Liduino", "nota1" => 1, "nota2" => 9];

function calcularMedia(float $nota1, float $nota2): float
{
    return ($nota1 + $nota2) / 2;
}
function situacao(float $media): string
{
    if ($media >= 7) {
        return "APROVADO";
    } elseif ($media >= 5) {
        return "RECUPERAÇÃO";
    } elseif ($media >= 0) {
        return "REPROVADO";
    }
    return "VALOR INVÁLIDO!";
}

$aluno["media"] = calcularMedia($aluno["nota1"], $aluno["nota2"]);
$aluno["situacao"] = situacao($aluno["media"]);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h1>Linguagens</h1>
    <?php foreach ($linguagens as $linguagem): ?>
        <h3><?= $linguagem ?></h3>
    <?php endforeach; ?>
    <?php foreach ($usuario as $chave => $valor): ?>
        <h2><?= $chave ?>: <?= $valor ?></h2>
    <?php endforeach; ?>
    <?php foreach ($aluno as $chave => $valor): ?>
        <h2><?= $chave ?>: <?= $valor ?></h2>
    <?php endforeach; ?>
</body>

</html>