var alterar = document.getElementById("alterarDados")
var nome = document.forms[0].elements['fullname'];
var username = document.forms[0].elements['user'];
var idcliente = document.getElementById('idcliente');
var email = document.forms[0].elements['emailUser'];
var morada = document.forms[0].elements['morada'];
var fone = document.forms[0].elements['fone'];
var passAntiga = document.forms[0].elements['oldPass'];
var passNova = document.forms[0].elements['newPass'];
var provincia = document.forms[0].elements['province']
var municipio = document.forms[0].elements['municipe'];
var comuna = document.forms[0].elements['communa'];
var password = document.getElementById("senha");

alterar.addEventListener("click", () => {
// modal.style.display = "block";
    if(passAntiga.value !=''&& passNova.value===''){
        openModal('Confirma a Sua Password, Preenchendo O outro Campo.');
        return;
    }else if(passAntiga.value===''&& passNova.value!=''){
        openModal("Para Alterares A Sua Password, Deves preencher os dois campos");
       return;
    }else if((passAntiga.value!='' && passNova.value!='')&& (passAntiga.value !=passNova.value)){
        openModal('Passwords Diferentes');
        return;
    }else if((passAntiga.value!='' && passNova.value!='') && (passAntiga.value === passNova.value)){
        if (verificarCamposVazio() === true) {
            if (validarCampos() === true) {
                const alterarDados ={
                    nome: nome.value,
                    username: username.value,
                    idcliente: idcliente.value,
                    email: email.value,
                    morada: morada.value,
                    fone: fone.value,
                    password: passAntiga.value,
                    provincia:provincia.value,
                    municipio: municipio.value,
                    comuna: comuna.value,
                }

                fetch('../../Controllers/clienteController.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ alterarDados }),
                })
                .then((response) => response.json())
                .then((data) => {
                    openModal(data);
                    setTimeout(() => {
                        window.location.reload();
                    }, 3000);
                })
                .catch((error) => {
                    openModal('Ocorreu um erro:', error);
                });
            }else{
                openModal('')
            }
        }else{
            openModal('Preencha Os Campos.')
        }
    }else{
        const alterarDados ={
            nome: nome.value,
            username: username.value,
            idcliente: idcliente.value,
            email: email.value,
            morada: morada.value,
            fone: fone.value,
            password: password.value,
            provincia:provincia.value,
            municipio: municipio.value,
            comuna: comuna.value,
        }
        if (verificarCamposVazio() === true) {
            if (validarCampos() === true) {
               fetch('../../Controllers/clienteController.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ alterarDados }),
                })
                    .then((response) => response.json())
                    .then((data) => {
                        openModal(data);
                    })
                    .catch((error) => {
                        openModal('Ocorreu um erro:', error);
                    });
            }else{

            }
        }else{
            openModal('Preencha Os Campos.')
        }
    }

});

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

const verificarCamposVazio = () => {
	const comAlteracaoDeSenha = [
		nome.value,
		username.value,
		email.value,
		fone.value,
		morada.value,
		passAntiga.value,
		passNova.value,
		provincia.value,
		municipio.value,
		comuna.value,
	];

    if(passAntiga.value ==='' && passNova.value ===''){
        const semAlteracaDaSenha = [
            nome.value,
            username.value,
            email.value,
            fone.value,
            morada.value,
            provincia.value,
            municipio.value,
            comuna.value,
        ];

        for (var l = 0; l < semAlteracaDaSenha.length; l++) {
            if(semAlteracaDaSenha[l]===''){
                return false
            }
	    }
	    return true;
    }

	//procurando um valor valor vazio
	for (var l = 0; l < comAlteracaoDeSenha.length; l++) {
        if(comAlteracaoDeSenha[l]===''){
		    return false
        }
	}
	return true;
};

//codigo para validar compos
const validarCampos = () => {
    var testNome=false;
    var testFone =false ;
    var testPassword =false;
    var testUser=false
    var testEmail=false;

	if (validarString(nome.value) === true) {
        testNome=true
	}else{
        openModal('Nome Invalido, Introduza um nome valido.')
        return false
    }

    if (validarEmail(email.value) === true) {
		testEmail=true
	}else{
        openModal('Endereço de email Invalido, Introduza um endereço de email valido.')
        return false
    }

    if(validarUser(username.value) === true) {
         testUser=true
    }else{
        openModal('Username invalido, Introduza um nome de usuario valido.')
        return false
    }
	
	if (validarTel(fone.value) === true) {
		testFone=true
	}else{
        openModal('Numero de telefone invalido, Introduza um numero valido.')
        return false
    }

	if ( (passAntiga.value!='' && passNova.value!='')&& (passAntiga.value === passNova.value)) {
		if(validarPassword(passAntiga.value) === true){
            testPassword = true;
        }else{
            testPassword = false;
            return false
        }
	} else if(passAntiga.value ==='' && passNova.value==='') {
        testPassword = true;
	}else{
        testPassword = false;
        return false
    }

    return true
        
};

//funcoes para validar
const validarString = (nome) => {
	let regExp =/^[a-zA-ZÀ-ÿ\s']*[-]?[a-zA-ZÀ-ÿ\s']*$/;
    if (regExp.test(nome) === true) {
		return true;
	}
	return false;
};

const validarUser = (username) => {
	let regExp =/^[a-zA-ZÀ-ÿ\s']*[-]?[a-zA-ZÀ-ÿ\s']*$/;
    if (regExp.test(username) === true) {
		return true;
	}
	return false;
};

const validarTel = (num) => {
	let regExp = /^(?:\+244 9\d{8}|9\d{8})$/
	if (regExp.test(num) == true) {
		return true;
	}
	return false;
};

const validarEmail = (email) => {
	let regExp = /^[a-zA-Z0-9]+([.-]?[a-zA-Z0-9]+)*@(?:gmail|hotmail|outlook)\.com|(\d{8})@isptec\.co\.ao$/;
	if (regExp.test(email) == true) {
		return true;
	}
	return false;
};

const validarPassword = (pass) => {
    let regExp = /^.{4,}$/;
    if(regExp.test(pass)){
        return true;
    }
    openModal('A senha deve ter no mínimo 4 caracteres alfanuméricos.');
    return false;
};

