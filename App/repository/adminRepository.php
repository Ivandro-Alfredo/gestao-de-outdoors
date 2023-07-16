<?php
    require_once '../config/dbconfig.php';
    require_once '../config/config.php';
    require_once '../repository/interface/IAdmin.php';
    require ('../Content/PHPMailer/PHPMailerAutoload.php');

    class AdminRepository implements IAdministrador{
        private $dbConnection;
        function __construct(){
            $this->dbConnection = DatabaseConnection::getInstance();
        }

        public function adicionar($gestor,$username,$email,$fone,$morada,$password,$criptoPassword,$provincia
        ,$municipio,$comuna ,$nacionalidade)
        {
            $categoria ='gestor';
            $estado ='ativo';
            $query = $this->dbConnection->prepare("SELECT * FROM gestor WHERE email = :email");
            $query->bindParam(':email', $email);
            $query->execute();
            
            if ($query->rowCount() > 0) {
                return "Usuario Ja Existe";
            }   

            $query = $this->dbConnection->prepare("SELECT provincia.provincia, municipio.municipio,comuna.comuna
            FROM provincia,municipio,comuna WHERE provincia.idprovincia = $provincia and municipio.idmunicipio=$municipio
            and comuna.idcomuna=$comuna");

            if ($query->execute()) {

                $result = $query->fetch();
                $provincia = $result['provincia'];
                $municipio = $result['municipio'];
                $comuna = $result['comuna'];

                $query = $this->dbConnection->prepare("INSERT INTO gestor (nome, username, email, telefone, morada,
                password, provincia, municipio, comuna, nacionalidade, categoria,estado) 
                VALUES (:nome, :username, :email, :fone, :morada, :password, :provincia, 
                :municipio, :comuna, :nacionalidade, :categoria,:estado)");
                $query->bindParam(':nome', $gestor);
                $query->bindParam(':username', $username);
                $query->bindParam(':email', $email);
                $query->bindParam(':fone', $fone);
                $query->bindParam(':morada', $morada);
                $query->bindParam(':password', $criptoPassword);
                $query->bindParam(':provincia', $provincia);
                $query->bindParam(':municipio', $municipio);
                $query->bindParam(':comuna', $comuna);
                $query->bindParam(':nacionalidade', $nacionalidade);
                $query->bindParam(':categoria', $categoria);
                $query->bindParam(':estado', $estado);

                if ($query->execute()) {

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
                    $enviarEmail->addAddress($email,$gestor);
                    $enviarEmail->isHTML(true);
                    $enviarEmail->Subject = "Bem-vindo a XPTO-SOLUTION";
                    $message = '<html>
                        <body>
                            <h2>Olá, ' . $gestor . '!</h2>
                            <p>Foste selecinado(a) como gestor(a) na XPTO-SOLUTIONS.</p>
                            <p>Estamos entusiasmados em tê-lo(a) como parte da nossa comunidade.</p>
                            <p>estes sao os teus dados de acesso.</p>
                            <p>Email: '.$email.'</p>
                            <p>Senha: '.$password.'</p>
                            <p>Seja bem-vindo(a)!</p>
                            <p>Atenciosamente,</p>
                            <p>A equipe da XPTO-SOLUTION</p>
                        </body>
                    </html>';
                    $enviarEmail->Body = $message;
                    if ($enviarEmail->send()) {
                        $query = $this->dbConnection->prepare("INSERT INTO login (nome, username, email,
                        password, categoria,estado) VALUES (:nome, :username, :email, :password, :categoria,:estado)");
                        $query->bindParam(':nome', $gestor);
                        $query->bindParam(':username', $username);
                        $query->bindParam(':email', $email);
                        $query->bindParam(':password', $criptoPassword);
                        $query->bindParam(':categoria', $categoria);
                        $query->bindParam(':estado', $estado);

                        if ($query->execute()){
                            return 'Registo Concluido.';
                        }else{
                            $query = $this->dbConnection->prepare("SELECT gestor.idgestor FROM gestor WHERE gestor.email = :email");
                            $query->bindParam(':email', $email);
                            if($query->execute()){
                                $result = $query->fetch();
                                $gestorId = $result['idgestor'];
                                $query = $this->dbConnection->prepare("DELETE FROM gestor WHERE gestor.idgestor = :gestorId");
                                $query->bindParam(':gestorId', $gestorId);
                                $query->execute();
                            }

                            $query = $this->dbConnection->prepare("SELECT login.idutilizador FROM login WHERE login.email = :email");
                            $query->bindParam(':email', $email);
                            if($query->execute()){
                                $result = $query->fetch();
                                $utilizadorId = $result['idutilizador'];
                                $query = $this->dbConnection->prepare("DELETE FROM login WHERE login.idutilizador = :Id");
                                $query->bindParam(':Id', $utilizadorId);
                                $query->execute();
                            }
                                return 'Falha ao registar o gestor';
                            }
                           
                    } else {
                        $query = $this->dbConnection->prepare("SELECT gestor.idgestor FROM gestor WHERE gestor.email = :email");
                        $query->bindParam(':email', $email);
                        if($query->execute()){
                            $result = $query->fetch();
                            $gestorId = $result['idgestor'];
                            $query = $this->dbConnection->prepare("DELETE FROM gestor WHERE gestor.idgestor = :gestorId");
                            $query->bindParam(':gestorId', $gestorId);
                            $query->execute();
                        }
                        return 'Problemas ao enviar email, '.$enviarEmail->ErrorInfo.', tente mais tarde';
                    }
                }else{
                    return 'Erro, ao registar o gestor, '.$gestor.'.';
                }
            } else {
                return 'Falha na requisao';
            }
        }
    }
?>