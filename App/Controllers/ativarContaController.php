<?php
    require_once '../Service/ativarContaService.php';

    class AtivarConta {
        private $contaService = null;
        public function __construct() {
            $this->contaService = new ContaService();
        }

        public function selectAllConta() {
            $contas = $this->contaService->selectAll();
            return $contas;
        }

        public function ativarConta($dados) {
          $result= $this->contaService->atualizarConta($dados); 
          return $result;   
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $dados = file_get_contents('php://input');
        $contasAtualizadas = json_decode($dados, true); 

        if (!empty($contasAtualizadas)) {
            $ativarConta = new AtivarConta();
            $update = $contasAtualizadas;
            $resultado=$ativarConta->ativarConta($update);

            $sucessoAtualizacao = 0;
            $erroAtualizacao = 0;
            $falhaAtivarConta = 0;
            $falhaEnviarEmail = 0;
            $falharequisicao = 0;
            $contasPendenteDesativadas = 0;
            
            foreach ($resultado  as $result) {
                if ($result === 'Conta ativada.') {
                    $sucessoAtualizacao++;
                } elseif ($result === 'Falha ao ativar a conta') {
                    $falhaAtivarConta++;
                } elseif (strpos($result, 'Problemas ao enviar email') !== false) {
                    $falhaEnviarEmail++;
                } else if($result==='Requisicao falhou') {
                    $falharequisicao++;
                }else if($result==='Atualização Pendente/Desativada'){
                    $contasPendenteDesativadas++;
                }else{
                    $erroAtualizacao++;
                }
            }

            $relatorio = [
                'sucessoAtualizacao' => $sucessoAtualizacao,
                'erroAtualizacao' => $erroAtualizacao,
                'falhaAtivarConta' => $falhaAtivarConta,
                'falhaEnviarEmail' => $falhaEnviarEmail,
                'falharequisicao' => $falharequisicao,
                'contasPendenteDesativadas'=> $contasPendenteDesativadas
            ];
            //header('Content-Type: application/json');
            echo json_encode($relatorio);
            
        } else {
            $resposta = array('status' => 'Erro', 'msg' => 'Dados não foram fornecidos');
            header('Content-Type: application/json');
            echo json_encode($resposta);
        }
    } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (isset($_GET['action']) && $_GET['action'] === 'listarConta') {
            $listarConta = new AtivarConta();
            $resultado = $listarConta->selectAllConta();
            header('Content-Type: application/json');
            echo json_encode($resultado);
        }
    }
?>
