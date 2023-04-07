<!DOCTYPE html>
<html>
<head>
  <title>Cadastro de Usuário</title>
</head>
<body>
  <h1>Cadastro de Usuário</h1>
  <form action="cadastrar.php" method="post">
    <label>Nome:</label>
    <input type="text" name="nome" required>
    <br>
    <label>Email:</label>
    <input type="email" name="email" required>
    <br>
    <label>Senha:</label>
    <input type="password" name="senha" required>
    <br>
    <input type="submit" value="Cadastrar">
  </form>

<br>
    Já tem cadastro? <a href="login.php">login</a>
</body>
</html>
