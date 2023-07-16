<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Content/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../Content/bootstrap/fonts/css/all.min.css">
    <link rel="stylesheet" href="../../Content/css/ativarConta.css">
    <script src="../../script/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../script/bootstrap/js/jquery.min.js"></script>
    <title>Ativar Conta</title>
</head>
<body>
    <nav>
        <h2>Admin</h2>
        <hr class="sidebar-divider my-0">
        <ul class=".link-navigation" >
            <li class="nav-item menu">
                <a class="nav-link" href="https://mail.google.com">
                    <i class="far fa-envelope"></i>
                    E-mail Recebido
                </a>
             </li>

            <li class="nav-item menu">
                <a class="nav-link" href="../formularios/FormularioRegistoGestor.php">
                    <i class="fas fa-user-cog"></i>
                    Registar Gestor
                </a>
            </li>

            <li class="nav-item menu">
                <a class="nav-link" href="./ativarConta.php" >
                    <i class="fas fa-check-circle"></i>
                    Ativar Conta
                </a>       
            </li>

            <li class="nav-item menu">
                <a class="nav-link" href="../perfil/admin.php">
                    <i class="fas fa-arrow-left"></i>
                    Volta
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
        <div id="div">
            <div class="table-responsive-sm">
                <table class="table table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <td>Nome</td>
                            <td>username</td>
                            <td>Email</td>  
                            <td>Tipo de cliente</td> 
                            <td>Telefone</td> 
                            <td>Morada</td>       
                            <td>Provincia</td> 
                            <td>Municipio</td> 
                            <td>Comuna</td> 
                            <td>Nacionalidade</td> 
                            <td>Categoria</td> 
                            <td>Estado</td> 
                        </tr>
                    </thead>
                    <tbody id="listar"> 
                    </tbody>
                </table>
            </div>
            <button id="update" class="botao">Atualizar</button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
   <script src="../../script/custom/ativarConta.js"></script>
   <script src="../../script/custom/terminarSessao.js"></script>
</body>
</html>