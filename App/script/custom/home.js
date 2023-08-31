var login = document.getElementById('loginButton');
var modalContainer = document.getElementById('modal-container');
var loginModal = document.getElementById('botao');
var cancel = document.getElementById('cancelar');
var enviar = document.getElementById('enviar');

login.addEventListener('click', (e) => {
	e.preventDefault();
	modalContainer.style.display = 'block';
});

cancel.addEventListener('click', () => {
	modalContainer.style.display = 'none'
});

enviar.addEventListener('click', () => {
	var email = document.getElementById('email');
	var password = document.getElementById('password');
	if (verificarCamposVazios(email.value, password.value) === true) {
		const loginAcess = new FormData();
		loginAcess.append('email', email.value);
		loginAcess.append('password', password.value);
		fetch('../Controllers/loginController.php', {
			method: 'POST',
			body: loginAcess,
		})
		.then((response) => response.json())
		.then((data) => {
			if (data.tipo === 'Administrador') {
				window.location.href = '../Views/perfil/admin.php';
			} else if (data.tipo === 'Cliente'){
				window.location.href = '../Views/perfil/cliente.php';
			}else if (data.tipo === 'Gestor'){
				window.location.href = '../Views/perfil/gestor.php';
			}else{
				fetch('../Controllers/clienteController.php', {
					method: 'POST',
					body: JSON.stringify( ({verificarEmail:email.value})),
				}).then((response) => response.json())
				.then((data) => {
					if(data==='pendente'||data==='desativado'){
						openModal('Verique se recebeu um email,'+'<br>'
						+'caso nao, aguarde ate a confirmacao da'+'<br>'
						+'ativacao da sua conta, obrigado.'+'<br>'
						+'Equpe da XPTO-SOLUTIONS.')
					}else{
						openModal('Usuario ou password Invalido')
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


	function openModal(login) {
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
});

function verificarCamposVazios(username, password) {
	if (
		(username === '' && password === '') ||
		(username === '' && password != '') ||
		(username != '' && password === '')
	) {
		return false;
	}
	return true;
}
