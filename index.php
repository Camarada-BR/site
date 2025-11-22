<?php
    include 'database.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SISM</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <header>
    <h1>Sistema Integrado de Segurança e Monitoramento (SISM)</h1>
  </header>

  <main>

    <div class="container">
      <div class="form-box active" id="login-form">
        <form method="post" action="register.php">
          <h2>Login</h2>
          <input type="email" name="email" placeholder="Email" required>
           <input type="password" name="password" placeholder="Password" required>
          <button type="submit" name="login">Login</button>
          <p>Não Possuo um conta? <a href="#" onclick="showForm('register-form')">Registrar</a></p>
        </form>
      </div>

      <div class="form-box" id="register-form">
        <form action="register.php" method="post">
          <h2>Register</h2>
          <input type="text" name="username" placeholder="Name" required>
          <input type="email" name="email" placeholder="Email" required>
          <input type="password" name="password" placeholder="Password" required>
          <button type="submit" name="register">Register</button>
          <p>Ja tenho uma conta <a href="#" onclick="showForm('login-form')">Login</a></p>
        </form>
      </div>
    </div>

  </main>

  <script src="script.js"></script>
  
</body>

</html>