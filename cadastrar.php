<?php
// Conectar ao banco de dados
require_once 'config.php';

// Verificar se a conexão foi estabelecida
$conexao = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conexao) {
            die("Conexão com o banco de dados falhou: " . mysqli_connect_error());
            exit();
        }



// Receber dados do formulário
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Criptografar a senha
//$senha = $_POST['senha'];

// Inserir dados no banco de dados
$sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";
if (mysqli_query($conexao, $sql)) {
  echo "Usuário cadastrado com sucesso!";
} else {
  echo "Erro ao cadastrar usuário: " . mysqli_error($conexao);
}

// Fechar a conexão
mysqli_close($conexao);
?>

<a href="login.php">Acessar</a> 