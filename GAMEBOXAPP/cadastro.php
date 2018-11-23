<?php
	$id = 0;

	if(!empty($_POST['nome']))
	{
		if(!empty($_POST['nasc']))
		{
			if(!empty($_POST['cpf']))
			{
				if(!empty($_POST['rg']))
				{
					if(!empty($_POST['endereco']))
					{
						if(!empty($_POST['telefone']))
						{
							if(!empty($_POST['celular']))
							{
								if(!empty($_POST['email']))
								{
									if(!empty($_POST['user']))
									{
										if(!empty($_POST['pass']))
										{
											$nome = $_POST['nome'];
											$nasc = $_POST['nasc'];
											$cpf = $_POST['cpf'];
											$rg = $_POST['rg'];
											$endereco = $_POST['endereco'];
											$telefone = $_POST['telefone'];
											$celular = $_POST['celular'];
											$email = $_POST['email'];
											$user = addslashes($_POST['user']);
											$pass = addslashes(md5($_POST['pass']));

											$id = $_POST['user'];
									
											$cadastro = array($id=>array(
												"nome" => $nome,
												"nasc" => $nasc,
												"cpf" => $cpf,
												"rg" => $rg,
												"endereco" => $endereco,
												"telefone" => $telefone,
												"celular" => $celular,
												"email" => $email,
												"user" => $user,
												"pass" => $pass		
												)
											);

											foreach($cadastro as $c)
											{
												$arquivo = fopen('cadastro.json', 'a');
		    									fwrite($arquivo, json_encode($cadastro));
		   	 									fclose($arquivo);
											}

											echo "Cadastro efetuado com sucesso!";
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
?>

<!DOCTYPE html>

<html lang="pt-br">
	<head>
		<meta charset="UTF-8" />
		<title>GAMEBOX APP - Cadastre-se!</title>
	</head>

	<body>
		<div class="container">
			<div class="header">
				<img id="img_logo" src="Images/logo.png" alt="GAMEBOX APP" />
			</div>
			<div class="form-cadastro">
				<form method="POST" action="cadastro.php">
					<label for="nome">Nome completo: </label>
					<input type="text" name="nome" size="50" required />
					<label for="nasc">Data de nascimento: </label>
					<input type="date" name="nasc" required />
					<br />
					<label for="cpf">CPF: (Somente números)</label>
					<input type="text" name="cpf" size="30" maxlength="11" required />
					<label for="rg">RG: (Somente números)</label>
					<input type="text" name="rg" size="30" maxlength="9" required />
					<br />
					<label for="endereco">Endereço completo: </label>
					<input type="text" name="endereco" size="70" required />
					<br />
					<label for="telefone">Telefone: </label>
					<input type="tel" name="telefone" size="25" maxlength="13" required />
					<label for="celular">Celular: </label>
					<input type="tel" name="celular" size="25" maxlength="13" required />
					<br />
					<label for="email">E-mail: </label>
					<input type="email" name="email" size="20" required />
					<br />
					<label for="user">Usuário: </label>
					<input type="text" name="user" size="20" required />
					<br />
					<label for="pass">Senha: </label>
					<input type="password" name="pass" size="20" required />
					<br /><br />
					<input type="submit" name="enviar" value="Enviar" />
				</form>
			</div>
			<div class="footer">
				<p>Blablabla texto do footer</p>
			</div>
		</div>
	</body>
</html>