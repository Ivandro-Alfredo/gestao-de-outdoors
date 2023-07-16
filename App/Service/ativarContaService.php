<?php
    require_once '../repository/ativarContaRepository.php';

class ContaService{
    private $contaRepository=null;

    public function __construct() {
        $this->contaRepository = new ContaRepository();
    }

    public function selectAll() {
        $selectAllConta = $this->contaRepository->getAllConta();
        return $selectAllConta;
    }

    public function atualizarConta($dados){
        $resultados= array();
        foreach ($dados['contasAtualizadas'] as $conta) {
            $contas = array();
            foreach ($conta as $campo => $valor) {
                if ($campo == 'nome' || $campo == 'username' || $campo == 'email' 
                    || $campo == 'telefone' || $campo == 'morada' || $campo == 'provincia'
                    || $campo == 'municipio' || $campo == 'comuna' || $campo == 'nacionalidade' 
                    || $campo == 'categoria' || $campo == 'estado') {
                    
                        $contas[$campo] = $valor;
                }
            }
            $resultado = $this->contaRepository->update($contas);
            $resultados[] = $resultado;
        }
        return $resultados;
    }
}
