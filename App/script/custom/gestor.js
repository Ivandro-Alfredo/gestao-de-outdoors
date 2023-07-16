  var inserir = document.getElementById("inserir");
  var tipoOutdoor = document.forms[0].elements['tipoDeOutdoor'];
  var preco = document.forms[0].elements['preco'];
  var provincia = document.forms[0].elements['provincia']
  var municipio = document.forms[0].elements['municipio']
  var comuna = document.forms[0].elements['comuna']


  inserir.addEventListener("click", ()=>{
    if (verificarCamposVazio() === true) {
      if(validarPreco(preco.value)=== false) {
        alert('preco invalodo ' +valor)
      }else{
        const dadosForm = new FormData();
        //pegando nos dados do formulario e guardo no dadosforms
        let valor  = parseFloat(preco.value);
        alert('preco invalodo ' +valor)
        dadosForm.append('tipoOutdoor', tipoOutdoor.value);
        dadosForm.append('preco', valor);
        dadosForm.append('provincia', provincia.value);
        dadosForm.append('municipio', municipio.value);
        dadosForm.append('comuna', comuna.value);
        
        fetch('../../Controllers/gestorController.php', {
          method: 'POST',
          body: dadosForm,
        })
          .then((response) => response.text())
          .then((data) => {
            // 
            alert('==> ' + data);
          })
          .catch((error) => {
            // 
            console.error('Erro:', error);
          });
      }
    }
  });
  const validarPreco = (preco) => {
    var isNAN = /^\d*\.?\d+$/.test(preco);

    if (isNAN===true) {
      alert('=> ',isNAN);
      return true
    } else {
      alert('===> ',isNAN);
      return false;
    }
  }

  const verificarCamposVazio = () => {
    let formOutdoorTrue = true;
    //vetor para armazenar as variaveis, antes de serem validados
    const outdoor = [
      tipoOutdoor.value,
      preco.value,
      provincia.value,
      municipio.value,
      comuna.value, 
    ];
  
    //procurando um valor valor vazio
    for (let l = 0; l < outdoor.length; l++) {
      if (outdoor[l] == '') {
        return formOutdoorTrue = false;
      }
    }  
    return true;
  };

  //para os municipios para empresa
  function hablitarMunicipios() {
    const provinciaSelect = document.getElementById('provincia');
    const municipioSelect = document.getElementById('municipio');
    const provinciaSelecionada = provinciaSelect.value;
    
    if (provinciaSelecionada !== '') {
      // Habilitar o select de município
      municipioSelect.disabled = false;
    } else {
      municipioSelect.disabled = true;
    }
  }

  function hablitarComunas() {
    const municipioSelect = document.getElementById('municipio');
    const comunaSelect = document.getElementById('comuna');
    const municipioSelecionado = municipioSelect.value;
  
    if (municipioSelecionado !== '') {
      // Habilitar o select de comuna
      comunaSelect.disabled = false;
    } else {
      comunaSelect.disabled = true;
    }
  }

  