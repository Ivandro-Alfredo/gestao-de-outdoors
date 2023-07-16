document.addEventListener("DOMContentLoaded", function() {
  const cardContainer = document.getElementById("verPreco");
  const btn_pesquisar = document.getElementById('pesquisar');
  let originalData = [];

  // Função para obter todos os dados
  function obterTodosDados() {
    fetch('../../Controllers/outdoorController.php?action=tipoOutdoor')
      .then(response => response.json())
      .then(data => {
        if (data !== false) {
          originalData = data;
          preencherCampos(data);
        } else {
          alert('Sem Informacao Desponivel');
        }
      })
      .catch(error => {
        console.error('Erro ao obter os dados');
      });
  }
  obterTodosDados();

  // Função para preencher os campos com os dados fornecidos
  function preencherCampos(data) {
    cardContainer.innerHTML = ''; 
    
    let row = document.createElement("div");
    row.classList.add("row");
    row.style.marginBottom="1%";

    data.forEach((outdoor, index) => {
      const cardColumn = document.createElement("div");
      cardColumn.classList.add("col-md-4");

      const card = document.createElement("div");
      card.classList.add("card");

      const cardBody = document.createElement("div");
      cardBody.classList.add("card-body");

      const titulo = document.createElement("h5");
      titulo.classList.add("card-title");
      titulo.textContent = "Tipo de Outdoor";
      cardBody.appendChild(titulo);

      const preco = document.createElement("p");
      preco.classList.add("card-text");
      preco.textContent = "Tipo: " + outdoor.tipo;
      cardBody.appendChild(preco);

      const localizacao = document.createElement("p");
      localizacao.classList.add("card-text");
      localizacao.textContent = "Localização: " + outdoor.provincia;
      cardBody.appendChild(localizacao);

      const info = document.createElement("a");
      info.classList.add("btn", "btn-primary");
      info.textContent = "Mais Informações";
      // Estilo do botão
      info.style.backgroundColor = "#FFFFFF";
      info.style.color = "#00a683";
      info.style.border = "none";

      // Função para abrir a modal
      info.addEventListener("click", function() {
        openModal(outdoor);
      });
      cardBody.appendChild(info);

      card.appendChild(cardBody);
      cardColumn.appendChild(card);
      row.appendChild(cardColumn);
      // Verifica se atingiu o limite de 3 cards por linha ou se é o último item da lista
      if ((index + 1) % 3 === 0 || index === data.length - 1) {
        cardContainer.appendChild(row);
        row = document.createElement("div");
        row.classList.add("row");
      }
    });
  }

  // Função responsável por criar e abrir a modal
  function openModal(outdoor) {
    // Criar o modal
    const modal = document.createElement("div");
    modal.classList.add("modal");

    const modalContent = document.createElement("div");
    modalContent.classList.add("modal-content");

    const modalHeader = document.createElement("div");
    modalHeader.classList.add("modal-header");
    modalHeader.innerHTML = 
      "<h5 class='modal-title'>Detalhes do Outdoor</h5><button type='button' style='color:#fff' class='close' data-dismiss='modal'>&times;</button>";
    modalContent.appendChild(modalHeader);

    const modalBody = document.createElement("div");
    modalBody.classList.add("modal-body");
    modalBody.innerHTML = `
      <p><strong>Tipo:</strong> ${outdoor.tipo}</p>
      <p><strong>Provincia:</strong> ${outdoor.provincia}</p>
      <p><strong>Municipio:</strong> ${outdoor.municipio}</p>
      <p><strong>Comuna / Distrito:</strong> ${outdoor.comuna}</p>
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

 // Evento de clique no botão de pesquisar
btn_pesquisar.addEventListener("click", function() {
  const pesquisar = document.getElementById('buscar');
  if (pesquisar.value !== '') {
    pesquisarDados(pesquisar.value);
  } else {
    obterTodosDados();
  }
});

// Evento de input no campo de pesquisa
const campoPesquisa = document.getElementById('buscar');
campoPesquisa.addEventListener("input", function() {
  if (campoPesquisa.value === '') {
    obterTodosDados();
  }
});

 // Evento de clique no botão de pesquisar
  btn_pesquisar.addEventListener("click", function() {
    const pesquisar = document.getElementById('buscar');
    if (pesquisar.value !== '') {
      pesquisarDados(pesquisar.value);
    } else {
      obterTodosDados();
    }
  });
  
  // Função para realizar a pesquisa
  function pesquisarDados(pesquisa) {
    const data = originalData.filter(outdoor =>
      outdoor.provincia.toLowerCase().includes(pesquisa.toLowerCase()) ||
      outdoor.municipio.toLowerCase().includes(pesquisa.toLowerCase()) ||
      outdoor.comuna.toLowerCase().includes(pesquisa.toLowerCase())
    );
    preencherCampos(data);
  }


});


/*   const preencherCampos = fetch('../../Controllers/outdoorController.php',
{
  method:'POST',
  headers:{
    'Content-Type': 'application/json',
  },
  body:JSON.stringify({search:pesquisar.value})

})
  .then(response => {return response.json()} )
  .then(data =>{
    if(data!==false){
     

    }else{
      alert('Sem Resultado');
    }
    
  })
  .catch(error => {
      console.error('Erro ao obter os dados',error);
  });*/