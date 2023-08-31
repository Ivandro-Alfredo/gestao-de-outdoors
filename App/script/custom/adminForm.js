var gestor = document.forms[0].elements['gestor'];
var username = document.forms[0].elements['username'];
var email = document.forms[0].elements['email'];
var fone = document.forms[0].elements['fone'];
var morada = document.forms[0].elements['morada'];
var password = document.forms[0].elements['password'];
var passwordConfirm = document.forms[0].elements['confirmar'];
var provincia = document.forms[0].elements['provincia'];
var municipio = document.forms[0].elements['municipio'];
var comuna = document.forms[0].elements['comuna'];
var nacionalidade = document.forms[0].elements['nacionalidade'];
var registar = document.getElementById('registaGestor');

window.onload = () => {
	const provinciaSelect = document.getElementById('provincia');
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
}

function hablitarMunicipios() {
	const provinciaSelect = document.getElementById('provincia');
	const municipioSelect = document.getElementById('municipio');
	const provinciaSelecionada = provinciaSelect.value;
	if (provinciaSelecionada !== '') {
		municipioSelect.disabled = false;
		carregarMunicipios()
	} else {
		municipioSelect.disabled = true;
	}
}

function carregarMunicipios() {
	const provinciaSelect = document.getElementById('provincia');
	const municipioSelect = document.getElementById('municipio');
	municipioSelect.innerHTML = '<option value="" selected>MUNICIPIO</option>';
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

function hablitarComunas() {
	const municipioSelect = document.getElementById('municipio');
	const comunaSelect = document.getElementById('comuna');
	const municipioSelecionado = municipioSelect.value;
	if (municipioSelecionado !== '') {
		comunaSelect.disabled = false;
		carregarComunas()
	} else {
		comunaSelect.disabled = true;
	}
}

function carregarComunas() {
	const municipioSelect = document.getElementById('municipio');
	const comunaSelect = document.getElementById('comuna');
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

registar.addEventListener('click', () => {
	if (verificarCamposVazio() === true) {
		if (validarCampos() === true) {
			const dadosForm = new FormData();
			dadosForm.append('gestor', gestor.value);
			dadosForm.append('username', username.value);
			dadosForm.append('email', email.value);
			dadosForm.append('fone', fone.value);
			dadosForm.append('morada', morada.value);
			dadosForm.append('password', password.value);
			dadosForm.append('provincia', provincia.value);
			dadosForm.append('municipio', municipio.value);
			dadosForm.append('comuna', comuna.value);
			dadosForm.append('nacionalidade', nacionalidade.value);

			fetch('../../Controllers/adminController.php', {
				method: 'POST',
				body: dadosForm,
			})
			.then((response) => response.json())
			.then((data) => {
				openModal(data);
			})
			.catch((error) => {
				openModal(error);
			});
		}else if(validarCampos() === null) {
		}else{
			openModal('Verifica Os dados Introduzidos.');
		}
	} else {
		openModal('Verifique se não há campos vazios.');
	}
});

function openModal(outdoor) {
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
	<p><strong></strong> ${outdoor}</p>
	`;
	modalContent.appendChild(modalBody);
	modal.appendChild(modalContent);
	document.body.appendChild(modal);
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


const verificarCamposVazio = () => {
	const formGestor = [
		gestor.value,
		username.value,
		email.value,
		fone.value,
		morada.value,
		password.value,
		passwordConfirm.value,
		provincia.value,
		municipio.value,
		comuna.value,
		nacionalidade.value,
	];

	for (let l = 0; l < formGestor.length; l++) {
		if (formGestor[l] == '') {
			return false;
		}
	}
	return true;
};

const validarCampos = () => {
	var testNome=false;
    var testEmail=false;
    var testFone =false ;
    var testPassword =false;
    var testUser=false

	if (validarString(nome.value) === true) {
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