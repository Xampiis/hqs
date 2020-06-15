<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["hqs"]["id"] ) ){
    exit;
    }

    //verificar se o id esta vazio
    if ( empty ( $id ) ) {
            echo "<script>alert('Não foi possível excluir o registro');history.back();</script>";
        exit;
    }

    //incluir o arquivo do banco de dados
    include "config/conexao.php";

    //verificar se existe um quadrinho cadastrado com esta editora
    $sql = "SELECT id FROM quadrinho WHERE editora_id = ? LIMIT ";
    //prepara o sql para executar
    $consulta = $pdo->prepare($sql);
    //passar o id do parametro
    $consulta->bindParam(1, $id);
    //executar o sql
    $consulta->execute();
    //recuperar os dados selecionados
    $dados= $consulta->fetch(PDO::FETCH_OBJ);

    //se existir, avisar e voltar
    if ( !empty ( $dados->id ) ) {
        //se o id não está vazio, não posso excluir
        echo "<script>alert('Não é possível excluir este registro, pois já existe um quadrinho relacionado');history.back();</script>";
        exit;
    }
    //excluir a editora
    $sql = "DELETE FROM editora WHERE id = ? LIMIT 1";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(1, $id);

    //capturar os erros e mostrar a mensagem na tela
    //echo $consulta->errorInfo();
    //print_r($erro[2]); 

    //capturar os erros
    //$erro = $consulta->errorInfo();
    //print_r($erro[2]); 


    //verificar se não executou
    if ( !$consulta->execute() ) {
    echo "<script>alert('Erro ao excluir');javascript:history.back();</script>";
    exit;
    }

    //redirecionar parar a listagem de editoras
    echo "<script>location.href='listar/editora';</script>";
?>

