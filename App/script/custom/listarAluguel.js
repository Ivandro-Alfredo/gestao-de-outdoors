var userEmail = document.getElementById('email');
window.onload = () => {
	fetch('../../Controllers/clienteController.php', {
        method: 'POST',
        headers: {
        'content-type': 'application/json; charset=utf8',
    },
        body: JSON.stringify({ userEmail:userEmail.value }),
    })
		.then((response) => response.json())
		.then((resultado) => {
			console.log(JSON.stringify(resultado));
			var tabela = document.querySelector('#listar');
			tabela.innerHTML = '';
			for (let i = 0; i < resultado.length; i++) {
				let linha = tabela.insertRow();
				linha.insertCell().innerHTML = resultado[i].nome;
				linha.insertCell().innerHTML = resultado[i].tipo;
				linha.insertCell().innerHTML = resultado[i].quantidade;
				linha.insertCell().innerHTML = resultado[i].total;
				linha.insertCell().innerHTML = resultado[i].provincia;
				linha.insertCell().innerHTML = resultado[i].municipio;
				linha.insertCell().innerHTML = resultado[i].comuna;
				linha.insertCell().innerHTML = resultado[i].dataInicio;
				linha.insertCell().innerHTML = resultado[i].dataFim;
				linha.insertCell().innerHTML = resultado[i].imagem;
                linha.insertCell().innerHTML = resultado[i].estado;
			}
		})
		.catch(() => {
			alert('Oops!, Requisisao falhou');
		});
};