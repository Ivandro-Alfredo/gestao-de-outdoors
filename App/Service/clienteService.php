<?php

require_once '../repository/clienteRepository.php';

class clienteService{

    private $clienteRepository=null;
    function __construct(){
        $this->clienteRepository = new ClienteRepository();
    }

    public function alterarDadosPessoais($dados){  
       $result= $this->clienteRepository->alterar($dados); 
       return $result;
    }

    public function dadosUsuario($user){
        $result= $this->clienteRepository->select($user);
        return $result;
    }

    public function getValor($tipoOutdoor){
        $resp = $this->clienteRepository->selectPreco($tipoOutdoor);
        return $resp;
    }
    public function aluguelSemImagem($email,$idoutdoor, $quantidade,$total, $provincia, $municipio, $comuna, $dataInicio, $dataFim)
    {
        $resp = 
        $this->clienteRepository->insertAluguelSemImagem($email,$idoutdoor, $quantidade,$total, $provincia, $municipio, $comuna,
                                                         $dataInicio, $dataFim);
        return $resp;
    }

    public function aluguelComImagem($email,$tipoOutdoor, $quantidade,$total, $provincia, $municipio, $comuna, $dataInicio, $dataFim,$imagemNome)
    {      
        if (!empty($imagemNome)) {
            $extensao = pathinfo($imagemNome, PATHINFO_EXTENSION);
            if ($extensao === 'png' || $extensao === 'PNG' || $extensao === 'jpeg' || $extensao === 'JPEG' ||  
                $extensao === 'jpg' || $extensao === 'JPG' ) {

                $caminhoTemporario = $_FILES['imagem']['tmp_name'];
                $imagemTamanho = $_FILES['imagem']['size'];
                $pastaDestino = '../Content/image/upload_user/';
                $nomeUnico = uniqid() . '.' . $extensao;
                if ( move_uploaded_file($caminhoTemporario, $pastaDestino . $nomeUnico)) {
                    $imagem = $pastaDestino . $nomeUnico;
                    $resp = 
                    $this->clienteRepository->insertAluguelComImagem($email,$tipoOutdoor, $quantidade,$total, $provincia, $municipio, 
                                                                     $comuna,$dataInicio, $dataFim,$imagem);
                    return $resp;

                } else {
                    return "Falha ao salvar a imagem no diretório de destino.";
                }
            } else {
              return "Tipo de imagem não suportado. Apenas arquivos PNG e JPEG são permitidos.";
            }
        } else {
            return "Falha ao extrair o nome do arquivo.";
        }   
    }

    public function enviarComprovativoParaDb($idaluguel,$data,$arquivo){
        if (!empty($arquivo)) {
            $extensao = pathinfo($arquivo, PATHINFO_EXTENSION);
            if ($extensao === 'png' || $extensao === 'PNG' || $extensao === 'jpeg' || $extensao === 'JPEG' ||  
                $extensao === 'jpg' || $extensao === 'JPG' ) {

                $caminhoTemporario = $_FILES['arquivo']['tmp_name'];
                $imagemTamanho = $_FILES['arquivo']['size'];
                $pastaDestino = '../Content/image/upload_comprovativo/image/';
                $nomeUnico = uniqid() . '.' . $extensao;
                if ( move_uploaded_file($caminhoTemporario, $pastaDestino . $nomeUnico)) {
                   $arquivo = $pastaDestino . $nomeUnico;
                    return $this->clienteRepository->inserirComprovativo($idaluguel,$data,$arquivo);
                } else {
                    return "Falha ao salvar a imagem no diretório de destino.";
                }
            } else if($extensao === 'pdf' || $extensao === 'PDF') {

                $caminhoTemporario = $_FILES['arquivo']['tmp_name'];
                $imagemTamanho = $_FILES['arquivo']['size'];
                $pastaDestino = '../Content/image/upload_comprovativo/pdf/';
                $nomeUnico = uniqid() . '.' . $extensao;
                if ( move_uploaded_file($caminhoTemporario, $pastaDestino . $nomeUnico)) {
                    $arquivo = $pastaDestino . $nomeUnico;
                    return $this->clienteRepository->inserirComprovativo($idaluguel,$data,$arquivo);
                    
                } else {
                    return "Falha ao salvar a imagem no diretório de destino.";
                }
            }else{
                return "Tipo de imagem não suportado. Apenas arquivos PNG e JPEG são permitidos.";
            }
        } else {
            return "Falha ao extrair o nome do arquivo.";
        }   
    }

    public function consultarSolicitacaoDeAluguel($email){
        $return = $this->clienteRepository->selectMyAluguel($email);
        return $return;
    }

    public function verificaCliente($email){
       $return = $this->clienteRepository->clienteExiste($email);
       return $return;
    }

    public function getOutdoor(){
        $result = $this->clienteRepository->selectAllOutdoor();
        return $result;
    }

    public function getListaSolicoes($email){
        $result = $this->clienteRepository->selectAllSolitacoes($email);
        return $result;
    }

}

?>