<?php
    require_once '../config/dbconfig.php';
    require_once '../Models/clienteModel.php';
    require_once '../Models/outdoorModel.php';
    require_once '../repository/interface/ICliente.php';

    class clienteRepository implements IClient{
        
        private $dbConnection;
        function __construct(){
            $this->dbConnection = DatabaseConnection::getInstance();
        }

        public function alterar($dados){
            if (isset($dados['idcliente'])) {
                $q = $this->dbConnection->prepare("SELECT * FROM cliente WHERE cliente.idcliente=:id");
                $q->bindParam(':id',$dados['idcliente']);
                if($q->execute()){
                    $result = $q->fetch(PDO::FETCH_ASSOC);
                    $newPassword = $dados['password'];
                    $senha = $result['password'];
                    $adress = $result['email'];
                    //verificando se o novo email ja existe
                    if($dados['email']!== $adress){
                        $q = $this->dbConnection->prepare("SELECT * FROM cliente WHERE cliente.email=:email");
                        $q->bindParam(':email',$dados['email']);
                        if($q->execute()){
                            if($q->rowCount()>0){
                                return "Ja existe";
                            }
                        }else{
                            return ;
                        }
                    }
                    
                    if (password_verify( $newPassword, $senha)) {
                        $query = $this->dbConnection->prepare("UPDATE cliente SET nome = :nome_completo, username = :username, email = :email,
                        phone = :telefone, morada = :morada, provincia = :provincia, municipio = :municipio, comuna = :comuna WHERE cliente.idcliente = :id");
                        $query->bindParam(':nome_completo', $dados['nome']);
                        $query->bindParam(':username', $dados['username']);
                        $query->bindParam(':email', $dados['email']);
                        $query->bindParam(':telefone', $dados['fone']);
                        $query->bindParam(':morada',$dados['morada']);
                        $query->bindParam(':provincia', $dados['provincia']);
                        $query->bindParam(':municipio',$dados['municipio']);
                        $query->bindParam(':comuna', $dados['comuna']); 
                        $query->bindParam(':id',$dados['idcliente']);
                        if($query->execute()){
                            $query = $this->dbConnection->prepare("UPDATE login SET nome = :nome, username = :username, email = :email WHERE login.email = :adress");
                            $query->bindParam(':nome', $dados['nome']);
                            $query->bindParam(':username', $dados['username']);
                            $query->bindParam(':email', $dados['email']);
                            $query->bindParam(':adress', $adress);
                            if($query->execute()){
                                return true;
                            }else{
                                $query = $this->dbConnection->prepare("UPDATE cliente SET nome = :nome_completo, username = :username, email = :email,
                                phone = :telefone, morada = :morada, provincia = :provincia, municipio = :municipio, comuna = :comuna WHERE cliente.idcliente = :id");
                                $query->bindParam(':nome_completo', $result['nome']);
                                $query->bindParam(':username', $result['username']);
                                $query->bindParam(':email', $result['email']);
                                $query->bindParam(':telefone', $result['fone']);
                                $query->bindParam(':morada',$result['morada']);
                                $query->bindParam(':provincia', $result['provincia']);
                                $query->bindParam(':municipio',$result['municipio']);
                                $query->bindParam(':comuna', $result['comuna']); 
                                $query->bindParam(':id',$result['idcliente']);
                                if($query->execute()){
                                    return false;
                                }else{
                                    return false;
                                }
                            }
                            
                        }else{
                            return false;
                        }
                    } else {
                        $criptoPassword = password_hash($newPassword , PASSWORD_DEFAULT);
                        $query = $this->dbConnection->prepare("UPDATE cliente SET nome = :nome_completo, username = :username, email = :email, 
                        phone = :telefone, morada = :morada,password=:password, provincia = :provincia, municipio = :municipio, comuna = :comuna 
                        WHERE cliente.idcliente = :id");
                        $query->bindParam(':nome_completo', $dados['nome']);
                        $query->bindParam(':username', $dados['username']);
                        $query->bindParam(':email', $dados['email']);
                        $query->bindParam(':telefone', $dados['fone']);
                        $query->bindParam(':morada',$dados['morada']);
                        $query->bindParam(':password', $criptoPassword); 
                        $query->bindParam(':provincia', $dados['provincia']);
                        $query->bindParam(':municipio',$dados['municipio']);
                        $query->bindParam(':comuna', $dados['comuna']); 
                        $query->bindParam(':id',$dados['idcliente']); 
                        if($query->execute()){
                            $query = 
                            $this->dbConnection->prepare("UPDATE login SET nome = :nome, username = :username, email = :email, password = :password
                            WHERE login.email = :adress");
                            $query->bindParam(':nome', $dados['nome']);
                            $query->bindParam(':username', $dados['username']);
                            $query->bindParam(':email', $dados['email']);
                            $query->bindParam(':password', $criptoPassword);
                            $query->bindParam(':adress', $adress);
                            if($query->execute()){
                                return true;
                            }else{
                                $query = $this->dbConnection->prepare("UPDATE cliente SET nome = :nome, username = :username, email = :email, 
                                phone = :telefone, morada = :morada, password = :password, provincia = :provincia, municipio = :municipio, 
                                comuna = :comuna WHERE cliente.idcliente = :id");
                                $query->bindParam(':nome', $result['nome']);
                                $query->bindParam(':username', $result['username']);
                                $query->bindParam(':email', $result['email']);
                                $query->bindParam(':telefone', $result['fone']);
                                $query->bindParam(':morada', $result['morada']);
                                $query->bindParam(':provincia', $result['provincia']);
                                $query->bindParam(':municipio', $result['municipio']);
                                $query->bindParam(':comuna', $result['comuna']); 
                                $query->bindParam(':password', $result['password']);
                                $query->bindParam(':id', $result['idcliente']);
                                if($query->execute()){
                                    return false;
                                }else{
                                    return false;
                                }
                            }
                        }else{
                            return false;
                        }
                    }
                } 
            }
        }

        public function inserir() {}

        public function select($email) {
            $q = $this->dbConnection->prepare("SELECT * FROM cliente WHERE email=:email");
            $q->bindParam(':email',$email);
            $q->execute();
            if($q->rowCount()>0){
                $result = $q->fetch();
                return  $result;
            }
        }

        public function selectPreco($tipo) {
            $id = $tipo['outdoor'];
            $provincia = $tipo['provincia'];
            $municipio = $tipo['municipio'];
            $comuna = $tipo['comuna'];

            $query = $this->dbConnection->prepare("SELECT provincia.provincia, municipio.municipio,comuna.comuna
            FROM provincia,municipio,comuna WHERE provincia.idprovincia = $provincia and municipio.idmunicipio=$municipio
            and comuna.idcomuna=$comuna");
            $query->execute();
            
            if ($query->rowCount() > 0) {
                $result = $query->fetch();
                $provincia = $result['provincia'];
                $municipio = $result['municipio'];
                $comuna = $result['comuna'];
                
                $query = $this->dbConnection->prepare("SELECT outdoor.preco FROM outdoor 
                WHERE idoutdoor=:tipo and provincia=:provincia and municipio=:municipio and comuna=:comuna");
                $query->bindParam(':tipo', $id);
                $query->bindParam(':provincia', $provincia);
                $query->bindParam(':municipio', $municipio);
                $query->bindParam(':comuna', $comuna);
                $query->execute();

                if($query->rowCount()>0){
                    $result = $query->fetch();
                    return $result;
                }else{
                    return false;
                }
            }             
        }

        public function insertAluguelSemImagem($email,$id, $quantidade, $total, $provincia, $municipio, $comuna, $dataInicio, $dataFim)
        {
            $states ='Aguardar pagamento';
            $imagem = 'Sem Imagem';

            $query = $this->dbConnection->prepare("SELECT cliente.idcliente FROM cliente WHERE cliente.email = :email");
            $query->bindParam(':email', $email);
            if($query->execute()){
                $resp = $query->fetch(PDO::FETCH_ASSOC);
                $idcliente = $resp['idcliente'];
                try {
                    $query = $this->dbConnection->prepare("SELECT provincia.provincia, municipio.municipio,comuna.comuna
                    FROM provincia,municipio,comuna WHERE provincia.idprovincia = $provincia and municipio.idmunicipio=$municipio
                    and comuna.idcomuna=$comuna");
                    $query->execute();

                    if ($query->rowCount() > 0) {
                        $result = $query->fetch();
                        $provincia = $result['provincia'];
                        $municipio = $result['municipio'];
                        $comuna = $result['comuna'];

                        $query = $this->dbConnection->prepare("INSERT INTO solicitacaoaluguel (idcliente, idoutdoor, quantidade, total, provincia, municipio, comuna, dataInicio, dataFim,imagem, estado) 
                        VALUES (:idcliente, :idoutdoor, :quantidade, :total, :provincia, :municipio, :comuna, :dataInicio, :dataFim, :imagem, :estado)");
                        $query->bindParam(':idcliente', $idcliente);
                        $query->bindParam(':idoutdoor', $id);
                        $query->bindParam(':quantidade', $quantidade);
                        $query->bindParam(':total', $total);
                        $query->bindParam(':provincia', $provincia);
                        $query->bindParam(':municipio', $municipio);
                        $query->bindParam(':comuna', $comuna);
                        $query->bindParam(':dataInicio', $dataInicio);
                        $query->bindParam(':dataFim', $dataFim);
                        $query->bindParam(':imagem', $imagem);
                        $query->bindParam(':estado', $states);
                        if($query->execute()){
                            $q = $this->dbConnection->prepare("UPDATE outdoor SET estado = :estado WHERE idoutdoor = :idoutdoor");
                            $q->bindParam(':estado', $states);
                            $q->bindParam(':idoutdoor', $id);
                            
                            if($q->execute()){
                                return true;
                            }else{
                                $q->$this->dbConnection->prepare("DELETE FROM solicticaoaluguel WHERE idcliente=:idcliente AND idoutdoor=:id");
                                $q->bindParam(':idoutdoor', $id);
                                $q->bindParam(':idcliente', $idcliente);
                                $query->execute();
                                return false;
                            }
                        }
                    }
                } catch (PDOException $e) {
                    echo "Ocorreu um erro: ".$e->getMessage()." A requisicao falhou";
                }
            }
            
        }

        public function insertAluguelComImagem($email,$id, $quantidade, $total, $provincia, $municipio, $comuna, $dataInicio, $dataFim,$imagem)
        {
            $states ='A aguardar pagamento';
            $query = $this->dbConnection->prepare("SELECT cliente.idcliente FROM cliente WHERE cliente.email = :email");
            $query->bindParam(':email', $email);
            if($query->execute()){
                $resp = $query->fetch(PDO::FETCH_ASSOC);
                $idcliente = $resp['idcliente'];
                try {
                    $query = $this->dbConnection->prepare("SELECT provincia.provincia, municipio.municipio,comuna.comuna
                    FROM provincia,municipio,comuna WHERE provincia.idprovincia = $provincia and municipio.idmunicipio=$municipio
                    and comuna.idcomuna=$comuna");
                    $query->execute();

                    if ($query->rowCount() > 0) {
                        $result = $query->fetch();
                        $provincia = $result['provincia'];
                        $municipio = $result['municipio'];
                        $comuna = $result['comuna'];

                        $query = $this->dbConnection->prepare("INSERT INTO solicitacaoaluguel (idcliente, idoutdoor, quantidade, total, provincia, municipio, comuna, dataInicio, dataFim,imagem, estado) 
                        VALUES (:idcliente, :idoutdoor, :quantidade, :total, :provincia, :municipio, :comuna, :dataInicio, :dataFim, :imagem, :estado)");
                        $query->bindParam(':idcliente', $idcliente);
                        $query->bindParam(':idoutdoor', $id);
                        $query->bindParam(':quantidade', $quantidade);
                        $query->bindParam(':total', $total);
                        $query->bindParam(':provincia', $provincia);
                        $query->bindParam(':municipio', $municipio);
                        $query->bindParam(':comuna', $comuna);
                        $query->bindParam(':dataInicio', $dataInicio);
                        $query->bindParam(':dataFim', $dataFim);
                        $query->bindParam(':imagem', $imagem);
                        $query->bindParam(':estado', $states);
                        if($query->execute()){
                            $q = $this->dbConnection->prepare("UPDATE outdoor SET estado = :estado WHERE idoutdoor = :idoutdoor");
                            $q->bindParam(':estado', $states);
                            $q->bindParam(':idoutdoor', $id);
                            
                            if($q->execute()){
                                return true;
                            }else{
                                $q->$this->dbConnection->prepare("DELETE FROM solicticaoaluguel WHERE idcliente=:idcliente AND idoutdoor=:id");
                                $q->bindParam(':idoutdoor', $id);
                                $q->bindParam(':idcliente', $idcliente);
                                $query->execute();
                                return false;
                            }
                        }
                    }
                } catch (PDOException $e) {
                    return "Ocorreu um erro: ".$e->getMessage()." A requisicao falhou";
                }
            }
            
            
        }

        public function inserirComprovativo($idaluguel,$data,$arquivo) {
            $estado = 'Por Validar Pagamento';
           
            try {
               
                $query = $this->dbConnection->prepare("INSERT INTO comprovativo (idaluguel, data, comprovativo) VALUES(:idaluguel, :data, :path)");
                $query->bindParam(':idaluguel', $idaluguel);
                $query->bindParam(':path', $arquivo);  
                $query->bindParam(':data', $data);         
                if ($query->execute()) {
                    $q = $this->dbConnection->prepare("SELECT * FROM solicitacaoaluguel WHERE idaluguel = :id");
                    $q->bindParam(':id', $idaluguel);
                    
                    if ($q->execute()) {
                        if ($q->rowCount() > 0) {
                            $result = $q->fetch();
        
                            $query = $this->dbConnection->prepare("UPDATE solicitacaoaluguel SET estado = :estado WHERE idaluguel = :id");
                            $query->bindParam(':estado', $estado);
                            $query->bindParam(':id', $idaluguel);
        
                            if ($query->execute()) {
                                $id = $result['idoutdoor'];
                                $q = $this->dbConnection->prepare("UPDATE outdoor SET estado = :estado WHERE idoutdoor = :idoutdoor");
                                $q->bindParam(':estado', $estado);
                                $q->bindParam(':idoutdoor', $id);
        
                                if ($q->execute()) {
                                    return true;
                                } else {
                                    $q = $this->dbConnection->prepare("UPDATE solicitacaoaluguel SET idcliente = :idcliente, idoutdoor = :idoutdoor, quantidade = :quantidade, total = :total, provincia = :provincia, municipio = :municipio, comuna = :comuna, dataInicio = :dataInicio, dataFim = :dataFim, imagem = :imagem, estado = :estado WHERE idaluguel = :id");
                                    $q->bindParam(':idcliente', $result['idcliente']);
                                    $q->bindParam(':idoutdoor', $result['idoutdoor']);
                                    $q->bindParam(':quantidade', $result['quantidade']);
                                    $q->bindParam(':total', $result['total']);
                                    $q->bindParam(':provincia', $result['provincia']);
                                    $q->bindParam(':municipio', $result['municipio']);
                                    $q->bindParam(':comuna', $result['comuna']);
                                    $q->bindParam(':dataInicio', $result['dataInicio']);
                                    $q->bindParam(':dataFim', $result['dataFim']);
                                    $q->bindParam(':imagem', $result['imagem']);
                                    $q->bindParam(':estado', $estado);
                                    $q->bindParam(':id', $idaluguel);
        
                                    if ($q->execute()) {
                                        $query = $this->dbConnection->prepare("DELETE FROM comprovativo WHERE idcomprovativo = :id");
                                        $query->bindParam(':id', $idaluguel);
                                        $query->execute();
                                    }
                                }
                            }
                        }
                    }
                }
        
                return false;
            } catch (Exception $th) {
                return 'Requisicao falhou';
            }
        }
        
        public function selectMyAluguel($email){
            try {
                $query = $this->dbConnection->prepare("SELECT cliente.idcliente FROM cliente WHERE email = :email ");
                $query->bindParam(':email', $email);
                if($query->execute()){
                    $result = $query->fetch();
                    $id = $result['idcliente']; 
                    $query = $this->dbConnection->prepare("SELECT cliente.nome, outdoor.tipo, solicitacaoaluguel.* FROM cliente,outdoor,solicitacaoaluguel 
                    WHERE solicitacaoaluguel.idcliente = :id and solicitacaoaluguel.idoutdoor = outdoor.idoutdoor");
                    $query->bindParam(':id', $id);
                    
                    if($query->execute()) {
                        if ($query->rowCount() > 0) {
                            $result = $query->fetchAll();
                            return  $result ;
                        }
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }

            } catch (Exception $th) {
                echo "Error, ".$th->getMessage(). " Requisicao Falhou";
            }
        }

        public function clienteExiste($email){
            $q = $this->dbConnection->prepare("SELECT cliente.estado FROM cliente WHERE email=:email");
            $q->bindParam(':email',$email);
            $q->execute();
            if($q->rowCount()>0){
                $result = $q->fetch();
                $estado = $result['estado'];
                return $estado;
            }
            return 'Nenhum registro encontrado';
        }

        public function selectAllOutdoor(){
            $query = $this->dbConnection->prepare("SELECT outdoor.idoutdoor, outdoor.tipo FROM outdoor");
            if($query->execute()){
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }else{
                return "Nenhum resultado encontrado.";
            }
        }

        public function selectAllSolitacoes($email){
            try {
                $query = $this->dbConnection->prepare("SELECT cliente.idcliente FROM cliente WHERE email = :email ");
                $query->bindParam(':email', $email);
                if($query->execute()){
                    $result = $query->fetch();
                    $id = $result['idcliente']; 
                    $query = $this->dbConnection->prepare("SELECT cliente.nome, outdoor.tipo, solicitacaoaluguel.* FROM cliente,outdoor,solicitacaoaluguel 
                    WHERE solicitacaoaluguel.idcliente = :id and solicitacaoaluguel.idoutdoor = outdoor.idoutdoor");
                    $query->bindParam(':id', $id);
                    
                    if($query->execute()) {
                        if ($query->rowCount() > 0) {
                            $result = $query->fetchAll();
                            return  $result ;
                        }
                    }else{
                        return "Nenhum Resultado Encontrado";
                    }
                }else{
                    return "Nenhum Resultado Encontrado";
                }

            } catch (Exception $th) {
                echo "Error, ".$th->getMessage(). " Requisicao Falhou";
            }
        }
    }
?>