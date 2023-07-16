var radioComImagem = document.getElementById('com_imagem');
var descricao = document.getElementById('label-imagem');
var quantidade = document.getElementById('quantidade');
const custo = document.getElementById('custo');
const tipo = document.getElementById('tipo');
const inputImagem = document.getElementById("imagem");
var solicitacao = document.getElementById('aluguel');
//
var provincia = document.getElementById('pCliente');
var municipio = document.getElementById('mCliente');
var comuna = document.getElementById('cCliente');
//
var inicio = document.getElementById('dataInicio');
var fim = document.getElementById('dataFim');
//
var email = document.getElementById('email');
//
var precoOutdoor;
let precoTotal;


window.onload = () => {
	const provinciaSelect = document.getElementById('pCliente');
  
	provinciaSelect.innerHTML = '<option value="" selected>PROVINCIA</option>';
	fetch('../../Controllers/localizacaoController.php')
	  .then(response => response.json())
	  .then(data => {
		data.forEach(provincia => {
		  const option = document.createElement('option');
		  option.value = provincia.idprovincia;
		  option.text = provincia.provincia;
		  provinciaSelect.appendChild(option);
		});
		
	  })
	  .catch(error => {
		console.error('Erro ao obter as províncias:', error);
	  });

	//preencher o outdoor
	const tipoOutdoor = document.getElementById('tipo');
	tipoOutdoor.innerHTML = '<option value="" selected>TIPOS DE OUTDOORS</option>';

	fetch('../../Controllers/clienteController.php?action=obterOutdoor')
	  .then(response => response.json())
	  .then(data => {
		data.forEach(outdoor => {
		  const option = document.createElement('option');
		  option.value = outdoor.idoutdoor;
		  option.text = outdoor.tipo;
		  tipoOutdoor.appendChild(option);
		});
		
	  })
	  .catch(error => {
		console.error('Nenhum outdoor disponivel');
	  });
}

function hablitarMunicipios() {
	const provinciaSelect = document.getElementById('pCliente');
	const municipioSelect = document.getElementById('mCliente');
	const provinciaSelecionada = provinciaSelect.value;

	if (provinciaSelecionada !== '') {
		// Habilitar o select de município
		municipioSelect.disabled = false;
		carregarMunicipios()
	} else {
		municipioSelect.disabled = true;
	}
}
//Carregar o municipio
function carregarMunicipios() {
	const provinciaSelect = document.getElementById('pCliente');
	const municipioSelect = document.getElementById('mCliente');
	
	// Limpar o select de municípios
	municipioSelect.innerHTML = '<option value="" selected>MUNICIPIO</option>';
  
	// Fazer a requisição para obter os municípios da província selecionada
	fetch('../../Controllers/localizacaoController.php',
	{
		method: 'POST',
		headers: {'content-type':'aplication/json'},
		body: JSON.stringify(({idprovincia:provinciaSelect.value}))
	})
	  .then(response => response.json())
	  .then(data => {
		 data.forEach((municipio) => {
		  const option = document.createElement('option');
		  option.value = municipio.idmunicipio;
		  option.text = municipio.municipio;
		  municipioSelect.appendChild(option);
		});
	  })
	  .catch(error => {
		console.error('Erro ao obter os dados dos municípios:', error);
	  });
}
//
function hablitarComunas() {
	const municipioSelect = document.getElementById('mCliente');
	const comunaSelect = document.getElementById('cCliente');
	const municipioSelecionado = municipioSelect.value;

	if (municipioSelecionado !== '') {
		// Habilitar o select de comuna
		comunaSelect.disabled = false;
		carregarComunas()
	} else {
		comunaSelect.disabled = true;
	}
}

