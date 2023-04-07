<?php
// Iniciar a sessão
session_start();

// Verificar se o usuário está autenticado
if (!isset($_SESSION['id_usuario'])) {
  header("Location: login.php"); // Redirecionar para a página de login
  exit();
}

// Exibir dados do usuário autenticado
echo "Bem-vindo, " . $_SESSION['nome_usuario'] . "!";
?>

<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
</head>
<body>
  <h1>Dashboard</h1>
  <p>Esta é a página de dashboard.</p>


  
<img src="img/img.jpg" width="400" height="300">
<br>


<?php
// endereço IP do servidor e porta que você deseja verificar
$host = '127.0.0.1';
$port = 80;

// tenta abrir uma conexão de socket para o host e porta especificados
$socket = @fsockopen($host, $port, $errorCode, $errorMessage, 10);

// verifica se a conexão foi aberta com sucesso
if (!$socket) {
    // a conexão falhou, então o servidor não está ativo
    echo "Servidor não está ativo ";
    $imagem = "img/off.png";
} else {
    // a conexão foi aberta com sucesso, então o servidor está ativo
    echo "Servidor está ativo ";
    $imagem = "img/on.png";
    fclose($socket); // fecha a conexão
}
?>
<img src="<?php echo $imagem; ?>" width="10" height="10">


<br><br><br>
<label> Solicitar quantidade de recursos disponíveis........1</label>
<br>
<label> Solicitar Token......................................................2</label>
<br>
<label> Devolver Token.....................................................3</label>
<br>
<h4></h4>
<form method="post" action="server.php">
  <label for="meu_menu">Solicitação</label>
<!--
  <select name="meu_menu" id="meu_menu">
    <option name="opcao" value="opcao1">Sim</option>
    <option name="opcao" value="opcao2">Não</option>
  </select>
-->
<label></label>
    <input type="text" name="opcao" required>
  <button type="submit">Enviar</button>
</form>




<?php

if (isset($_POST['opcao'])) {

  $opcao = $_POST['opcao'];

  echo "Olá, $opcao!";
  }

?>




<br><br><br>





  <a href="logout.php">Sair</a> <!-- Link para fazer logout -->

</body>
</html>