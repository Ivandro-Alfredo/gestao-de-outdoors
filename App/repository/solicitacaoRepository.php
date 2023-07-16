<?php
    require_once '../config/dbconfig.php' ;
    require_once '../config/config.php';
    require_once '../repository/interface/ISolicitacao.php';
    require_once '../Models/solicitacaoModel.php';
    require ('../Content/PHPMailer/PHPMailerAutoload.php');
    
    class SolicitacaoRepository implements ISolicitacao{
        private $dbConnection;
        function __construct(){
            $this->dbConnection = DatabaseConnection::getInstance();
        }

        public function inserirClienteEmpresa($nome, $username, $email, $fone, $morada, $password, $provincia, $municipio, 
         $comuna, $nacionalidade, $clienteEmpresa, $atividadeEmpresa)
         {
            $categoria ='cliente';
            $estado = 'Pendente';
            $admin ='';
            
            $query = $this->dbConnection->prepare("SELECT * FROM cliente WHERE email = :email");
            $query->bindParam(':email', $email);
            $query->execute();

            if ($query->rowCount() > 0) {
                return false;
            }  
           
            $query = $this->dbConnection->prepare("SELECT provincia.provincia, municipio.municipio,comuna.comuna
            FROM provincia,municipio,comuna WHERE provincia.idprovincia = $provincia and municipio.idmunicipio=$municipio
            and comuna.idcomuna=$comuna");
            $query->execute();

            if ($query->rowCount() > 0) {
                $result = $query->fetch();
                $provincia = $result['provincia'];
                $municipio = $result['municipio'];
                $comuna = $result['comuna'];

                $query = $this->dbConnection->prepare("INSERT INTO cliente (nome,username,email,tipoCliente,atividade,phone
                ,morada,password, provincia, municipio, comuna, nacionalidade, categoria,estado) 
                VALUES (:nome, :username, :email, :cliente, :atividade,:fone, :morada, :password, :provincia, 
                :municipio, :comuna, :nacionalidade, :categoria, :estado)");
                $query->bindParam(':nome', $nome);
                $query->bindParam(':username', $username);
                $query->bindParam(':email', $email);
                $query->bindParam(':fone', $fone);
                $query->bindParam(':morada', $morada);
                $query->bindParam(':password', $password);
                $query->bindParam(':provincia', $provincia);
                $query->bindParam(':municipio', $municipio);
                $query->bindParam(':comuna', $comuna);
                $query->bindParam(':nacionalidade', $nacionalidade);
                $query->bindParam(':cliente', $clienteEmpresa);
                #variaveis criadas por mm, com o intuito de diferenciar os user, e outra para 
                $query->bindParam(':categoria', $categoria);
                $query->bindParam(':estado', $estado);
                $query->bindParam(':atividade',$atividadeEmpresa);

                if ($query->execute()) {
                    
                    $query = $this->dbConnection->prepare("SELECT login.categoria, login.email FROM login");
                    if($query->execute()){
                        $result = $query->fetchAll(PDO::FETCH_ASSOC);
                        global $admin;

                        foreach($result as $estado){
                            if(strtolower($estado['categoria']) ==='administrador'){
                                $admin = $estado['email'];
                                
                                $enviarEmail = new PHPMailer();
                                $enviarEmail->isSMTP();
                                $enviarEmail->Host = 'smtp.gmail.com';
                                $enviarEmail->SMTPDebug  = 0; 
                                $enviarEmail->SMTPAuth = true;
                                $enviarEmail->Username = username;
                                $enviarEmail->Password = password;
                                $enviarEmail->SMTPSecure = 'tls';
                                $enviarEmail->Port = '587';
                                $enviarEmail->setFrom(username,'XPTO-SOLUCTION');
                                $enviarEmail->addAddress($admin);
                                $enviarEmail->isHTML(true);
                                $enviarEmail->Subject = "Registo de novo cliente";
                                $message = '<html>
                                                <body>
                                                    <h2>Olá, Sr. Admin!</h2> 
                                                    <p>Foi efetuado o registo de um novo cliente na  </p>
                                                    <p>plataforma de gestao de outdoors, da XPTO-SOLUTION</p>
                                                    <p>O registo foi concluído com sucesso.</p>
                                                    <p>Atenciosamente,</p>
                                                    <p>A equipe da XPTO-SOLUTION</p>
                                                </body>
                                            </html>';
                                $enviarEmail->Body = $message;
                                if ($enviarEmail->send()) {
                                    return true;
                                } else {
                                    $query = $this->dbConnection->prepare("SELECT cliente.email, cliente.idcliente FROM cliente WHERE email = :email");
                                    $query->bindParam(':email', $email);
                                    if($query->execute()){
                                        $result = $query->fetch();
                                        $id = $result['idcliente'];
                                        $query = $this->dbConnection->prepare("DELETE FROM cliente WHERE cliente.idcliente = :id");
                                        $query->bindParam(':id', $id);
                                        $query->execute();
                                    }
                                    
                                    return 'Falha';
                                }
                            }
                        }
                         //verificacao extra...
                        if($admin!==''){
                        }else{
                            $query = $this->dbConnection->prepare("SELECT cliente.email, cliente.idcliente FROM cliente WHERE email = :email");
                            $query->bindParam(':email', $email);
                            if($query->execute()){
                                $result = $query->fetch();
                                $id = $result['idcliente'];
                                $query = $this->dbConnection->prepare("DELETE FROM cliente WHERE cliente.idcliente = :id");
                                $query->bindParam(':id', $id);
                                $query->execute();
                            }
                            return 'Falha'; 
                        }
                    }else{
                        $query = $this->dbConnection->prepare("SELECT cliente.email, cliente.idcliente FROM cliente WHERE email = :email");
                        $query->bindParam(':email', $email);
                        if($query->execute()){
                            $result = $query->fetch();
                            $id = $result['idcliente'];
                            $query = $this->dbConnection->prepare("DELETE FROM cliente WHERE cliente.idcliente = :id");
                            $query->bindParam(':id', $id);
                            $query->execute();
                        }
                    return 'Falha';  
                    }    
                } else {
                    return 'Falha';
                }
            }
        }

        #armazenar na tabela empresa
        public function inserirClienteParticular($nome, $username, $email, $fone, $morada, $password, $provincia, $municipio, 
        $comuna, $nacionalidade, $clienteParticular)
        {
            #defino minha categoria
            $categoria ='cliente';
            $estado = 'Pendente';
            $atividade = 'Nao especificado';
            $admin='';

            $query = $this->dbConnection->prepare("SELECT * FROM cliente WHERE email = :email");
            $query->bindParam(':email', $email);
            $query->execute();

            if ($query->rowCount() > 0) {
                return false;
            }  

            $query = $this->dbConnection->prepare("SELECT provincia.provincia, municipio.municipio,comuna.comuna
            FROM provincia,municipio,comuna WHERE provincia.idprovincia = $provincia and municipio.idmunicipio=$municipio
            and comuna.idcomuna=$comuna");
            $query->execute();

            if ($query->rowCount() > 0) {
                $result = $query->fetch();
                $provincia = $result['provincia'];
                $municipio = $result['municipio'];
                $comuna = $result['comuna'];

                $query = $this->dbConnection->prepare("INSERT INTO cliente (nome,username,email,tipoCliente,atividade,phone
                ,morada,password, provincia, municipio, comuna, nacionalidade, categoria,estado) 
                VALUES (:nome, :username, :email, :cliente, :atividade,:fone, :morada, :password, :provincia, 
                :municipio, :comuna, :nacionalidade, :categoria, :estado)");
                $query->bindParam(':nome', $nome);
                $query->bindParam(':username', $username);
                $query->bindParam(':email', $email);
                $query->bindParam(':fone', $fone);
                $query->bindParam(':morada', $morada);
                $query->bindParam(':password', $password);
                $query->bindParam(':provincia', $provincia);
                $query->bindParam(':municipio', $municipio);
                $query->bindParam(':comuna', $comuna);
                $query->bindParam(':nacionalidade', $nacionalidade);
                $query->bindParam(':cliente', $clienteParticular);
                #variaveis criadas por mm, com o intuito de diferenciar os user, e outra para 
                $query->bindParam(':categoria', $categoria);
                $query->bindParam(':estado', $estado);
                $query->bindParam(':atividade',$atividade);

                if ($query->execute()) {
                     
                    $query = $this->dbConnection->prepare("SELECT login.categoria, login.email FROM login");
                    if($query->execute()){
                        $result = $query->fetchAll(PDO::FETCH_ASSOC);
                        global $admin;
                        foreach($result as $estado){
                            if(strtolower($estado['categoria']) ==='administrador'){
                                $admin = $estado['email'];

                                $enviarEmail = new PHPMailer();
                                $enviarEmail->isSMTP();
                                $enviarEmail->Host = 'smtp.gmail.com';
                                $enviarEmail->SMTPDebug  = 0; 
                                $enviarEmail->SMTPAuth = true;
                                $enviarEmail->Username = username;
                                $enviarEmail->Password = password;
                                $enviarEmail->SMTPSecure = 'tls';
                                $enviarEmail->Port = '587';
                                $enviarEmail->setFrom(username,'XPTO-SOLUCTION');
                                $enviarEmail->addAddress($admin);
                                $enviarEmail->isHTML(true);
                                $enviarEmail->Subject = "Registo de novo cliente";
                                $message = '<html>
                                                <body>
                                                    <h2>Olá, Sr. Admin!</h2> 
                                                    <p>Foi efetuado o registo de um novo cliente na  </p>
                                                    <p>plataforma de gestao de outdoors, da XPTO-SOLUTION</p>
                                                    <p>O eegisto foi concluído com sucesso.</p>
                                                    <p>Atenciosamente,</p>
                                                    <p>A equipe da XPTO-SOLUTION</p>
                                                </body>
                                            </html>';
                                $enviarEmail->Body = $message;
                                if ($enviarEmail->send()) {
                                    return true;
                                } else {
                                    $query = $this->dbConnection->prepare("SELECT cliente.email, cliente.idcliente FROM cliente WHERE email = :email");
                                    $query->bindParam(':email', $email);
                                    if($query->execute()){
                                        $result = $query->fetch();
                                        $id = $result['idcliente'];
                                        $query = $this->dbConnection->prepare("DELETE FROM cliente WHERE cliente.idcliente = :id");
                                        $query->bindParam(':id', $id);
                                        $query->execute();
                                    }
                                    return 'Falha';
                                }
                            }
                        }
                        //verificacao extra...
                        if($admin!==''){
                        }else{
                            $query = $this->dbConnection->prepare("SELECT cliente.email, cliente.idcliente FROM cliente WHERE email = :email");
                            $query->bindParam(':email', $email);
                            if($query->execute()){
                                $result = $query->fetch();
                                $id = $result['idcliente'];
                                $query = $this->dbConnection->prepare("DELETE FROM cliente WHERE cliente.idcliente = :id");
                                $query->bindParam(':id', $id);
                                $query->execute();
                            }
                            return 'Falha'; 
                        }
                    }else{
                        $query = $this->dbConnection->prepare("SELECT cliente.email, cliente.idcliente FROM cliente WHERE email = :email");
                        $query->bindParam(':email', $email);
                        if($query->execute()){
                            $result = $query->fetch();
                            $id = $result['idcliente'];
                            $query = $this->dbConnection->prepare("DELETE FROM cliente WHERE cliente.idcliente = :id");
                            $query->bindParam(':id', $id);
                            $query->execute();
                        }
                        return 'Falha';  
                    }    
                } else {
                    return 'Falha';
                }
            } 
        }

    }

?>