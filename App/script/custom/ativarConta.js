
var atualizar = document.getElementById('update');

window.onload = () => {
	fetch('../../Controllers/ativarContaController.php?action=listarConta')
		.then((response) => response.json())
		.then((resultado) => {
			var tabela = document.querySelector('#listar');
			tabela.innerHTML = '';
			for (let i = 0; i < resultado.length; i++) {
				let linha = tabela.insertRow();

				linha.insertCell().innerHTML = resultado[i].nome;
				linha.insertCell().innerHTML = resultado[i].username;
				linha.insertCell().innerHTML = resultado[i].email;
				linha.insertCell().innerHTML = resultado[i].tipoCliente;
				linha.insertCell().innerHTML = resultado[i].fone;
				linha.insertCell().innerHTML = resultado[i].morada;
				linha.insertCell().innerHTML = resultado[i].provincia;
				linha.insertCell().innerHTML = resultado[i].municipio;
				linha.insertCell().innerHTML = resultado[i].comuna;
				linha.insertCell().innerHTML = resultado[i].nacionalidade;
				linha.insertCell().innerHTML = resultado[i].categoria;
				linha.insertCell().innerHTML = resultado[i].estado;

				let cellEstado = linha.insertCell();
				let estado = resultado[i].estado;

				if (estado === 'pendente') {
					cellEstado.innerHTML = `
					<select class="estado" >
						<option value="pendente" selected>Pendente</option>
						<option value="ativo">Ativar</option>
						<option value="desativado">Desativar</option>
					</select>`;
				} else if (estado === 'ativo') {
					cellEstado.innerHTML = `
					<select class="estado" >
						<option value="pendente">Pendente</option>
						<option value="ativo" selected>Ativar</option>
						<option value="desativado">Desativar</option>
					</select>`;
				} else {
					cellEstado.innerHTML = `
					<select  class="estado">
						<option value="pendente">Pendente</option>
						<option value="ativo">Ativar</option>
						<option value="desativado" selected>Desativado</option>
					</select>`;
				}
			}
		})
		.catch((error) => {
			ropenModal('Sem contas para atualizaao');
		});
};

// fazendo o update, id usado nesse e no outro caso e o id de entrada da tabela
atualizar.addEventListener('click', () => {
	var tabela = document.querySelector('#listar');
	var linhaTabela = tabela.querySelectorAll('tr');
	let contasAtualizadas = [];

	Array.from(linhaTabela);
	linhaTabela.forEach((linha) => {
		var coluna = linha.querySelectorAll('td');

		let contas = {
			nome: coluna[0].innerHTML,
			username: coluna[1].innerHTML,
			email: coluna[2].innerHTML,
			tipoCliente: coluna[3].innerHTML,
			telefone: coluna[4].innerHTML,
			morada: coluna[5].innerHTML,
			provincia: coluna[6].innerHTML,
			municipio: coluna[7].innerHTML,
			comuna: coluna[8].innerHTML,
			nacionalidade: coluna[9].innerHTML,
			categoria: coluna[10].innerHTML,
			estado: coluna[11].innerHTML,
		};
		contasAtualizadas.push(contas)  
	});

	var newEstado = document.getElementsByClassName('estado');
	var estados = Array.from(newEstado).map((select) => select.value);

	for (var i = 0; i < contasAtualizadas.length; i++) {
		contasAtualizadas[i].estado = estados[i];
	}

	fetch('../../Controllers/ativarContaController.php', {
		method: 'POST',
		headers: {
			'Content-Type': 'application/json',
		},
		body: JSON.stringify({ contasAtualizadas }),
	})
	.then((response) => response.json())
	.then((data) => {
		openModal('Contas ativadas: '+data.sucessoAtualizacao+'<br>'
		          +'Falha ao ativar conta: '+data.falhaAtivarConta+'<br>'
				  +'Problemas ao enviar email: '+data.falhaEnviarEmail+'<br>'
				  +'Falhas na requisicao: '+data.falharequisicao+'<br>'
				  +'Total de contas pendentes + desativadas: '+data.contasPendenteDesativadas+'<br>'
				  +'Erros de atualizacao: '+data.erroAtualizacao)
		setTimeout(() => {
			window.location.reload();
		}, 3000);
	})
	.catch((error) => {
		openModal(error);
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
		"<h5 class='modal-title'>Relatório</h5>"
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
});
