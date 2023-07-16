<?php
    if (!isset($_SESSION)){
        session_start();
    }

    if(!isset($_SESSION['email'])){
    die('Iniciar Sessão <a href="../home.php"><strong?>Login</strong></a>');
    }
?>
