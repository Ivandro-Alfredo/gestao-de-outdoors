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
    <link rel="stylesheet" href="../../Content/css/formulario/formSolicitacao.css">
    <script src="../../script/bootstrap/js/bootstrap.min.js"></script>
    <title>Solicitacao de Outdoor</title>
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
                <a class="nav-link" href="">
                    <i class="fas fa-hand-holding-usd"></i>
                    <span>Aluguel de Outdoors</span>
                </a>       
            </li>

            <li class="nav-item menu">
                <a class="nav-link" href="../listar/listarAluguel.php">
                    <i class="fas fa-list"></i>
                    <span>Consultar solicitacoes de aluguel</span>
                </a>
            </li>

            <li class="nav-item menu">
                <a class="nav-link" href="">
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
    
    <section>
         <!-- -->
        <div class="formContainer">
            <fieldset class="fieldset">
                <Legend>Solicitacao de aluguel</Legend>
                <form action="" enctype="multipart/form-data">
                    <input type="hidden" id="email">
                
                    <div>
                        <select name="tipoDeOutdoor" id="tipo" class="form-group col-md-6 form-control" onchange="setValorParaZero()">
                            <option value="" selected >TIPOS DE OUTDOORS</option>
                        </select>
                    </div>
                  
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <select name="provincia_cliente" id="pCliente" onchange="hablitarMunicipios()"  class="form-control">
                                
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <select name="municipio_cliente" id="mCliente"  onchange="hablitarComunas()" disabled  class="form-control">
                                <option value="" selected>MUNICIPIO</option>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <select name="comuna_cliente" id="cCliente" disabled  class="form-control">
                                <option value="" selected>COMUNA</option>
                            </select>
                        </div>
                    </div>  
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="dataInicio">Data de Inicio</label>
                            <input type="date" id="dataInicio" class="form-control datepicker">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="dataFim">Data do Fim</label>
                            <input type="date" id="dataFim" class="form-control datepicker">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input type="radio" name="tipo" id="sem_imagem" value="sem_imagem"  onchange="escolhaImagem()" checked>
                            <label for="sem_imagem">Sem imagem</label>
                        </div>

                        <div class="form-group col-md-6">
                            <input type="radio" name="tipo" id="com_imagem" value="com_imagem" onchange="escolhaImagem()">
                            <label for="com_imagem">Com imagem</label>
                            <br>
                            <label for="imagem" id = "label-imagem" style="display: none;">Selecionar imagem</label>
                            <input type="file" name="imagem" id="imagem" accept=".jpg, .jpeg, .png"style="display: none;" class="form-control ">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                             <input type="number" min="0" id="quantidade" onchange ="atulizarCusto()" placeholder="Quantidade de Outdoors" class="form-control" >
                        <div>
                        <br>
                        <div class="form-group col-md-6 valor-pagar " >
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Valor a Pagar, KZ</div>
                                </div>
                                    <input type="text" class="form-control" id="custo" placeholder="0.00 kz" disabled>
                            </div>
                        </div>
                    </div>
                </form>
                <br>
                <button id="aluguel" class="botao">Enviar Solicitacao</button>
            </fieldset>
        </div>
        
    </section>
    </main>
    <!-- Pegando o email do user-->
    <script>
            var email = "<?php echo $_SESSION['email']; ?>";
            document.getElementById('email').value = email;
    </script>

    <script src="../../script/custom/aluguelForm.js"></script>
    <script src="../../script/custom/terminarSessao.js"></script>
</body>
</html>