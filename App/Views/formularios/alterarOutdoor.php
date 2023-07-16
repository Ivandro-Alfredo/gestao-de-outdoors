<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Content/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../Content/bootstrap/fonts/css/all.min.css">
    <link rel="stylesheet" href="../../Content/css/formulario/alterarOutdoor.css">
    <script src="../../script/bootstrap/js/bootstrap.min.js"></script>
    <title>Gestor</title>
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
            <script>
                fetch('../../Controllers/gestorController.php?action=editar')
                .then(response =>response.json())
                .then(dados=>{
                    const tbody = document.getElementById('listar');
                    dados.forEach(dado => {
                        const codOutdoor = dado.idoutdoor;
                        const tipo = dado.tipo;
                        const preco = dado.preco;
                        const provincia = dado.provincia;
                        const municipio = dado.municipio;
                        const comuna = dado.comuna;
                        const estado = dado.estado;

                        let tr = document.createElement('tr');
                        tr.innerHTML = `
                            <td>${tipo}</td>
                            <td>${preco}</td>
                            <td>${provincia}</td>
                            <td>${municipio}</td>
                            <td>${comuna}</td>
                            <td>${estado}</td>
                            <td>
                                <button class="btn-editar" id="edit" onclick="editar(${codOutdoor})"><i class="fas fa-edit"></i></button>
                            </td>
                            
                        `;
                        
                        tbody.appendChild(tr);
                    });
                })
                .catch(erro=>{})

                const verificarCamposVazio = () => {
                    let formOutdoorTrue = true;
                    
                    const outdoor = [
                        tipoOutdoor.value,
                        preco.value,
                        provincia.value,
                        municipio.value,
                        comuna.value, 
                    ];
                
                    for (let l = 0; l < outdoor.length; l++) {
                        if (outdoor[l] == '') {
                            return formOutdoorTrue = false;
                        }
                    }  
                    return true;
                };

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
                
                const validarPreco = (preco) => {
                    var isNAN = /^\d*\.?\d+$/.test(preco);

                    if (isNAN===true) {
                        return true
                    } else {
                        return false;
                    }
                }

                function editar(id) {
                    var modalContainer = document.getElementById('modal-container');
                    var modal = document.getElementById('modal');
                    var salvar = document.getElementById('salvar');
                    var cancelar = document.getElementById('cancelar');
                    
                    modalContainer.style.display = 'block';

                    salvar.addEventListener('click', (e) => {
                        e.preventDefault();
                        var tipoOutdoor = document.forms[0].elements['tipoDeOutdoor'];
                        var preco = document.forms[0].elements['preco'];
                        var provincia = document.forms[0].elements['provincia']
                        var municipio = document.forms[0].elements['municipio']
                        var comuna = document.forms[0].elements['comuna']

                        if (verificarCamposVazio() === true) {
                            if(validarPreco(preco.value)=== false) {
                                openModal('Valor de Preço invalido '+preco.value)
                            }else{
                                const atualizar = new FormData();
                                let valor  = parseFloat(preco.value);

                                atualizar.append('outdoor', tipoOutdoor.value);
                                atualizar.append('preco', valor);
                                atualizar.append('provincia', provincia.value);
                                atualizar.append('municipio', municipio.value);
                                atualizar.append('comuna', comuna.value);
                                atualizar.append('id',id)
                                fetch('../../Controllers/gestorController.php', {
                                method: 'POST',
                                body: atualizar,
                                })
                                .then((response) => response.json())
                                .then((data) => {
                                    openModal(data);
                                    if (data === 'Dados atualizados com sucesso.') {
                                        modalContainer.style.display = 'none';
                                        setTimeout(() => {
                                            window.location.reload(); 
                                        }, 5000); 
                                    }
                                })
                                .catch((error) => {
                                    openModal(error);
                                });
                            }
                        }else{
                            openModal('Preencha os campos');
                        }  
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
                                <td>Preço</td> 
                                <td>Provincia</td>
                                <td>Municipio</td> 
                                <td>Comuna</td> 
                                <td>Estado</td> 
                                <td>Editar</td>  
                            </tr>
                        </thead>
                        <tbody id="listar"> 
                        </tbody>
                    </table>
                </div>

                <div id="modal-container">
                    <div id="modal">
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
                            <button id="salvar" class="botao">Salvar</button>
                            <button id="cancelar" >Cancelar</button>
                        </form>
                    </div>
                </div>

            </div> 
        </section>
    
    </main>
    <script src="../../script/custom/alterarOutdoor.js"></script>
    <script src="../../script/custom/terminarSessao.js"></script>
    

</body>
</html>