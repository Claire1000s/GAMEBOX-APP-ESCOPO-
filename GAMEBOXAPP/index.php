<?php
	session_start();

	$arquivo_cadastro_user = file_get_contents("cadastro.json");
	$json_cadastro_user = json_decode($arquivo_cadastro_user, true);

	$arquivo_cadastro_produto = file_get_contents("cadastro_produto.json");
				
	$json_cadastro_produto = json_decode($arquivo_cadastro_produto, true);					
?>

<!DOCTYPE html>

<html lang="pt-br">
	<head>
		<meta charset="UTF-8" />
		<title>GAMEBOX APP - Login</title>
		<link rel="stylesheet" type="text/css" href="style_index.css" />
		<script type="text/javascript" src="jquery-3.3.1.min.js"></script>
	</head>

	<body>
		<div class="container">
			<div class="header">
				<?php
					//echo "<img id='img_perfil' src='" . $_SESSION['img_perfil'] . "' />";
				?>
				<img id="img_logo" src="Images/logo.png" alt="GAMEBOX APP" />
				<img id="img_menu" src="Images/icon-menu.png" />
			</div>
			<div class="search">
				<form method="POST" action="index.php">
					<input type="search" id="ipt-search" name="pesquisa" />
					<input type="submit" id="btn-buscar" value="BUSCAR" />
					<p>Pesquise o seu produto!</p>
				</form>
			</div>
			<div class="result-search">
				<?php
					if(!empty($_POST['pesquisa']))
					{
						$pesquisa = $_POST['pesquisa'];

						foreach($json_cadastro_produto as $jcp=>$data)
						{
							foreach($data as $login=>$columns)
							{
								if(stripos($columns['nome'], $_POST['pesquisa']) !== false)
								{
									/*var_dump($jcp[$login]['img_produto']);
									exit;
									echo "Achou!<br />";
									echo "<img id='img_produto' src='" . $jcp[$columns]['img_produto'] . "' />";
									/*echo "<h2>" . $chave['nome'] . "</h2><br />";
									echo "<p>" . $jcp[$columns]['tipo_produto'] . "</p><br />";
									echo "<p>" . $jcp[$columns]['marca'] . "</p><br />";
									echo "<p>" . $jcp[$columns]['estado_produto'] . "</p><br />";
									echo "<h3>R$ " . $jcp[$columns]['preco'] . "</h3><br />";
									echo "<p>" . $jcp[$columns]['descricao_produto'] . "</p><br /><br />";*/
									break;
								}
								else
								{
									echo "Não achou!<br />";
								}
							}
						}
					}
				?>
			</div>
			<div class="footer">
				<p>GAMEBOX APP :: 2018 :: Todos os direitos reservados.</p>
			</div>
		</div>
	</body>
</html>