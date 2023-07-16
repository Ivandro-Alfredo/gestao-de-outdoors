<?php
    interface IOutdoor{
        public function selectPreco();
        public function selectOutdoorDesponivel();
        public function selectTipoOutdoor();
        public function selectAll($search);
    }
?>