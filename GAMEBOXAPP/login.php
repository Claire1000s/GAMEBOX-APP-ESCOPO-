<?php
	session_start();

	if(!empty($_POST))
	{
		$user = $_POST['user'];
		$pass = $_POST['pass'];

		if(file_exists('cadastro.json'))
		{
			$arquivo_login = file_get_contents("cadastro.json");

			$json = json_decode($arquivo_login, true);

			if(in_array($user, array_column($json, 'user')) && in_array($pass, array_column($json, 'pass')))
			{
				$_SESSION['user'] = $user;
				header("Location: index.php");
			}
			else
			{
				echo "O usuário ou a senha digitados estão incorretos ou não existem. Verifique os dados e tente novamente.";
			}
		}
		else
		{
			echo "Erro! O usuário não está cadastrado!<br />";
		}
	}
?>
<!DOCTYPE html>

<html lang="pt-br">
	<head>
		<meta charset="UTF-8" />
		<title>GAMEBOX APP - Login</title>
	</head>

	<body>
		<div class="container">
			<div class="header">
				<img id="img_logo" src="Images/logo.png" alt="GAMEBOX APP" />
			</div>
			<div class="form-login">
				<form method="POST" action="login.php">
					<label for="user">Usuário</label><br />
					<input type="text" name="user" size="30" required />
					<br />
					<label for="pass">Senha</label><br />
					<input type="password" name="pass" size="30" required />
					<br />
					<a href="cadastro.php" target="_self"><input type="button" value="Cadastre-se!" /></a>
					<input type="submit" value="Entrar" />
				</form>
			</div>
			<div class="footer">
				<p>Blablabla texto do footer</p>
			</div>
		</div>
	</body>
</html>