<?php
	session_start();

	if(isset($_FILES['img_perfil']) && !empty($_POST['nome']))
	{
		$destino_img = 'Images/' . $_FILES['img_perfil']['name'];
		$arquivo_tmp_img = $_FILES['img_perfil']['tmp_name'];

		$extensao_img = pathinfo($_FILES['img_perfil']['name'], PATHINFO_EXTENSION);
		$extensao_img = strtolower($extensao_img);

		if(strstr('.jpg; .jpeg; .png', $extensao_img))
		{
			$novo_nome_img = uniqid(time() . '.' . $extensao_img);

			$destino_img = 'Images/' . $novo_nome_img;

			echo $destino_img;

			$_SESSION['img_perfil'] = $destino_img;

			if(@move_uploaded_file($arquivo_tmp_img, $destino_img))
			{
				echo "Imagem alterada com sucesso!<br />";
			}
			else
			{
				echo "Erro ao alterar imagem!<br />";
			}
		}
		else
		{
			echo "Você só pode enviar imagens *jpg, *jpeg ou *png.";
		}

		$arquivo_cadastro_user = file_get_contents("cadastro.json");
		$json_cadastro_user = json_decode($arquivo_cadastro_user, true);

		foreach($json_cadastro_user as $jcu)
		{
			$json_cadastro_user[$_SESSION['user']]['nome'] = $_POST['nome'];
			file_put_contents("cadastro.json", json_encode($json_cadastro_user));
		}
		
		header("Location: perfil.php");
		echo "Nome alterado com sucesso!<br />";
	}
?>

<!DOCTYPE html>

<html lang="pt-br">
	<head>
		<meta charset="UTF-8" />
		<title>GAMEBOX APP - Editar perfil</title>
	</head>

	<body>
		<div class="container">
			<div class="header">
				<img id="img_logo" src="Images/logo.png" alt="GAMEBOX APP" />
			</div>
			<div class="perfil-dados">
				<form method="POST" action="editar_perfil.php" enctype="multipart/form-data">
					<h1>PERFIL</h1>
					<?php
						echo "<img src='" . $_SESSION['img_perfil']	."' id='img_perfil' alt='" . $_SESSION['user'] . "' /><br />";
						echo "<label>Alterar imagem do perfil</label><br /><input type='file' name='img_perfil' accept='.jpg, .jpeg, .png' /><br />";
						echo "<label>Alterar nome</label><br /><input type='text' name='nome' size='30' /><br />";
					?>
					<input type="submit" id="btn_perfil" value="Salvar alterações" />
				</form>
			</div>
			<div class="footer">
				<p>Blablabla texto do footer</p>
			</div>
		</div>
	</body>
</html>