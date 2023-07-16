<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Content/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../Content/bootstrap/fonts/css/all.min.css">
    <link rel="stylesheet" href="../../Content/css/formulario/formGestor.css">
    <script src="../../script/bootstrap/js/bootstrap.min.js"></script>
    <title>Registar Gestor</title>
</head>
<body>
   
    <nav>
        <h2>Admin</h2>
        <hr class="sidebar-divider my-0">
        <ul class="navbar-nav" >
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
                <a class="nav-link" href="../listar/ativarConta.php">
                    <i class="fas fa-check-circle"></i>
                     <span>Ativar Conta</span>
                </a>       
            </li>

                <li class="nav-item menu">
                    <a class="nav-link" href="../perfil/admin.php">
                        <i class="fas fa-arrow-left"></i>
                        <span>Voltar</span>
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
            <fieldset id="div" class="fieldset">
                <form action="">
                    <h2>Registar Gestor</h2>
                    <input type="text" name="gestor" id="nome" placeholder="Nome Completo" required>
                    <input type="text" name="username" placeholder="Username" id="user" required>
                    <br><br>
                    <input type="email" name="email" placeholder="exemplo@gmail.com" id="email" required>
                    <input type="text" name="fone" placeholder="+244" id="num" required>
                    <input type="text" name="morada" placeholder="Morada" id="endereco" required>
                    <br><br>
                    <input type="password" name="password" placeholder="Password" required>
                    <input type="password" name="confirmar" placeholder="Confirmar password" required>
                    <br><br>
                    <select name="provincia" id="provincia" onchange="hablitarMunicipios()">
                        <option value="" selected>PROVÍNCIA</option>
                    </select>

                    <select name="municipio" id="municipio" onchange="hablitarComunas()" disabled>
                        <option value="" selected>MUNICIPIO</option>
                    </select>
                            
                    <select name="comuna" id="comuna" disabled>
                        <option value="" selected>COMUNA</option>
                    </select>
                    <br><br>
                            <!--con....-->
                    <select name="nacionalidade" id="">
                        <option value="">NACIONALIDADE</option>
                        <option value="angolana">ANGOLANA</option>
                        <option value="">ARGELINA</option>
                        <option value="">SENEGALENSA</option>
                        <option value=""></option>
                         <option value=""></option>
                    </select> 
                </form>
                <br>
                <button id="registaGestor" class=".botao">Registar Gestor</button>
                <br>
        </section>
    </main>

    
    <script src="../../script/custom/adminForm.js"></script>
    <script src="../../script/custom/terminarSessao.js"></script>
</body>
</html>