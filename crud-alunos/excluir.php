<?php 
session_start();

require_once "config/database.php";
require_once "classes/AlunoRepository.php";
require_once "classes/AlunoController.php";

$repository = new AlunoRepository($pdo);
$controller = new AlunoController($repository);

if(
    !isset($_GET["id"]) ||
    !is_numeric($_GET["id"])
){
    header("Location: index.php");
    exit;
    }
    
    $id = (int) $_GET["id"];
    
    $erros = $controller->excluir($id);  
    
    $_SESSION["mensagem"] = "Aluno excluído com sucesso!";
    
    header("Location: index.php");
    exit;

?>