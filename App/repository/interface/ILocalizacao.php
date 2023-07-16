<?php
    interface ILocalizacao{
        public function selectProvince();
        public function selectMunicipioProvince($municipo);
        public function selectComunaMunicipio($comuna);
    }
?>