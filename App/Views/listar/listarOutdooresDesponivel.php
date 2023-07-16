<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Content/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../Content/bootstrap/fonts/css/all.min.css">
    <link rel="stylesheet" href="../../Content/css/listarOutdooresDesponivel.css">
    <script src="../../script/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../script/bootstrap/js/jquery.min.js"></script>
    <title>Listar solicitacao</title>
</head>
<body class="body">
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
                    <a href="./listarInfoOutdoor.php">
                        <span>Preços</span> 
                    </a>
                    |
                </li>
                <li>
                    <a href="./listarTipoOutdoor.php">
                        <span>Tipos de Outdoors</span> 
                    </a>
                    |
                </li>
                <li>
                    <a href="">
                        <span>Outdoors disponível</span> 
                    </a>
                    |
                </li>
                <li>
                    <a href="../formularios/FormularioDeAdesao.php">
                        <span>Solicitar Aluguel</span> 
                    </a>
                    |
                </li>
            </ul>
        </nav>
        <!--  <div class="login-button">
             <button id="loginButton">Login</button>
        </div>-->
    </div>
    
</header>

    <main>
    <div class="input-group ">
		<input type="text" id="buscar" class="form-control search-bar" placeholder="Pesquisar Localizacao">
		<div class="input-group-append">
			<button class="botao" type="button" id="pesquisar">
			<i class="fas fa-search"></i>
			</button>
		</div>
	</div>
    
    <div class="card-container" id="verPreco">
        <div class="row">   
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
   <script src="../../script/custom/listarOutdooresDesponivel.js"></script>
   <!--<script src="../../script/custom/terminarSessao.js"></script>-->
</body>
</html>