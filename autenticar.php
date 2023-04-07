<?php
// Iniciar a sessão
session_start();



// Conectar ao banco de dados
require_once 'config.php';

$conexao = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conexao) {
            die("Conexão com o banco de dados falhou: " . mysqli_connect_error());
            exit();
        }


  // Receber dados do formulário
  $email = $_POST['email'];
  $senha = $_POST['senha'];

  // Buscar usuário no banco de dados
  $sql = "SELECT * FROM usuarios WHERE email='$email'";
  $resultado = mysqli_query($conexao, $sql);
  $usuario = mysqli_fetch_assoc($resultado);

if ($usuario) {
    // Verificar se o usuário foi encontrado e se a senha está correta
    if (password_verify($senha, $usuario['senha'])) {
      // Autenticação bem-sucedida, armazenar dados do usuário na sessão
      $_SESSION['id_usuario'] = $usuario['id'];
      $_SESSION['nome_usuario'] = $usuario['nome'];
      header("Location: dashboard.php"); // Redirecionar para a página de dashboard
      die();
    }else{
      echo "Email ou senha incorretos!";
    } 


  
  // Fechar a conexão
  mysqli_close($conexao);


}
echo "Usuário não encontrado";


?>
