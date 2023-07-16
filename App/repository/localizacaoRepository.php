<?php
require_once '../config/dbconfig.php';
require_once '../repository/interface/ILocalizacao.php';
//require_once '../Models/localizacaoContaModel.php';

class localizacaoRepository  implements ILocalizacao {
    private $dbConnection;

    function __construct(){
        $this->dbConnection = DatabaseConnection::getInstance();
    }

    public function selectProvince() {
       #retorna o
        $query = $this->dbConnection->prepare("SELECT * FROM provincia");
        $query->execute();
        #
        if ($query->rowCount() > 0) {
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return  $result;
        } else {
            echo '';
            return null;
        }
    }

    public function  selectMunicipioProvince($id){
        $idprovincia=$id['idprovincia'];
        
        $query = $this->dbConnection->prepare("SELECT municipio.idmunicipio,municipio.municipio 
                                               FROM municipio WHERE municipio.idprovincia=:idprovincia");
        $query->bindParam(':idprovincia', $idprovincia);
        $query->execute();
        $result = $query->fetchAll();
        try {
            if ($result === false || empty($result)) {
                return "Nenhum resultado encontrado.";
            }
            return $result;
        } catch (Exception $th) {
            return "Error: " . $th->getMessage().", Falhar ao acessar a base de dados.";
        }
    }

    public function selectComunaMunicipio($id){
        $idmunicipio = $id['idmunicipio']; 
        $query = $this->dbConnection->prepare("SELECT comuna.idcomuna, comuna.comuna 
                                               FROM comuna WHERE comuna.idmunicipio=:idmunicipio");
        $query->bindParam(':idmunicipio', $idmunicipio);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
    
        try {
            if ($result === false || empty($result)) {
                return "Nenhum resultado encontrado.";
            }
            return $result;
        } catch (Exception $th) {
            return "Error: " . $th->getMessage().", Falhar ao acessar a base de dados.";
        }
    }
    
}
