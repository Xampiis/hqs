<?php

    //iniciar a sessão
    session_start();

    //apagar a sessão
    unset ( $_SESSION["hqs"]);

    //redirecionar para a página inicial
    header("Location: index.php");