function carregarComunas() {
	const municipioSelect = document.getElementById('mCliente');
	const comunaSelect = document.getElementById('cCliente');
  
	comunaSelect.innerHTML = '<option value="" selected  disabled>COMUNA / DISTRITO URBANO</option>';
  
	fetch('../../Controllers/localizacaoController.php',
	{
		method:'POST',
		headers: {'Content-Type': 'application/json'},
		body: JSON.stringify(({idmunicipio: municipioSelect.value}))
	})
	  .then(response => response.json())
	  .then(data => {
		data.forEach((comuna) => {
		  const option = document.createElement('option');
		  option.value = comuna.idcomuna;
		  option.text = comuna.comuna;
		  comunaSelect.appendChild(option);
		});
	  })
	  .catch(error => {
		console.error('Erro ao obter os dados das comunas:', error);
	  });
}

function escolhaImagem() {
	if (radioComImagem.checked) {
		inputImagem.style.display = 'block';
		descricao.style.display = 'block';
	} else {
		inputImagem.style.display = 'none';
		descricao.style.display = 'none';
	}
}
//
function setValorParaZero() {
	quantidade.value = 0;
	custo.value = '';
}
//
function atulizarCusto() {
	
	const localizacao = [provincia.value, municipio.value, comuna.value];
	
	for (let index = 0; index < localizacao.length; index++) {
		if (localizacao[index] === '') {
			quantidade.value = 0;
			return openModal('Informe a Provincia, O municipio, e comuna');
		}
	}
	
	qtd = parseInt(quantidade.value);
	if (qtd >= 1 && tipo.value != '') {
		outdoor = {
			outdoor: tipo.value,
			provincia: provincia.value,
			municipio: municipio.value,
			comuna: comuna.value,
		};

		fetch('../../Controllers/clienteController.php', {
			method: 'POST',
			headers: {
				'content-type': 'application/json; charset=utf8',
			},
			body: JSON.stringify({ outdoor }),
		})
			.then((response) =>
				response.json().then((valor) => {
					precoOutdoor = parseFloat(valor.preco);
					if (!isNaN(precoOutdoor)) {
						qtd = parseInt(quantidade.value);
						custo.value = qtd * precoOutdoor;
						precoTotal = qtd * precoOutdoor;
					} else {
						custo.value = 'Sem Preço';
						quantidade.value= '0';
					}
				})
			)
			.catch((erro) => {
				custo.value = 'Sem Preço';
				quantidade.value = '0';
			});
	} else {
		custo.value = '';
		quantidade.value= '0';
	}
}

