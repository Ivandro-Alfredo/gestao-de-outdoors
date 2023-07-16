<?php
    interface IClient{
        public function alterar($dados);
        public function inserir(/**parametros */);
        public function select($email);
        public function selectPreco($tipo);
        public function insertAluguelSemImagem($email,$tipoOutdoor, $quantidade,$total, $provincia, $municipio, $comuna, $dataInicio, $dataFim);
        public function insertAluguelComImagem($email,$tipoOutdoor, $quantidade,$total, $provincia, $municipio, $comuna, $dataInicio, $dataFim,$imagem);
        public function selectMyAluguel($email);
        public function clienteExiste($email);
        public function selectAllOutdoor();
        public function selectAllSolitacoes($email);
        public function inserirComprovativo($idaluguel,$data,$arquivo);
       
    }
?>