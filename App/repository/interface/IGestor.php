<?php
    interface IGestor{
        public function insert($outdoor, $preco, $provincia,$municipio,$comuna);
        public function update($id, $outdoor, $preco, $provincia,$municipio,$comuna);
        public function delete($codOutdoor);
        public function select();
        public function caminho($id);
        public function allSolicitacao();
        public function aprovarSolicitacao($idaluguel);
        public function recusarSolicitacao($idaluguel);
    }
?>