solicitacao.addEventListener('click', (e) => {
	e.preventDefault();
	if (inputImagem.value === '') {
		const solicitacaoSemImagem = [
			email.value,
			tipo.value,
			quantidade.value,
			precoTotal,
			provincia.value,
			municipio.value,
			comuna.value,
			inicio.value,
			fim.value,
		];
		for (let index = 0; index < solicitacaoSemImagem.length; index++) {
			if (solicitacaoSemImagem[index] === '') {
				return openModal('Preencha os campos');
			}
		}
		var dataInicial = new Date(inicio.value);
		var dataFinal = new Date(fim.value);
		if (
			dataInicial.getTime() === dataFinal.getTime() || dataFinal.getTime() <= dataInicial.getTime()
		) {
			return openModal(
				'A data inicial não pode ser igual ou maior que à data final.'
			);
		} else {
			var dataAtual = new Date();
			dataAtual.setHours(0, 0, 0, 0);
			dataInicial.setHours(0, 0, 0, 0);
			if (dataInicial < dataAtual) {
				return openModal(
					'A data selecionada não pode ser Inferior à data atual.'
				);
			}
		}
		const solicitacao = {
			email: email.value,
			tipo: tipo.value,
			quantidade: quantidade.value,
			total: precoTotal,
			provincia: provincia.value,
			municipio: municipio.value,
			comuna: comuna.value,
			inicio: inicio.value,
			fim: fim.value,
		};

		if(quantidade.value!== '0' ) {
			enviarDadosSemImagem(solicitacao);
		}else{
			openModal('Não é permitido solicitação com uma quantidade menor ou igual a zero'+'<br>'
			+'certifique - se de escolher um outdoor em regioes cuja o preco esta disponivel')
		}
	}else if(inputImagem.value !== '' ){
		const solicitacaoComImagem = [
			email.value,
			tipo.value,
			quantidade.value,
			precoTotal,
			provincia.value,
			municipio.value,
			comuna.value,
			inicio.value,
			fim.value,
			inputImagem.value,
		];
		
		for (let index = 0; index < solicitacaoComImagem.length; index++) {
			if (solicitacaoComImagem[index] === '') {
				return openModal('Preencha os campos');
			}
		}
		var dataInicial = new Date(inicio.value);
		var dataFinal = new Date(fim.value);
		if (
			dataInicial.getTime() === dataFinal.getTime() || dataFinal.getTime() <= dataInicial.getTime()
		) {
			return openModal(
				'A data inicial não pode ser igual ou inferior à data final.'
			);
		} else {
			var dataAtual = new Date();
			dataAtual.setHours(0, 0, 0, 0);
			dataInicial.setHours(0, 0, 0, 0);
			if (dataInicial < dataAtual) {
				return openModal(
					'A data selecionada não pode ser Inferior à data atual.'
				);
			}
		}
		if(quantidade.value !== '0') {
			const selectedImage = inputImagem.files[0];
			const aluguelComImagem  = new FormData();
			aluguelComImagem.append("email", email.value);
			aluguelComImagem.append("tipo", tipo.value);
			aluguelComImagem.append("quantidade", quantidade.value);
			aluguelComImagem.append("total", precoTotal);
			aluguelComImagem.append("provincia",provincia.value);
			aluguelComImagem.append("municipio",municipio.value);
			aluguelComImagem.append("comuna", comuna.value);
			aluguelComImagem.append("inicio", inicio.value);
			aluguelComImagem.append("fim", fim.value);
			aluguelComImagem .append("imagem", selectedImage)
			enviarDadosComImagem(aluguelComImagem);
		}else{
			openModal('Não é permitido solicitação com uma quantidade menor ou igual a zero'+'<br>'
			+'certifique - se de escolher um outdoor em regioes cuja o preco esta disponivel')
		}
	}
})	

// Função responsável por criar e abrir a modal
function openModal(info) {
    // Criar o modal
    const modal = document.createElement("div");
    modal.classList.add("modal");

    const modalContent = document.createElement("div");
    modalContent.classList.add("modal-content");

    const modalHeader = document.createElement("div");
    modalHeader.classList.add("modal-header");
    modalHeader.innerHTML = 
      "<h5 class='modal-title'>Info</h5><button type='button' style='color:#FFFFFF' class='close' data-dismiss='modal'>&times;</button>";
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

    // Abrir o modal
    modal.style.display = "block";
    //estilo modal
		modal.style.display = "block";
		modal.style.width = "40%";
		modal.style.marginLeft = "30%";
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

function enviarDadosSemImagem(solicitacao) { 
	fetch('../../Controllers/clienteController.php', {
		method: 'POST',
		headers: {
			'content-type': 'application/json; charset=utf8',
		},
		body: JSON.stringify({ solicitacao }),
	})
	.then((response) => response.json())
	.then((data) => {
		openModal(data);
		setTimeout(() => {
			window.location.reload();
		},5000);
	})
	.catch((error) => {
		openModal('Sem preco disponivel');
	});
}

function enviarDadosComImagem(aluguelComImagem) {
	fetch("../../Controllers/clienteController.php", {
	  method: "POST",
	  body: aluguelComImagem
	})
	.then((response) => response.json())
	.then((data) => {
		openModal(data);
		setTimeout(() => {
			window.location.reload();
		},5000);
	})
	.catch((error) => {
		openModal("Ocorreu um erro:", error);
	});
}
