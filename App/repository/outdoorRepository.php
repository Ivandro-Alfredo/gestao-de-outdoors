<?php
    require_once '../config/dbconfig.php';
    require_once '../repository/interface/IOutdoor.php';
   // require_once '../Models/outdoorModel.php';

    class OutdoorRepository implements IOutdoor{
        private $dbConnection;

        function __construct(){
            $this->dbConnection = DatabaseConnection::getInstance();
        }

        public function selectPreco(){
            try{
                $query = $this->dbConnection->prepare("SELECT outdoor.preco, outdoor.provincia, outdoor.municipio, outdoor.comuna
                FROM outdoor ");
                $query->execute();
                if ($query->rowCount() > 0) {
                    $result = $query->fetchAll(PDO::FETCH_ASSOC);
                    return $result;
                } else {
                    return false;
                }
            }catch(Exception $e){
                echo "Falha na requisicao, ".$e->getMessage();
            }
        }

        public function selectOutdoorDesponivel(){
            try{
                $query = $this->dbConnection->prepare("SELECT outdoor.estado, outdoor.provincia, outdoor.municipio, outdoor.comuna
                FROM outdoor ");
                $query->execute();
                if ($query->rowCount() > 0) {
                    $result = $query->fetchAll(PDO::FETCH_ASSOC);
                    return $result;
                } else {
                    return false;
                }
            }catch(Exception $e){
                echo "Falha na requisicao, ".$e->getMessage();
            }
        }

        public function selectTipoOutdoor(){
            try{
                $query = $this->dbConnection->prepare("SELECT outdoor.tipo, outdoor.provincia, outdoor.municipio, outdoor.comuna
                FROM outdoor ");
                $query->execute();
                if ($query->rowCount() > 0) {
                    $result = $query->fetchAll(PDO::FETCH_ASSOC);
                    return $result;
                } else {
                    return false;
                }
            }catch(Exception $e){
                echo "Falha na requisicao, ".$e->getMessage();
            }
        }

        //pesquisa
        public function selectAll($search){
            try{
                $query = $this->dbConnection->prepare("SELECT outdoor.estado, outdoor.provincia, outdoor.municipio, outdoor.comuna
                FROM outdoor WHERE provincia=:search or municipio = :search or  comuna = :search");
                 $query->bindParam(':search', $search);
                $query->execute();
                if ($query->rowCount() > 0) {
                    $result = $query->fetchAll(PDO::FETCH_ASSOC);
                    return $result;
                } else {
                    return false;
                }
            }catch(Exception $e){
                echo "Falha na requisicao, ".$e->getMessage();
            }
        }
    }

?>