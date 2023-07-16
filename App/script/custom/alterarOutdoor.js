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
      // Habilitar o select de comuna
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