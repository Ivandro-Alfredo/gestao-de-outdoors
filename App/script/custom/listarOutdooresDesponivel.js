document.addEventListener("DOMContentLoaded", function() {
  const cardContainer = document.getElementById("verPreco");
  const btn_pesquisar = document.getElementById('pesquisar');
  let originalData = [];

  function obterTodosDados() {
    fetch('../../Controllers/outdoorController.php?action=outdoorDisponivel')
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
      titulo.textContent = "Outdoors";
      cardBody.appendChild(titulo);
      const preco = document.createElement("p");
      preco.classList.add("card-text");
      preco.textContent = "Estado do Outdoor: " + outdoor.estado;
      cardBody.appendChild(preco);
      const localizacao = document.createElement("p");
      localizacao.classList.add("card-text");
      localizacao.textContent = "Localização: " + outdoor.provincia;
      cardBody.appendChild(localizacao);
      const info = document.createElement("a");
      info.classList.add("btn", "btn-primary");
      info.textContent = "Mais Informações";
      info.style.backgroundColor = "#FFFFFF";
      info.style.color = "#00a683";
      info.style.border = "none";
      info.addEventListener("click", function() {
        openModal(outdoor);
      });
      cardBody.appendChild(info);
      card.appendChild(cardBody);
      cardColumn.appendChild(card);
      row.appendChild(cardColumn);
      if ((index + 1) % 3 === 0 || index === data.length - 1) {
        cardContainer.appendChild(row);
        row = document.createElement("div");
        row.classList.add("row");
      }
    });
  }

  function openModal(outdoor) {
    const modal = document.createElement("div");
    modal.classList.add("modal");
    const modalContent = document.createElement("div");
    modalContent.classList.add("modal-content");
    const modalHeader = document.createElement("div");
    modalHeader.classList.add("modal-header");
    modalHeader.innerHTML = 
      "<h5 class='modal-title'>Detalhes do Outdoor</h5><button type='button' style='color:#FFFFFF' class='close' data-dismiss='modal'>&times;</button>";
    modalContent.appendChild(modalHeader);
    const modalBody = document.createElement("div");
    modalBody.classList.add("modal-body");
    modalBody.innerHTML = `
      <p><strong>Estado:</strong> ${outdoor.estado}</p>
      <p><strong>Provincia:</strong> ${outdoor.provincia}</p>
      <p><strong>Municipio:</strong> ${outdoor.municipio}</p>
      <p><strong>Comuna / Distrito:</strong> ${outdoor.comuna}</p>
    `;
    modalContent.appendChild(modalBody);
    modal.appendChild(modalContent);
    document.body.appendChild(modal);
    modal.style.display = "block";
		modal.style.display = "block";
		modal.style.width = "40%";
		modal.style.marginLeft = "30%";
		modal.style.marginTop = "10%";
		modalHeader.style.backgroundColor = "#004349";
		modalHeader.style.color ="#fff";
		modalBody.style.backgroundColor="#C0C0C0";
    const closeButton = modal.querySelector(".close");
    closeButton.addEventListener("click", function() {
      document.body.removeChild(modal);
    });
  }

btn_pesquisar.addEventListener("click", function() {
  const pesquisar = document.getElementById('buscar');
  if (pesquisar.value !== '') {
    pesquisarDados(pesquisar.value);
  } else {
    obterTodosDados();
  }
});

const campoPesquisa = document.getElementById('buscar');
campoPesquisa.addEventListener("input", function() {
  if (campoPesquisa.value === '') {
    obterTodosDados();
  }
});

  btn_pesquisar.addEventListener("click", function() {
    const pesquisar = document.getElementById('buscar');
    if (pesquisar.value !== '') {
      pesquisarDados(pesquisar.value);
    } else {
      obterTodosDados();
    }
  });
  
  function pesquisarDados(pesquisa) {
    const data = originalData.filter(outdoor =>
      outdoor.provincia.toLowerCase().includes(pesquisa.toLowerCase()) ||
      outdoor.municipio.toLowerCase().includes(pesquisa.toLowerCase()) ||
      outdoor.comuna.toLowerCase().includes(pesquisa.toLowerCase())
    );
    preencherCampos(data);
  }
});