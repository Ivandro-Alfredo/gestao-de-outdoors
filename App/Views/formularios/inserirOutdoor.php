<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Content/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../Content/bootstrap/fonts/css/all.min.css">
    <link rel="stylesheet" href="../../Content/css/formulario/formOutdoor.css">
    <script src="../../script/bootstrap/js/bootstrap.min.js"></script>

    <title>Inserir </title>
</head>
<body>
    <nav>
        <h2>GESTOR</h2>
        <hr class="sidebar-divider my-0">

        <ul class="navbar-nav" >
            <li class="nav-item menu">
                <a class="nav-link" href="./inserirOutdoor.php">
                    <i class="fas fa-plus"></i>
                    <span>Inserir Outdoor</span>
                </a>
            </li>

            <li class="nav-item menu">
                <a class="nav-link active" href="./alterarOutdoor.php">
                    <i class="far fa-edit"></i>
                    <span>Alterar Outdoor</span>
                </a>
            </li>

            <li class="nav-item menu">
                <a class="nav-link active" href="./removerOutdoor.php">
                    <i class="fas fa-trash-alt"></i>
                    <span>Remover Outdoors</span>
                </a>       
            </li>

            <li class="nav-item menu">
                <a class="nav-link" href="../listar/analisarSolicitacao.php">
                    <i class="fas fa-eye"></i>
                    <span>Analisar Solicitacao de Aluguel</span>
                </a>
            </li>

            <li class="nav-item menu">
                <a class="nav-link" href="../perfil/gestor.php">
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
    
    <section>
        <div class="formContainer">
            <form>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <select name="tipoDeOutdoor" id="" class="form-control" >
                            <option value="">TIPOS DE OUTDOORS</option>
                            <option value="Paines Luminosos">Paines Luminosos</option>
                            <option value="Paines Não Luminosos">Paines Não Luminosos</option>
                            <option value="Placas Indicativas">Placas Indicativas</option>
                            <option value="Faixadas">Faixadas</option>
                            <option value="Lampoles">Lampoles</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <input class="form-control" type="text" name="preco" id="preco" placeholder="Preco Ex 30000" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <select name="provincia" id="provincia" class="form-control" onchange="hablitarMunicipios()">
                            <option value="" selected>PROVÍNCIA</option>
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <select name="municipio" id="municipio" class="form-control" onchange="hablitarComunas()" disabled>
                            <option value="" selected>MUNICIPIO</option>
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <select name="comuna" id="comuna" class="form-control" disabled>
                            <option value="">COMUNA</option>
                        </select>
                    </div>
                </div>

            </form>
            <button id="inserir" class="botao">Inserir Outdor</button>
        </div> 
    </section>
</main>
    <script src="../../script/custom/inserirOutdoor.js"></script>
    <script src="../../script/custom/terminarSessao.js"></script>
</body>
</html>