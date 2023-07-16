<?php
   include '../session/sessao.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Content/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../Content/bootstrap/fonts/css/all.min.css">
    <link rel="stylesheet" href="../../Content/css/listarAluguel.css">
    
    <script src="../../script/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../script/bootstrap/js/jquery.min.js"></script>
    <title>Listar solicitacao</title>
</head>
<body>
    <nav>
        <h2>Cliente</h2>
        <hr class="sidebar-divider my-0">
        <ul class="navbar-nav" >
            <li class="nav-item menu">
                <a class="nav-link active" href="../formularios/alterarDadosCliente.php">
                    <i class="fas fa-user-edit"></i>
                    <span>Alterar Dados Pessoais</span>
                </a>
            </li>

            <li class="nav-item menu">
                <a class="nav-link" href="../formularios/formSolicitacaoDeOutdoor.php">
                    <i class="fas fa-hand-holding-usd"></i>
                    <span>Aluguel de Outdoors</span>
                </a>       
            </li>

            <li class="nav-item menu">
                <a class="nav-link" href="">
                    <i class="fas fa-list"></i>
                    <span>Consultar solicitacoes de aluguel</span>
                </a>
            </li>

            <li class="nav-item menu">
                <a class="nav-link" href="../listar/carregarComprovativo.php">
                    <i class="fas fa-file-upload"></i>
                    <span>Carregar Comprovativo</span>
                </a>
            </li>

            <li class="nav-item menu"> 
                <a class="nav-link" href="../perfil/cliente.php">
                    <i class="fas fa-arrow-left"></i>
                    voltar
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
        <input type="hidden" id="email">
        <div id="div">
            <div class="table-responsive-sm">
                <table class="table table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <td>Cliente</td>
                            <td>Tipo</td>
                            <td>Quantidade</td>  
                            <td>Total A Pagar</td>       
                            <td>Provincia</td> 
                            <td>Municipio</td> 
                            <td>Comuna</td>
                            <td>Inicio Do Aluguel</td> 
                            <td>Fim Do Aluguel</td>  
                            <td>Imagem</td> 
                            <td>Estado</td>    
                        </tr>
                    </thead>
                    <tbody id="listar"> 
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <script>
        var email = "<?php echo $_SESSION['email']; ?>";
        document.getElementById('email').value = email;
    </script>
   <script src="../../script/custom/listarAluguel.js"></script>
   <script src="../../script/custom/terminarSessao.js"></script>
</body>
</html>