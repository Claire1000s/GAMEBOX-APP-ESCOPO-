<?php
	session_start();

	$arquivo_cadastro_produto = file_get_contents("cadastro_produto.json");
	$arquivo_cadastro_user = file_get_contents("cadastro.json");

	$json_cadastro_user = json_decode($arquivo_cadastro_user, true);
	$json_cadastro_produto = json_decode($arquivo_cadastro_produto, true);
?>

<!DOCTYPE html>

<html lang="pt-br">
	<head>
		<meta charset="UTF-8" />
		<title>GAMEBOX APP - Perfil</title>
	</head>

	<body>
		<div class="container">
			<div class="header">
				<img id="img_logo" src="Images/logo.png" alt="GAMEBOX APP" />
			</div>
			<div class="perfil-dados">
				<h1>PERFIL</h1>
				<?php
					echo "<img src='" . $_SESSION['img_perfil']	."' id='img_perfil' alt='" . $_SESSION['user'] . "' />";
					foreach($json_cadastro_user as $jcu)
					{
						echo "<h2>" . $jcu['nome'] . "</h2><br />";
					}
					echo "<p>" . $_SESSION['user'] . "</p><br />";
				?>

				<a href="editar_perfil.php" target="_self"><input type="button" value="Editar perfil" /></a>
			</div>
			<div class="perfil-produtos">
				<h1>PRODUTOS CADASTRADOS</h1>
				<br />
				<?php
					echo "<div class='perfil-produto-cadastrado'>";
					if(!empty($json_cadastro_produto))
					{
						foreach($json_cadastro_produto as $jcp)
						{
							echo "<img id='img_produto' src='" . $jcp[$_SESSION['user']]['img_produto'] . "' />";
							echo "<h2>" . $jcp[$_SESSION['user']]['nome'] . "</h2><br />";
							echo "<p>" . $jcp[$_SESSION['user']]['tipo_produto'] . "</p><br />";
							echo "<p>" . $jcp[$_SESSION['user']]['marca'] . "</p><br />";
							echo "<p>" . $jcp[$_SESSION['user']]['estado_produto'] . "</p><br />";
							echo "<h3>R$ " . $jcp[$_SESSION['user']]['preco'] . "</h3><br />";
							echo "<p>" . $jcp[$_SESSION['user']]['descricao_produto'] . "</p><br /><br />";
						}
					}
					echo "<a href='cadastrar_produto.php' target='_self'><input type='button' value='Cadastrar produto' /></a>";
					echo "</div>";
				?>
			</div>
			<div class="footer">
				<p>Blablabla texto do footer</p>
			</div>
		</div>
	</body>
</html>