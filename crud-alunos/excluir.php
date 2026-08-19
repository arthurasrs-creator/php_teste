<?php 
require_once "config/database.php";
require_once "classes/AlunoRepository.php";

$repository = new AlunoRepository($pdo);

if(
    !isset($_GET["id"]) ||
    !is_numeric($_GET["id"])
){
    header("Location: index.php");
    exit;
    }
    
    $id = (int) $_GET["id"];
    
    $aluno = $repository->buscarPorId($id);

    if(!$aluno){
        header("Location: index.php");
        exit;
    }

    $repository->excluir($id);
    
    header("Location: index.php");
    exit;

?>