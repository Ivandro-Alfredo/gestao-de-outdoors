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
    <link rel="stylesheet" href="../../Content/css/formulario/alterClient.css">
    <script src="../../script/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../script//bootstrap/js/jquery.min.js"></script>
    <title>Cliente</title>
</head>
<body>
   
    <nav>
        <h2>CLIENTE</h2>
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
                    <span>Voltar</span> 
                </a>    
            </li>
            <li class="nav-item menu">
                <?php 
                    $email=$_SESSION['email'];
                    
                ?>
                
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
        <script>
            var email = "<?php echo $_SESSION['email']; ?>";
            var province;
            var municipe;
            var commune;
            
            const preencherCampos = fetch('../../Controllers/clienteController.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ email: email })
                })
                .then(response => {return response.json()} )
                .then(data =>{
                    //pondo os dados no formulario
                    document.getElementById('nome').value = data['nome'];
                    document.getElementById('username').value = data['username'];
                    document.getElementById('email').value = data['email'];
                    document.getElementById('morada').value = data['morada'];
                    document.getElementById('fone').value = data['phone'];
                    document.getElementById('senha').value  = data['password'];
                    document.getElementById('idcliente').value  = data['idcliente'];
                    //
                    var provincia = document.getElementById('provincia');
                    var municipio = document.getElementById('municipio');
                    var comuna = document.getElementById('comuna');

                    if(data.provincia!==''){
                        var option = document.createElement('option');
                        provincia.innerHTML = data.provincia;
                        option.text = data.provincia;
                        provincia.add(option);
                    }
                    if(data.municipio!==''){
                        var option = document.createElement('option');
                        municipio.innerHTML =data.municipio;
                        option.text = data.municipio;
                        municipio.add(option);
                    }

                    if(data.comuna!==''){
                        var option = document.createElement('option');
                        comuna.innerHTML =data.comuna
                        option.text = data.comuna;
                        comuna.add(option);
                    }
                })
                .catch(error => {
                    console.error('Erro ao obter os dados do usuário:', error);
                });
        </script>
        
        <div class="formContainer">
            <div id="senha"></div>
                <input type="hidden" id="idcliente">
                <input type="hidden" id="province">
                <input type="hidden" id="municipe">
                <input type="hidden" id="commune">
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <input type="text" class="form-control" name="fullname" id="nome" placeholder="Nome Completo" required value="">
                        </div>
                        <div class="form-group col-md-6">
                        <input type="text" class="form-control" name="user"  id="username" placeholder="Username" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="col">
                        <input type="Email" class="form-control" name="emailUser"   id ="email" placeholder="Email" required>
                        </div>

                        <div class="col">
                        <input type="text" class="form-control" name="morada" id="morada" placeholder="Morada" required>
                        </div>

                        <div class="form-group col-md-">
                        <input type="text" class="form-control" id="fone" placeholder="+244" required>
                        </div>
                    </div>

                    <!-- PASSWORD--> 

                    <div class="form-row">
                        <div class="col">
                        <input type="password" class="form-control" id="passAntiga"  name="oldPass" placeholder="Password" required>
                        </div>

                        <div class="col">
                        <input type="password" class="form-control" id="passNova" name="newPass" placeholder="Confirmar Password" required>
                        </div>
                    </div>
                    <!-- SELECTS-->
                    <br>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <select name="province"  id="provincia" class="form-control" disabled>
                              <option value=""  selected>PROVÍNCIA</option>
                          </select>
                        </div>

                        <div class="form-group col-md-4">
                            <select id="municipio" name="municipe" class="form-control" disabled>
                                <option value="" selected>MUNICIPIO</option>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <select id="comuna" name="communa"  class="form-control" disabled>
                                 <option value="" selected>COMUNA</option>
                            </select>
                        </div>
                    </div>    
                </form>
                <button class="botao"  id="alterarDados" >Alterar Dados</button>
            </div>
        </section>
    </main>
   
    <script src="../../script/custom/cliente.js"></script>
    <script src="../../script/custom/terminarSessao.js"></script>
</body>
</html>
