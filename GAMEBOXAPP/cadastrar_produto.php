<?php
	session_start();

	if(isset($_FILES['img_produto']['name']) && $_FILES['img_produto']['error'] == 0)
	{
		if(!empty($_POST['tipo_produto']))
		{
			if(!empty($_POST['nome']))
			{
				if(!empty($_POST['preco']))
				{
					if(!empty($_POST['marca']))
					{
						if(!empty($_POST['estado_produto']))
						{
							if(!empty($_POST['descricao_produto']))
							{
								$destino_img = 'Images/' . $_FILES['img_produto']['name'];
								$arquivo_tmp_img = $_FILES['img_produto']['tmp_name'];

								$extensao_img = pathinfo($_FILES['img_produto']['name'], PATHINFO_EXTENSION);
								$extensao_img = strtolower($extensao_img);

								if(strstr('.jpg; .jpeg; .png', $extensao_img))
								{
									$novo_nome_img = uniqid(time() . '.' . $extensao_img);

									$destino_img = 'Images/' . $novo_nome_img;

									$img_produto = $destino_img;

									if(@move_uploaded_file($arquivo_tmp_img, $destino_img))
									{
										echo "Imagem salva com sucesso!<br />";
									}
									else
									{
										echo "Erro ao salvar imagem.";
									}
								}
								else
								{
									echo "Você só pode enviar imagens *jpg, *jpeg ou *png.";
								}

								$tipo_produto = $_POST['tipo_produto'];
								$nome = $_POST['nome'];
								$preco = $_POST['preco'];
								$marca = $_POST['marca'];
								$estado_produto = $_POST['estado_produto'];
								$descricao_produto = $_POST['descricao_produto'];

								$user = $_SESSION['user'];

								try
								{
									$arquivo_cadastro_user = file_get_contents("cadastro.json");
									$json_cadastro_user = json_decode($arquivo_cadastro_user, true);

									$cadastro_produto = file_get_contents("cadastro_produto.json");
				
									$cadastro_produto = json_decode($cadastro_produto, true);
									
									if(empty($cadastro_produto))
									{
										$cadastro_produto = [];
									}
										
									$cadastro_produto[] = array($user => array(
										"img_produto" => $img_produto,
										"tipo_produto" => $tipo_produto,
										"nome" => $nome,
										"preco" => $preco,
										"marca" => $marca,
										"estado_produto" => $estado_produto,
										"descricao_produto" => $descricao_produto,
										)
									);
										
			    					file_put_contents("cadastro_produto.json", json_encode($cadastro_produto));			    				

									echo "Cadastro efetuado com sucesso!";
								}
								catch(json_last_error $e)
								{
									echo "Erro no banco de dados do cadastro de produtos." . $e;
								}
							}
						}
					}
				}
			}
		}
	}
	else
	{
		echo "Você não enviou nenhum arquivo de imagem.";
	}

?>

<!DOCTYPE html>

<html lang="pt-br">
	<head>
		<meta charset="UTF-8" />
		<title>GAMEBOX APP - Cadastrar Produto</title>
	</head>

	<body>
		<div class="container">
			<div class="header">
				<img id="img_logo" src="Images/logo.png" alt="GAMEBOX APP" />
			</div>
			<div class="form-login">
				<form method="POST" action="cadastrar_produto.php" enctype="multipart/form-data">
					<label for="img_produto">Foto do produto</label><br />
					<input type="file" name="img_produto" id="img_produto" accept=".jpg, .png, .jpeg" />
					<br />
					<label for="tipo_produto">Tipo do Produto</label><br />
					<input type="radio" name="tipo_produto" value="console" required />Console
					<input type="radio" name="tipo_produto" value="jogos" required />Jogos
					<input type="radio" name="tipo_produto" value="acessorios" required />Acessórios
					<br />
					<label for="nome">Nome do Produto</label><br />
					<input type="text" name="nome" size="40" required />
					<br />
					<label for="preco">Preço</label><br />
					<input type="text" name="preco" size="20" required />
					<br />
					<label for="marca">Marca</label><br />
					<select name="marca">
						<option value="Sony">Sony</option>
						<option value="Microsoft">Microsoft</option>
						<option value="Nintendo">Nintendo</option>
						<option value="Sega">Sega</option>
						<option value="Outra">Outra</option>
					</select>
					<br />
					<label for="estado_produto">Estado</label><br />
					<input type="radio" name="estado_produto" value="novo" required />Novo
					<input type="radio" name="estado_produto" value="usado" required />Usado
					<br />
					<label for="descricao_produto">Descrição do Produto</label><br />
					<textarea name="descricao_produto" rows="15" cols="50">
						Escreva aqui as especificações do seu produto para a venda ficar mais atraente.
					</textarea>
					<br />
					<input type="submit" value="Cadastrar produto" />
					<a href="perfil.php" target="_self"><input type="button" value="Ver perfil" /></a>
				</form>
			</div>
			<div class="footer">
				<p>Blablabla texto do footer</p>
			</div>
		</div>
	</body>
</html>