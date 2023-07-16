var solicitante = document.forms[0].elements['nomeSolicitante'];
var username = document.forms[0].elements['username'];
var email = document.forms[0].elements['email'];
var fone = document.forms[0].elements['fone'];
var morada = document.forms[0].elements['morada'];
var password = document.forms[0].elements['password'];
var passwordConfirm = document.forms[0].elements['confirmar'];
var provinciaCliente = document.forms[0].elements['provincia'];
var municipioCliente = document.forms[0].elements['municipio_cliente'];
var comunaCliente = document.forms[0].elements['comuna_cliente'];
var nacionalidade = document.forms[0].elements['nacionalidade'];
var tipoCliente = document.forms[0].elements['tipoCliente'];
var atividade = document.forms[0].elements['atividadeEmpresa'];

var aluguel = document.getElementById('aluguel');
var modalContainer = document.getElementById('modal-container');
var login = document.getElementById('loginButton');
var cancel = document.getElementById('cancelar');
var enviar = document.getElementById('enviar');

login.addEventListener('click', (e) => {
	e.preventDefault();
	modalContainer.style.display = 'block';
});

cancel.addEventListener('click', () => {
	modalContainer.style.display = 'none'
});

window.onload = () => {
	const provinciaSelect = document.getElementById('pCliente');
  
	// Limpar o select de província
	provinciaSelect.innerHTML = '<option value="" selected>PROVINCIA</option>';
  
	// Fazer a requisição para obter as províncias
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

function verificarCliente(){
	var cliente = document.getElementById('tipoCliente');

	if(cliente.value==='Empresa' && (cliente.value!=='' && cliente.value!=='Particular')){
		atividade.disabled = false;
	}else{
		atividade.disabled = true;
		atividade.value = '';
	}
}

aluguel.addEventListener('click', () => {
	if (verificarCamposVazio() === true) {
		if (validarCampos() === true) {
			if(tipoCliente.value==='Particular'){
				const dadosForm = new FormData();
				//pegando nos dados do formulario e guardo no dadosforms
				dadosForm.append('nome', solicitante.value);
				dadosForm.append('username', username.value);
				dadosForm.append('email', email.value);
				dadosForm.append('fone', fone.value);
				dadosForm.append('morada', morada.value);
				dadosForm.append('password', password.value);
				dadosForm.append('provincia', provinciaCliente.value);
				dadosForm.append('municipio', municipioCliente.value);
				dadosForm.append('comuna', comunaCliente.value);
				dadosForm.append('nacionalidade', nacionalidade.value);
				dadosForm.append('clienteParticular', tipoCliente.value);
				//
				fetch('../../Controllers/solicitacaoControler.php', {
					method: 'POST',
					body: dadosForm,
				})
					.then((response) => response.json())
					.then((data) => {
						openModal(data)
					})
					.catch((error) => {
						openModal(error)
					});
			}else{
				const dadosForm = new FormData();
				//pegando nos dados do formulario e guardo no dadosforms
				dadosForm.append('nome', solicitante.value);
				dadosForm.append('username', username.value);
				dadosForm.append('email', email.value);
				dadosForm.append('fone', fone.value);
				dadosForm.append('morada', morada.value);
				dadosForm.append('password', password.value);
				dadosForm.append('provincia', provinciaCliente.value);
				dadosForm.append('municipio', municipioCliente.value);
				dadosForm.append('comuna', comunaCliente.value);
				dadosForm.append('nacionalidade', nacionalidade.value);
				dadosForm.append('clienteEmpresa', tipoCliente.value);
				dadosForm.append('atividade', atividade.value);
				//
				fetch('../../Controllers/solicitacaoControler.php', {
					method: 'POST',
					body: dadosForm,
				})
					.then((response) => response.json())
					.then((data) => {
						openModal(data)
					})
					.catch((error) => {
						openModal(error)
					});
			}
		}
	} else {
		openModal('Verique Os Dados!');
	}
});

enviar.addEventListener('click', () => {
	var password = document.getElementById('password');
	var emailUser = document.getElementById('emailUser');
	
	if (verificarDadosDeAcesso(emailUser.value, password.value) === true) {
		const loginAcess = new FormData();
		loginAcess.append('email', emailUser.value);
		loginAcess.append('password', password.value);
		fetch('http://localhost/Projeto-AW/App/Controllers/loginController.php', {
			method: 'POST',
			body: loginAcess,
		})
		.then((response) => response.json())
		.then((data) => {
			if (data.tipo === 'Administrador') {
				window.location.href = '../../Views/perfil/admin.php';
			} else if (data.tipo === 'Cliente'){
				window.location.href = '../../Views/perfil/cliente.php';
			}else if (data.tipo === 'Gestor'){
				window.location.href = '../../Views/perfil/gestor.php';
			}else{
				//fazer outra requisicao para saber se a conta esta na tabela cliente
				fetch('http://localhost/Projeto-AW/App/Controllers/clienteController.php', {
					method: 'POST',
					body: JSON.stringify( ({verificarEmail:email.value})),
				}).then((response) => response.json())
				.then((data) => {
					if(data==='pendente'||data==='desativado'){
						openModalLogin('Verique se recebeu um email,'+'<br>'
						+'caso nao, aguarde ate a confirmacao da'+'<br>'
						+'ativacao da sua conta, obrigado.'+'<br>'
						+'Equpe da XPTO-SOLUTIONS.')
					}else{
						openModalLogin('Usuario ou password Invalido')
					}
				})
				.catch((error) => {
					alert(error)
				});
			}
		})
		.catch((error) => {
			openModal(error)
		});
	}

	function verificarDadosDeAcesso(username, password) {
		if (
			(username === '' && password === '') ||
			(username === '' && password != '') ||
			(username != '' && password === '')
		) {
			return false;
		}
		return true;
	}
	function openModalLogin(login) {
		// Criar o modal
		const modal = document.createElement("div");
		modal.classList.add("modal");
	
		const modalContent = document.createElement("div");
		modalContent.classList.add("modal-content");
	
		const modalHeader = document.createElement("div");
		modalHeader.classList.add("modal-header");
		modalHeader.innerHTML = 
		"<h5 class='modal-title'>Login</h5>"
		+"<button type='button' class='close' style='color:#fff' data-dismiss='modal'>&times;</button>";
		modalContent.appendChild(modalHeader);
	
		const modalBody = document.createElement("div");
		modalBody.classList.add("modal-body");
		modalBody.innerHTML = `
		<p><strong></strong> ${login}</p>
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
});

function openModal(outdoor) {
	// Criar o modal
	const modal = document.createElement("div");
	modal.classList.add("modal");

	const modalContent = document.createElement("div");
	modalContent.classList.add("modal-content");

	const modalHeader = document.createElement("div");
	modalHeader.classList.add("modal-header");
	modalHeader.innerHTML = 
	"<h5 class='modal-title'>Registar - Se</h5>"
	+"<button type='button' class='close' style='color:#fff' data-dismiss='modal'>&times;</button>";
	modalContent.appendChild(modalHeader);

	const modalBody = document.createElement("div");
	modalBody.classList.add("modal-body");
	modalBody.innerHTML = `
	<p><strong></strong> ${outdoor}</p>
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

function limparCampos() {
	//pega os ids, para limpar os campos...
	 // Limpar os campos de input
	 document.getElementById('nomeCliente').value = '';
	 document.getElementById('user').value = '';
	 document.getElementById('email').value = '';
	 document.getElementById('num').value = '';
	 document.getElementById('endereco').value = '';
	 
	 // Redefinir os selects selecionados
	 document.getElementById('cCliente').selectedIndex = 0;
	 document.getElementById('mCliente').selectedIndex = 0;
	 document.getElementById('pCliente').selectedIndex = 0;
	 document.getElementById('nacionalidade').selectedIndex = 0;

	 //desablitar o select
	 hablitarComunas()
	 hablitarMunicipios()
	 
	 // Limpar os campos de input restantes
	 document.getElementById('emp').value = '';
	 document.getElementById('atividade').value = '';
   
	 // Redefinir os selects selecionados restantes
	 document.getElementById('tipoCliente').selectedIndex = 0;
	 document.getElementById('cEmpresa').selectedIndex = 0;
	 document.getElementById('mEmpresa').selectedIndex = 0;
	 document.getElementById('pEmpresa').selectedIndex = 0;
}

const verificarCamposVazio = () => {
	let formClienteTrue = true;
	let formEmpresaTrue = true;
	const formCliente = [
		solicitante.value,
		username.value,
		email.value,
		fone.value,
		morada.value,
		password.value,
		passwordConfirm.value,
		provinciaCliente.value,
		municipioCliente.value,
		comunaCliente.value,
		nacionalidade.value,
	];

	for (let l = 0; l < formCliente.length; l++) {
		if (formCliente[l] == '') {
			formClienteTrue = false;
		}
	}

	if(tipoCliente.value==='Particular'){
		formEmpresaTrue = true;
	}else if(tipoCliente.value==='Empresa'){
		const formEmpresa = [
			tipoCliente.value,
			atividade.value,
		];

		for (let i = 0; i < formEmpresa.length; i++) {
			if (formEmpresa[i] === '') {
				formEmpresaTrue = false;
			}
		}
	}else if(tipoCliente.value===''){
		formEmpresaTrue = false;
	}

	if (
		(formClienteTrue === true && formEmpresaTrue === false) ||
		(formClienteTrue === false && formEmpresaTrue === true) ||
		(formClienteTrue === false && formEmpresaTrue === false)
	) {
		return false;
	}

	return true;
};

const validarCampos = () => {
	
	var testNome=false;
    var testEmail=false;
    var testFone =false ;
    var testPassword =false;
    var testUser=false

	if (validarString(solicitante.value) === true) {
        testNome=true
	}else{
		openModal('Nome Invalido, introduza um nome valido.'+'\n'
		+'Ex: Ivandro Alfredo,'+'\n'+' Não deve ter numero nem caracter especial');
		return null;
	}

    if(validarStrings(username.value) === true) {
         testUser=true
    }else{
		openModal('Username Invalido, introduza um username valido.'+'\n'
		+'Ex: Ivandro,'+'\n'+' Não deve ter numero nem caracter especial');
		return null;
	}
	
	if (validarEmail(email.value) === true) {
		testEmail=true
	}else{
		openModal('Email Invalido, introduza um email valido.'+'\n');
		return null;
	}

	if (validarTel(fone.value) === true) {
		testFone=true
	}else{
		openModal('Numero de telefone Invalido, introduza um numero valido.'+'\n'+
		'Ex +244 956172924 ou 932234567');
		return null;
	}

	if ( (password.value!='' && passwordConfirm.value!='')&& (password.value === passwordConfirm.value)) {
		if(validarPassword(password.value) === true){
            testPassword = true;
        }
	} else {
		openModal('Passwords diferentes');
		return null;
	}

    if((testPassword=== testUser===testEmail===testFone===testNome)===true) {
       return true
	} 
};


const validarString = (nome) => {
	let regExp = /^[a-zA-ZÀ-ÿ\s']*[-]?[a-zA-ZÀ-ÿ\s']*$/;
	if (regExp.test(nome) == true) {
		return true;
	}
	return false;
};

const validarStrings = (username) => {
	let regExp = /^[a-zA-ZÀ-ÿ\s']*[-]?[a-zA-ZÀ-ÿ\s']*$/;
	if (regExp.test(username) == true) {
		return true;
	}
	return false;
};

const validarTel = (num) => {
	let regExp = /^(?:\+244 9\d{8}|9\d{8})$/;
	if (regExp.test(num) == true) {
		return true;
	}
	return false;
};

const validarEmail = (email) => {
	let regExp = /^([a-zA-Z][\w.-]+@[a-zA-Z][\w.-]+\.[a-zA-Z]{2,})|(\d{8}@isptec\.co\.ao)$/;
	if (regExp.test(email) == true) {
		return true;
	}
	return false;
};

const validarPassword = (pass) => {
	let regExp = /^.{4,}$/;
	if (regExp.test(pass) == true) {
		return true;
	}
	openModal('A senha deve ter no mínimo 4 caracteres alfanuméricos.');
	return false;
};

