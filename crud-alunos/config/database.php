<?php 
$caminhoBanco = __DIR__ . "/../database/escola.db";

$pdo = new PDO("sqlite:" . $caminhoBanco);

$pdo->setAttribute(
    PDO::ATTR_ERRMODE,
    PDO::ERRMODE_EXCEPTION
);

$pdo->exec(
    "CREATE TABLE IF NOT EXISTS alunos(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT NOT NULL,
    idade INTEGER NOT NULL,
    matricula TEXT NOT NULL,
    curso TEXT NOT NULL
    )"
);

?>