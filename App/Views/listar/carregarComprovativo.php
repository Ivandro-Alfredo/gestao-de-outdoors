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
    <link rel="stylesheet" href="../../Content/css/formulario/comprovativo.css">
    <script src="../../script/bootstrap/js/bootstrap.min.js"></script>
    <title>Cliente</title>
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
                <a class="nav-link" href="../listar/listarAluguel.php">
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
                    <button id="logout" >Logout</button>
                </div>
            </div>
        </header> 
        
        <section>
            <script>
                var email = "<?php echo ''.$_SESSION['email'];?>" ;  
                fetch('../../Controllers/clienteController.php',{
                    method: 'POST',
                        body: JSON.stringify(({carregar: email  }))
                })
                .then(response =>response.json())
                .then(dados=>{
                    const tbody = document.getElementById('listar');
                    dados.forEach(dado => {
                        const idaluguel = dado.idaluguel;
                        const tipo = dado.tipo;
                        const total = dado.total;
                        const quantidade = dado.quantidade;
                        const provincia = dado.provincia;
                        const municipio = dado.municipio;
                        const comuna = dado.comuna;
                        const estado = dado.estado;

                        let tr = document.createElement('tr');
                        tr.innerHTML = `
                            <td>${tipo}</td>
                            <td>${quantidade}</td>
                            <td>${total}</td>
                            <td>${provincia}</td>
                            <td>${municipio}</td>
                            <td>${comuna}</td>
                            <td>${estado}</td>
                            <td>
                                <button class="btn-editar" id="edit" onclick="carregarComprovativo(${idaluguel})"><i class="fas fa-file-alt"></i></button>
                            </td>    
                            `;
                        tbody.appendChild(tr);

                    });
                })
                .catch(erro=>{})

                function openModal(info) {
                    
                    const modal = document.createElement("div");
                    modal.classList.add("modal");
                    
                    const modalContent = document.createElement("div");
                    modalContent.classList.add("modal-content");
                    
                    const modalHeader = document.createElement("div");
                    modalHeader.classList.add("modal-header");
                    modalHeader.innerHTML = 
                    "<h5 class='modal-title'>Info</h5>"
                    +"<button type='button' class='close' style='color:#fff' data-dismiss='modal'>&times;</button>";
                    modalContent.appendChild(modalHeader);
                    
                    const modalBody = document.createElement("div");
                    modalBody.classList.add("modal-body");
                    modalBody.innerHTML = `
                        <p><strong></strong> ${info}</p>
                    `;
                    modalContent.appendChild(modalBody);
                    modal.appendChild(modalContent);
                    document.body.appendChild(modal);
                        //estilo modal
                    modal.style.display = "block";
                    modal.style.width = "40%";
                    modal.style.marginLeft = "35%";
                    modal.style.marginTop = "10%";
                    modalHeader.style.backgroundColor = "#004349";
                    modalHeader.style.color ="#fff";
                    modalBody.style.backgroundColor="#C0C0C0";
                    
                    const closeButton = modal.querySelector(".close");
                    closeButton.addEventListener("click", function() {
                    document.body.removeChild(modal);
                    });
                }

                function carregarComprovativo(id) {
                    var modalContainer = document.getElementById('modal-container');
                    var modal = document.getElementById('modal');
                    var salvar = document.getElementById('salvar');
                    var cancelar = document.getElementById('cancelar');
                    var arquivo = document.getElementById('comprovativo');
                    
                    
                    modalContainer.style.display = 'block';

                    salvar.addEventListener('click', (e) => {
                        e.preventDefault();

                        const comprovativo = arquivo.files[0];
                        const pagamento  = new FormData();
                        var dataAtual = new Date();
                        var ano = dataAtual.getFullYear();
                        var mes = ("0" + (dataAtual.getMonth() + 1)).slice(-2);
                        var dia = ("0" + dataAtual.getDate()).slice(-2);
                        var dataFormatada = ano + "-" + mes + "-" + dia;
                        pagamento.append("idaluguel",id);
                        pagamento.append("arquivo", comprovativo);
                        pagamento.append("data", dataFormatada);

                        fetch('../../Controllers/clienteController.php', {
                        method: 'POST',
                        body: pagamento
                        })
                        .then(response => response.json())
                        .then(data => {
                            openModal(data);
                            if (data === 'Carregamento concluido.') {
                                setTimeout(() => {
                                    window.location.reload();
                                }, 4000);
                            }else{
                                openModal('Oops!!, Falha no carregamento');
                            }
                        })
                        .catch(error => {
                            openModal(error);
                        });  
                    });

                    cancelar.addEventListener('click', (e) => {
                        e.preventDefault();
                        modalContainer.style.display = 'none';
                        
                    });
                }  
            </script>

            <div>
                <div class="table-responsive-sm div-tabela">
                    <table class="table table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <td>Tipo de Outdoor</td>
                                <td>quantidade</td> 
                                <td>Total a pagar</td> 
                                <td>Provincia</td>
                                <td>Municipio</td> 
                                <td>Comuna</td> 
                                <td>Estado</td> 
                                <td>Carregar Comprovativo</td>  
                            </tr>
                        </thead>
                        <tbody id="listar"> 
                        </tbody>
                    </table>
                </div>
            </div>  
            
            <div id="modal-container">
                <div id="modal">
                    <form action="" enctype="multipart/form-data">
                        <label for="">Comprovativo de Pagamento</label><br>
                        <input type="file" name="comprovativo" id="comprovativo" accept=".pdf,.jpg, .jpeg, .png">
                    </form>
                    <button id="salvar" class="botao">Enviar</button>
                    <button id="cancelar" class="botao-cancelar">Cancelar</button>
                </div>
            </div>
        </section>
    </main>
    <script src="../../script/custom/terminarSessao.js"></script>
</body>
</html>