<?php

class TokenServer {
    private $totalTokens;
    private $availableTokens;
    private $dbConnection;

    public function __construct($totalTokens) {
        $this->totalTokens = $totalTokens;
        $this->availableTokens = $totalTokens;

        // Estabelecer conexão com o banco de dados
        $this->dbConnection = new mysqli("localhost", "root", "", "bd3_redes"); // Atualize as informações de conexão com o banco de dados
        if ($this->dbConnection->connect_error) {
            die("Falha na conexão com o banco de dados: " . $this->dbConnection->connect_error);
        }
    }

    public function getTotalTokens() {
        return $this->totalTokens;
    }

    public function getAvailableTokens() {
        // Recuperar a quantidade de tokens disponíveis do banco de dados
        $query = "SELECT available_tokens FROM tokens";
        $result = $this->dbConnection->query($query);
        if ($result) {
            $row = $result->fetch_assoc();
            $this->availableTokens = $row['available_tokens'];
        } else {
            die("Erro ao recuperar a quantidade de tokens disponíveis do banco de dados: " . $this->dbConnection->error);
        }
        return $this->availableTokens;
    }

    public function provideToken() {
        if ($this->availableTokens > 0) {
            // Decrementar a quantidade de tokens disponíveis no banco de dados
            $query = "UPDATE tokens SET available_tokens = available_tokens - 1";
            $result = $this->dbConnection->query($query);
            if (!$result) {
                die("Erro ao fornecer um token: " . $this->dbConnection->error);
            }
            $this->availableTokens--;
            return true;
        } else {
            return false;
        }
    }

    public function returnToken() {
        if ($this->availableTokens < $this->totalTokens) {
            // Incrementar a quantidade de tokens disponíveis no banco de dados
            $query = "UPDATE tokens SET available_tokens = available_tokens + 1";
            $result = $this->dbConnection->query($query);
            if (!$result) {
                die("Erro ao devolver um token: " . $this->dbConnection->error);
            }
            $this->availableTokens++;
            return true;
        } else {
            return false;
        }
    }

    public function closeDBConnection() {
        // Fechar a conexão com o banco de dados
        $this->dbConnection->close();
    }
}

class TokenClient {
    private $server;

    public function __construct(TokenServer $server) {
        $this->server = $server;
    }

    public function requestAvailableTokens() {
        return $this->server->getAvailableTokens();
    }

    public function requestToken() {
        return $this->server->provideToken();
    }

    public function returnToken() {
        return $this->server->returnToken();
    }
}

// Exemplo de uso

// Configurar o servidor com x tokens
$server = new TokenServer(1);

// Criar cliente
$client = new TokenClient($server);

// Variavel que contém a opção do cliente
$op = $_POST['opcao'];



if($op==1){
    // Solicitar quantidade de recursos disponíveis
    echo nl2br("\nRecursos disponíveis: " . $client->requestAvailableTokens() . PHP_EOL);
}elseif ($op==2){
    // Solicitar token
    if ($client->requestToken()) {
        echo nl2br("\nToken fornecido." . PHP_EOL);
        echo nl2br("\n\n");
        echo nl2br("\nRecursos disponíveis: " . $client->requestAvailableTokens() . PHP_EOL);
    }else{
        echo nl2br("\nSem tokens disponíveis." . PHP_EOL);
        echo nl2br("\n\n");
        echo nl2br("\nRecursos disponíveis: " . $client->requestAvailableTokens() . PHP_EOL);
    }
}elseif ($op==3){
    // Devolver token
    if ($client->returnToken()) {
        echo nl2br("\nToken devolvido." . PHP_EOL);
        echo nl2br("\n\n");
        echo nl2br("\nRecursos disponíveis: " . $client->requestAvailableTokens() . PHP_EOL);
    } else {
        echo nl2br("\nNão é possível devolver o token." . PHP_EOL);
        echo nl2br("\n\n");
        echo nl2br("\nRecursos disponíveis: " . $client->requestAvailableTokens() . PHP_EOL);
    }
}else{
    echo nl2br("\nDigite um valor válido");
}



// Solicitar quantidade de recursos disponíveis novamente
echo nl2br("\nRecursos disponíveis: " . $client->requestAvailableTokens() . PHP_EOL);




// Fechar conexão com o banco de dados
$server->closeDBConnection();




?>

<a href="dashboard.php">Retornar</a>




