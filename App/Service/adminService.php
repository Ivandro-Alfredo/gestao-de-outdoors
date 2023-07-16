<?php
    require_once '../repository/adminRepository.php';

    class AdminService{
        private $adminRepository=null;
        public function __construct(){
            $this->adminRepository = new AdminRepository();
        }

        public function registar($gestor,$username,$email,$fone,$morada,$password,$criptoPassword,$provincia
        ,$municipio,$comuna ,$nacionalidade)
        {
           $result =  $this->adminRepository->adicionar($gestor,$username,$email,$fone,$morada,$password,$criptoPassword,$provincia
            ,$municipio,$comuna ,$nacionalidade);
            return $result;
        }
        
    }
?>