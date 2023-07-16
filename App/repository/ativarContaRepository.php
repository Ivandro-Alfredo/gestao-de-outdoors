<?php
require_once '../config/dbconfig.php';
require_once '../config/config.php';
require_once '../repository/interface/IConta.php';
require_once '../Models/ativarContaModel.php';
require ('../Content/PHPMailer/PHPMailerAutoload.php');

class ContaRepository  implements IConta {
    private $dbConnection;

    function __construct(){
        $this->dbConnection = DatabaseConnection::getInstance();
    }

    public function getAllConta() {
        $categoria = 'cliente';
        $query = $this->dbConnection->prepare("SELECT * FROM cliente WHERE categoria = :categoria");
        $query->bindParam(':categoria', $categoria);
        $query->execute();
        
        if ($query->rowCount() > 0) {
            $result = $query->fetchAll();
            foreach ($result as $conta) {
                $contas []= new AtivarContaModel($conta['nome'], $conta['username'], $conta['email'],$conta['tipoCliente']
                ,$conta['atividade'],$conta['phone'],$conta['morada'], $conta['provincia'], $conta['municipio'],
                $conta['comuna'], $conta['nacionalidade'], $conta['categoria'], $conta['estado']);
            }
            return  $contas;
        } else {
            return "Nenhum resultado encontrado";
        }
    }

    public function update($contas){
        if (isset($contas['email'])) {
            $query = $this->dbConnection->prepare("UPDATE cliente SET nome = :nome, username = :username, 
            email = :email, phone = :telefone, morada = :morada, provincia = :provincia, municipio = :municipio, 
            comuna = :comuna, nacionalidade = :nacionalidade, categoria = :categoria, estado = :estado WHERE email = :email");
            $query->bindParam(':nome', $contas['nome']);
            $query->bindParam(':username', $contas['username']);
            $query->bindParam(':email', $contas['email']);
            $query->bindParam(':telefone', $contas['telefone']);
            $query->bindParam(':morada', $contas['morada']);
            $query->bindParam(':provincia', $contas['provincia']);
            $query->bindParam(':municipio', $contas['municipio']);
            $query->bindParam(':comuna', $contas['comuna']);
            $query->bindParam(':nacionalidade', $contas['nacionalidade']);
            $query->bindParam(':categoria', $contas['categoria']);
            $query->bindParam(':estado', $contas['estado']);
    
            if ($query->execute() && $contas['estado']==='ativo') {

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
                $enviarEmail->addAddress($contas['email'],$contas['nome']);
                $enviarEmail->isHTML(true);
                $enviarEmail->Subject = "Bem-vindo a XPTO-SOLUTION";
                $message = '<html>
                <body>
                    <h2>Olá, ' . $contas['nome'] . '!</h2>
                    <p>Agradecemos por se registar na XPTO-SOLUTIONs.</p>
                    <p>Estamos entusiasmados em tê-lo(a) como parte da nossa comunidade.</p>
                    <p>Sua conta foi ativada com sucesso.</p>
                    <p>Seja bem-vindo(a)!</p>
                    <p>Atenciosamente</p>
                    <p>A equipe da XPTO-SOLUTION</p>
                </body>
                </html>';
                $enviarEmail->Body = $message;

                if ($enviarEmail->send()) {

                    $query = $this->dbConnection->prepare("SELECT cliente.password FROM cliente WHERE cliente.email = :email");
                    $query->bindParam(':email', $contas['email']);
                    $query->execute();

                    if ($query->rowCount() > 0){
                        $result = $query->fetch();
                        $pass = $result['password'];
                        try {
                            $query = $this->dbConnection->prepare("INSERT INTO login (nome, username, email,
                            password, categoria,estado) VALUES (:nome, :username, :email, :password, :categoria,:estado)");
                            $query->bindParam(':nome', $contas['nome']);
                            $query->bindParam(':username',$contas['username']);
                            $query->bindParam(':email',$contas['email']);
                            $query->bindParam(':password', $pass);
                            $query->bindParam(':categoria',$contas['categoria']);
                            $query->bindParam(':estado',$contas['estado']);
                            if ($query->execute()){
                                return 'Conta ativada.';
                            }else{
                                $query = $this->dbConnection->prepare("SELECT cliente.idcliente FROM cliente WHERE cliente.email = :email");
                                $query->bindParam(':email', $contas['email']);
                                if($query->execute()){
                                    $result = $query->fetch();
                                    $Id = $result['idcliente'];
                                    $estado ='pendente';
        
                                    $query = $this->dbConnection->prepare("UPDATE cliente SET estado = :estado WHERE idcliente = :id");
                                    $query->bindParam(':id', $Id);
                                    $query->bindParam(':estado',$estado);
                                    $query->execute();
        
                                    $query = $this->dbConnection->prepare("SELECT login.idutilizador FROM login WHERE login.email = :email");
                                    $query->bindParam(':email',$contas['email']);
                                    if($query->execute()){
                                        $result = $query->fetch();
                                        $utilizadorId = $result['idutilizador'];
                                        $query = $this->dbConnection->prepare("DELETE FROM login WHERE login.idutilizador = :Id");
                                        $query->bindParam(':Id', $utilizadorId);
                                        $query->execute();
                                    }
                                    return 'Falha ao ativar a conta';
                                }
                            }
                        } catch (Exception $th) {
                           return 'Falha ao ativar a conta';
                        }
                    
                    }else{
                        return 'Requisicao Falhou';
                    }
                } else {
                    $query = $this->dbConnection->prepare("SELECT cliente.idcliente FROM cliente WHERE cliente.email = :email");
                    $query->bindParam(':email', $contas['email']);
                    if($query->execute()){
                        $result = $query->fetch();
                        $Id = $result['idcliente'];
                        $estado ='pendente';

                        $query = $this->dbConnection->prepare("UPDATE cliente SET estado = :estado WHERE idcliente = :id");
                        $query->bindParam(':id', $Id);
                        $query->bindParam(':estado',$estado);
                        $query->execute();
                    }
                    return 'Problemas ao enviar email, '.$enviarEmail->ErrorInfo.', tente mais tarde';
                }
            }else{
                try {
                    $query = $this->dbConnection->prepare("SELECT login.idutilizador FROM login WHERE login.email = :email");
                    $query->bindParam(':email',$contas['email']);
                    $query->execute();

                    if($query->rowCount() > 0){
                        $result = $query->fetch();
                        $utilizadorId = $result['idutilizador'];
                        $query = $this->dbConnection->prepare("DELETE FROM login WHERE login.idutilizador = :Id");
                        $query->bindParam(':Id', $utilizadorId);
                        $query->execute();
                    }
                } catch (Exception $th) {
                    return 'Falha ao atualizar a conta';
                }
                return 'Atualização Pendente/Desativada';
            }
            return 'Erro, ao atualizar a conta do cliente, '.$contas['nome'].'.';
        }else{
            return 'Algo correu mal';
        }
    }
}
