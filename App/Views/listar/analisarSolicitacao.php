<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../Content/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../Content/bootstrap/fonts/css/all.min.css">
  <link rel="stylesheet" href="../../Content/css/formulario/solicitacao.css">
  <title>Lista de Solicitações de Aluguel</title>
</head>
    <nav>
        <h2>GESTOR</h2>
        <hr class="sidebar-divider my-0">

        <ul class="navbar-nav" >
            <li class="nav-item menu">
                    <a class="nav-link" href="../formularios/inserirOutdoor.php">
                    <i class="fas fa-plus"></i>
                        <span>Inserir Outdoor</span>
                </a>
            </li>

            <li class="nav-item menu">
                <a class="nav-link active" href="../formularios/alterarOutdoor.php">
                    <i class="far fa-edit"></i>
                    <span>Alterar Outdoor</span>
                </a>
            </li>

            <li class="nav-item menu">
                <a class="nav-link active" href="../formularios/removerOutdoor.php">
                    <i class="fas fa-trash-alt"></i>
                    <span>Remover Outdoors</span>
                </a>       
            </li>

            <li class="nav-item menu">
                <a class="nav-link" href="analisarSolicitacao.php">
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
            <script>
                fetch('../../Controllers/gestorController.php?action=analise')
                .then(response =>response.json())
                .then(dados=>{
                    const tbody = document.getElementById('listar');
                    dados.forEach(dado => {
                        const codOutdoor = dado.idaluguel;
                        const tipo = dado.tipo;
                        const quantidade = dado.quantidade;
                        const provincia = dado.provincia;
                        const municipio = dado.municipio;
                        const comuna = dado.comuna;
                        const estado = dado.estado;

                        let tr = document.createElement('tr');
                        tr.innerHTML = `
                            <td>${tipo}</td>
                            <td>${quantidade}</td>
                            <td>${provincia}</td>
                            <td>${municipio}</td>
                            <td>${comuna}</td>
                            <td>${estado}</td>
                            <td>
                                <button class="btn-editar" id="edit" onclick="ver_comprovativo(${codOutdoor})"><i class="fas fa-file-alt"></i></button>
                            </td>
                            <td>
                                <button class="btn-aprovar" onclick="aprovarSolicitacao(${codOutdoor})"><i class="fa-solid fa-check"></i></button>
                            </td>
                            <td>
                                <button class="btn-recusar" onclick="recusarSolicitacao(${codOutdoor})"><i class="fa-sharp fa-solid fa-ban"></i></button>
                            </td>
                        `;
                        
                        tbody.appendChild(tr);
                    });
                })
                .catch(erro=>{})

                function openModal(info) {
                    // Criar o modal
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
                
                    // Adicionar o modal à página
                    document.body.appendChild(modal);
                    //estilo modal
                    modal.style.display = "block";
                    modal.style.width = "40%";
                    modal.style.marginLeft = "35%";
                    modal.style.marginTop = "10%";
                    modalHeader.style.backgroundColor = "#004349";
                    modalHeader.style.color ="#fff";
                    modalBody.style.backgroundColor="#C0C0C0";
                
                    // Fechar o modal ao clicar no botão de fechar
                    const closeButton = modal.querySelector(".close");
                    closeButton.addEventListener("click", function() {
                    document.body.removeChild(modal);
                    });
                }
                
                function abrirComprovativo(caminhoComprovativo) {
                    window.open(caminhoComprovativo, "_blank");
                }

                function ver_comprovativo(id) {
                   var idcomprovativo = new FormData();
                   idcomprovativo.append('idaluguel', id);

                    fetch('../../Controllers/gestorController.php', {
                        method: 'POST',
                        body: idcomprovativo
                    })
                    .then(response => response.json())
                    .then(comprovativo => {
                        if(comprovativo!==false){
                            const caminhoComprovativo ="../"+comprovativo.comprovativo
                            abrirComprovativo(caminhoComprovativo);
                        }else{
                            openModal('Oops! Sem nenhum resultado');
                        }
                        
                    })
                    .catch(error => {
                        console.error(error);
                    });                
                } 

                function aprovarSolicitacao(idaluguel) {
                    fetch('../../Controllers/gestorController.php', {
                            method: 'POST',
                            body: new URLSearchParams({
                                aprovarSolicitacao: idaluguel
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            openModal(data);
                            if (data === 'Solicitacao aprovada') {
                                setTimeout(() => {
                                    window.location.reload();
                                }, 3000);
                            }
                        })
                        .catch(error => {
                            openModal(error);
                        });
                }

                function recusarSolicitacao(idaluguel) {
                     alert('Recusar solicitação do outdoor: '+ idaluguel);
                     fetch('../../Controllers/gestorController.php', {
                            method: 'POST',
                            body: new URLSearchParams({
                                recusarSolicitacao: idaluguel
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            openModal(data);
                            if (data === 'Solicitacao Foi Rejeitada e apagada') {
                                setTimeout(() => {
                                    window.location.reload();
                                }, 3000);
                            }
                        })
                        .catch(error => {
                            openModal(error);
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
                                <td>Provincia</td>
                                <td>Municipio</td> 
                                <td>Comuna</td> 
                                <td>Estado</td> 
                                <td>Ver Comprovativo</td> 
                                <td>Aprovar</td> 
                                <td>Recusar</td> 
                            </tr>
                        </thead>
                        <tbody id="listar"> 
                        </tbody>
                    </table>
                </div>

                <div id="modal-container">
                    <div id="modal">
                        comprovativo
                    </div>
                </div>

            </div> 
        </section>

    </main>
    <script src="../../script/custom/terminarSessao.js"></script>
</body>
</html>