  var inserir = document.getElementById("inserir");
  var tipoOutdoor = document.forms[0].elements['tipoDeOutdoor'];
  var preco = document.forms[0].elements['preco'];
  var provincia = document.forms[0].elements['provincia']
  var municipio = document.forms[0].elements['municipio']
  var comuna = document.forms[0].elements['comuna']

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

  inserir.addEventListener("click", ()=>{
    if (verificarCamposVazio() === true) {
      if(validarPreco(preco.value)=== false) {
        alert('preco invalodo ' +valor)
      }else{
        const dadosForm = new FormData();
        let valor  = parseFloat(preco.value);
        dadosForm.append('tipoOutdoor', tipoOutdoor.value);
        dadosForm.append('preco', valor);
        dadosForm.append('provincia', provincia.value);
        dadosForm.append('municipio', municipio.value);
        dadosForm.append('comuna', comuna.value);
        fetch('../../Controllers/gestorController.php', {
          method: 'POST',
          body: dadosForm,
        })
          .then((response) => response.json())
          .then((data) => {
            openModal(data);
            if (data === 'Dados enviados com sucesso!') {
              setTimeout(() => {
                  window.location.reload(); 
              }, 5000); 
            }
          })
          .catch((error) => {
            openModal(error);
          });
      }
    }
  });

  function openModal(informacao) {
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
    <p><strong></strong> ${informacao}</p>
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

  const validarPreco = (preco) => {
    var isNAN = /^\d*\.?\d+$/.test(preco);

    if (isNAN===true) {
      return true
    } else {
      return false;
    }
  }

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