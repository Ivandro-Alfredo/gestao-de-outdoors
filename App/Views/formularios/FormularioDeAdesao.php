<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Content/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../Content/bootstrap/fonts/css/all.min.css">
    <link rel="stylesheet" href="../../Content/css/formulario/formAdesao.css">
    <script src="../../script/bootstrap/js/bootstrap.min.js"></script>
    <title>Formulario de adesao</title>
</head>
<body>
<header>
    <div class="logo-nav">
        <div class="logo" disable>
            <a href="">XPTO-SOLUTION</a>
        </div>
        <nav>
            <ul class="link-navigation">
                <li>
                    <a href="../home.php">
                        <span>Home</span> 
                    </a>
                    |
                </li>
                <li>
                    <a href="../listar/listarInfoOutdoor.php">
                        <span>Preços</span> 
                    </a>
                    |
                </li>
                <li>
                    <a href="../listar/listarTipoOutdoor.php">
                        <span>Tipos de Outdoors</span> 
                    </a>
                    |
                </li>
                <li>
                    <a href="../listar/listarOutdooresDesponivel.php">
                        <span>Outdoors disponível</span> 
                    </a>
                    |
                </li>
                <li>
                    <a href="./formularios/FormularioDeAdesao.php">
                        <span>Solicitar Aluguel</span> 
                    </a>
                    |
                </li>
            </ul>
        </nav>
        <div class="login-button">
            <button id="loginButton">Login</button>
        </div>
    </div>
    
</header>

    <main class="main-centered">
        <section>
            <div id="container">
                    <fieldset class="fieldset">
                        <Legend>Registar - Se</Legend>

                        <form action="">
                            <input type="text" name="nomeSolicitante" id="nomeCliente" placeholder="Nome Completo / Nome da Empresa" required>
                            <input type="text" name="username" placeholder="Username" id="user" required>
                            <br><br>
                            <input type="email" name="email" placeholder="exemplo@gmail.com" id="email" required>
                            <select name="tipoCliente" id="tipoCliente" onchange="verificarCliente()">
                                <option value="" selected>TIPO DE CLIENTE</option>
                                <option value="Empresa">EMPRESA</option>
                                <option value="Particular">PARTICULAR</option>
                            </select>
                            <br><br>
                            <input type="text" name="atividadeEmpresa" id="atividade" placeholder="ATIVIDADE DA EMPRESA" disabled required>
                            <input type="text" name="fone" placeholder="+244" id="num" required>
                            <br><br>
                            <input type="text" name="morada" placeholder="Morada" id="endereco" required>
                            <select name="nacionalidade" id="nacionalidade">
                                <option value="" selected>NACIONALIDADE</option>
                                <option value="Angolana">ANGOLANA</option>
                            </select>
                            <br><br>
                            <input type="password" name="password" placeholder="Password" required>
                            <input type="password" name="confirmar" placeholder="Confirmar password" required>
                            <br><br>
                            <select name="provincia" id="pCliente" onchange="hablitarMunicipios()">
                            <option value="" selected>PROVINCIA</option>
                            </select>
                            <select name="municipio_cliente" id="mCliente" onchange="hablitarComunas()" disabled>
                                <option value="" selected>MUNICIPIO</option>
                            </select>

                            <select name="comuna_cliente" id="cCliente" disabled>
                                <option value="" selected>COMUNA</option>
                            </select>
                        </form>
                    </fieldset>
                    <button id="aluguel">Solicitar Aluguel</button>
            </div>
        </section>

        <div id="modal-container">
        <div id="modal">
            <fieldset id="fieldsetLogin">
                <Legend>Login</Legend>
                <form action="" id="formLogin" >
                    <input type="email" placeholder="seuemail@gmail.com" id="emailUser">
                    <br>
                    <input type="password" placeholder="password" id="password">
                </form>
                <button id="enviar"  >Login</button> 
                <button id="cancelar"  >Cancelar</button>
            </fieldset>
        </div>
        </div>
    </main>


    <footer>
  <div class="container">
    <div class="footer-content">
      <div class="footer-section">
        <h3>Sobre</h3>
        <p>Descrição breve sobre a empresa ou site.</p>
      </div>
      <div class="footer-section">
        <h3>Links Úteis</h3>
        <ul>
          <li><a href="#">Página Inicial</a></li>
          <li><a href="#">Produtos</a></li>
          <li><a href="#">Contato</a></li>
          <li><a href="#">Termos de Serviço</a></li>
        </ul>
      </div>
      <div class="footer-section">
        <h3>Contato</h3>
        <p>xptosolution@geral.org</p>
        <p>932456378</p>
        <p>266 244</p>
      </div>
    </div>
    <div class="footer-bottom">
      <p>&copy; 2023 XPTO SOLUTION. Todos os direitos reservados.</p>
    </div>
  </div>
</footer>

    <script src="../../script/custom/formsAdesao.js"></script>
</body>
</html>