<?php
    include '../session/sessao.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Content/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../Content/bootstrap/fonts/css/all.min.css">
    <link rel="stylesheet" href="../../Content/css/admin.css">
    <script src="../../script/bootstrap/js/bootstrap.min.js"></script>
    <title>ADMIN</title>
</head>
<body>
    <nav>
        <h2>Admin</h2>
        <hr class="sidebar-divider my-0">
        <ul class="navbar-nav" >
            <li class="nav-item menu" aria-disabled="">
                <a class="nav-link user" href="">
                    <i class="fas fa-user-tie"></i>
                    <span><?php echo ''.$_SESSION['username'];?></span>
                </a>
            </li>

            <li class="nav-item menu">
                <a class="nav-link" href="https://mail.google.com">
                    <i class="far fa-envelope"></i>
                    <span>E-mail Recebido</span>
                </a>
            </li>

            <li class="nav-item menu">
                <a class="nav-link active" href="../formularios/FormularioRegistoGestor.php">
                <i class="fas fa-user-cog"></i>
                    <span>Registar Gestor</span>
                </a>
            </li>

            <li class="nav-item menu">
                <a class="nav-link" href="../listar/ativarConta.php" >
                    <i class="fas fa-check-circle"></i>
                    <span>Ativar Conta</span>
                </a>       
            </li>
        </ul>
    </nav>

    <main>
        <header>
            <div class="logo-nav">
                <div class="logo" disable>
                    <a href="">XPTO-SOLUTIONS</a>
                </div>
                
                <div class="login-button">
                    <button id="logout">Logout</button>
                </div>
            </div>
        </header>
    
    <section>
        <div class="boas-vindas">
            <h1>Bem-vindo, <?php echo ''.$_SESSION['username'];?>!</h1>
            <p>Esta é a área administrativa da XPTO-SOLUTIONS.</p>
            <p>Aqui você pode gerenciar as atividades e configurações da plataforma.</p>
            <p>Utilize as opções do menu para acessar as diferentes funcionalidades.</p>
        </div>
    </section>
    
    </main>
   

    <script src="../../script/custom/terminarSessao.js"></script>
</body>
</html>