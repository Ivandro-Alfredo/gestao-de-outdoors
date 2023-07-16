<?php
    require_once '../config/dbconfig.php';
    require_once '../repository/interface/IGestor.php';

    class GestorRepository implements IGestor{
        private $dbConnection;

        function __construct(){
            $this->dbConnection = DatabaseConnection::getInstance();
        }

        public function insert($outdoor, $preco, $provincia,$municipio,$comuna) {
            $states ='disponivel';

            $query = $this->dbConnection->prepare("SELECT provincia.provincia, municipio.municipio,comuna.comuna
            FROM provincia,municipio,comuna WHERE provincia.idprovincia = $provincia and municipio.idmunicipio=$municipio
            and comuna.idcomuna=$comuna");
            $query->execute();

            if ($query->rowCount() > 0) {
                $result = $query->fetch();
                $provincia = $result['provincia'];
                $municipio = $result['municipio'];
                $comuna = $result['comuna'];

                $query = $this->dbConnection->prepare("INSERT INTO outdoor (tipo, preco, provincia, municipio, comuna,estado) 
                VALUES (:outdoor, :preco, :provincia, :municipio, :comuna, :estado)");
                            
                $query->bindParam(':outdoor', $outdoor);
                $query->bindParam(':preco', $preco);
                $query->bindParam(':provincia', $provincia);
                $query->bindParam(':municipio', $municipio);
                $query->bindParam(':comuna', $comuna);
                $query->bindParam(':estado', $states);
                if($query->execute()){
                    return true;
                }else{
                    return false;
                }
            }
        }

        public function update($id, $outdoor, $preco, $provincia, $municipio, $comuna)  {
            $query = $this->dbConnection->prepare("SELECT provincia.provincia, municipio.municipio,comuna.comuna
            FROM provincia,municipio,comuna WHERE provincia.idprovincia = $provincia and municipio.idmunicipio=$municipio
            and comuna.idcomuna=$comuna");
            $query->execute();

            if ($query->rowCount() > 0) {
                $result = $query->fetch();
                $provincia = $result['provincia'];
                $municipio = $result['municipio'];
                $comuna = $result['comuna'];

                $query = $this->dbConnection->prepare("UPDATE outdoor SET tipo = :outdoor, preco = :preco, provincia = :provincia,
                 municipio = :municipio, comuna = :comuna WHERE outdoor.idoutdoor = :id");

                $query->bindParam(':outdoor', $outdoor);
                $query->bindParam(':preco', $preco);
                $query->bindParam(':provincia', $provincia);
                $query->bindParam(':municipio', $municipio);
                $query->bindParam(':comuna', $comuna);
                $query->bindParam(':id', $id);
                if($query->execute()){
                    return true;
                }else{
                    return false;
                }
            }else{
                return 'falha';
            }
        }
        
        public function delete($codOutdoor){
            $query = $this->dbConnection->prepare("DELETE FROM outdoor WHERE outdoor.idoutdoor =:id");
            $query->bindParam(':id', $codOutdoor);
            if($query->execute()){
               return true;
            }else{
                return false;
            }
        }

        public function select() {
            $q = $this->dbConnection->prepare("SELECT * FROM outdoor");
            $q->execute();
            $result = $q->fetchAll();

            if($q->execute()){
                if($q->rowCount()>0){
                    $result = $q->fetchAll();
                    return $result;
                }else{
                   return '';
                }
            }else{
                return 'falha';
            }
        }

        public function allSolicitacao() {
            $q = $this->dbConnection->prepare("SELECT solicitacaoaluguel.*, outdoor.tipo FROM solicitacaoaluguel, outdoor
            WHERE outdoor.idoutdoor = solicitacaoaluguel.idoutdoor");
            if ($q->execute()) {
                if ($q->rowCount() > 0) {
                    $result = $q->fetchAll(PDO::FETCH_ASSOC);
                    return $result;
                } else {
                    return '';
                }
            } else {
                return 'falha';
            }
        }
        

        public function caminho($id){
            $query = $this->dbConnection->prepare("SELECT comprovativo.comprovativo FROM comprovativo 
            WHERE comprovativo.idaluguel=:id");
            $query->bindParam(':id',$id);
            if ($query->execute()) {
                if($query->rowCount()>0){
                    $result = $query->fetch();
                    return $result;
                }else{
                    return false;
                }
                
            }else{
                return false;
            }
        }

        public function aprovarSolicitacao($idaluguel){
            $estado ='Ocupado';
            try {
                $query = $this->dbConnection->prepare("SELECT solicitacaoaluguel.estado FROM solicitacaoaluguel
                WHERE solicitacaoaluguel.idaluguel = :id");
                $query->bindParam(':id', $idaluguel);
                if($query->execute()){
                    //caso true guardo o estado inicial da solicitacao 
                    $res = $query->fetch();
                    //continuou com o codigo
                    $query = $this->dbConnection->prepare("UPDATE solicitacaoaluguel SET estado = :estado WHERE solicitacaoaluguel.idaluguel = :id");
                    $query->bindParam(':id', $idaluguel);
                    $query->bindParam(':estado', $estado);
                    if($query->execute()){
                        $stmt = $this->dbConnection->prepare("SELECT solicitacaoaluguel.idoutdoor FROM solicitacaoaluguel
                        WHERE solicitacaoaluguel.idaluguel = :id");
                        $stmt->bindParam(':id', $idaluguel);
                        if($stmt->execute()){
                            $resp = $stmt->fetch();
                            $id = $resp['idoutdoor'];
                            
                            $q = $this->dbConnection->prepare("UPDATE outdoor SET estado = :estado WHERE outdoor.idoutdoor = :id");
                            $q->bindParam(':id', $id);
                            $q->bindParam(':estado', $estado);
                            if($q->execute()){
                                return true;
                            }else{
                                $state = $res['estado'];
                                $query = $this->dbConnection->prepare("UPDATE solicitacaoaluguel SET estado = :estado WHERE solicitacaoaluguel.idoutdoor = :id");
                                $query->bindParam(':id', $idaluguel);
                                $query->bindParam(':estado', $state);
                                if($query->execute()){
                                    return false;
                                }
                                return false;
                            }
                        }else{
                            return false;
                        }
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }
            } catch (PDOException $e) {
                echo "Erro de PDO: " . $e->getMessage();
            }
        }

        public function recusarSolicitacao($idaluguel){
            $estado = 'disponivel';
            try{
                $query = $this->dbConnection->prepare("SELECT solicitacaoaluguel.idoutdoor FROM solicitacaoaluguel
                WHERE solicitacaoaluguel.idaluguel = :id");
                $query->bindParam(':id', $idaluguel);
                if($query->execute()){
                    $resp = $query->fetch();
                    $id = $resp['idoutdoor'];

                    $query = $this->dbConnection->prepare("DELETE FROM solicitacaoaluguel WHERE solicitacaoaluguel.idaluguel = :id");
                    $query->bindParam(':id', $idaluguel);
                    if($query->execute()){
                        //utualizar o estado do outdoor
                        $q = $this->dbConnection->prepare("UPDATE outdoor SET estado = :estado WHERE outdoor.idoutdoor = :id");
                        $q->bindParam(':id', $id);
                        $q->bindParam(':estado', $estado);
                        if($q->execute()){
                            return true;
                        }else{
                            return false;
                        }
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }
            }catch (PDOException $e){
                echo "Erro de PDO: " . $e->getMessage();
            }











           
        }
    }
?>