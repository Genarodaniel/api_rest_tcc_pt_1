<?php
//verificar se os dados foram enviados por POST
if($_SERVER['REQUEST_METHOD'] = 'POST'){
	$id = (isset($_POST["id"]) && $_POST["id"] != null)? $_POST["id"]:"";
	$nome = (isset($_POST["nome"]) && $_POST["nome"] != null)? $_POST["nome"]:NULL;
	$email = (isset($_POST["email"]) && $_POST["email"] != null)? $_POST["email"]:NULL;
	$celular = (isset($_POST["celular"]) && $_POST["celular"]!= null)? $_POST["celular"] : NULL;
}
	else if (!isset($id)) {
		// Se não foi incrementado nenhum valor pro id
		$id = (isset($_GET["id"]) && $_GET["id"] != null)? $_GET["id"]:"";
		$nome = NULL;
		$email=NULL;
		$celular=NULL;
	}

try{
	$conexao = new PDO("mysql:host=localhost; dbname=crudsimples", "root","92934786");
	$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$conexao->exec("set names utf8");
}
catch(PDOException $erro){
	echo "Erro na conexao:" . $erro->getMessage();
}
if(isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $nome != ""){
	try{
		$stmt = $conexao->prepare("INSERT INTO contatos (nome, email, celular) VALUES (?, ?, ?)");
		$stmt->bindParam(1, $nome);
		$stmt->bindParam(2, $email);
		$stmt->bindParam(3, $celular);

		if($stmt->execute()){
			if($stmt->rowCount() > 0){
				echo "Dados cadastrados!";
				$id = null;
				$nome =null;
				$email = null;
				$celular = null;
			}
			else{
				echo "Erro ao tentar efetivar";
			}
		}else{
			throw new PDOException("Erro: Não foi possível executar a declaracao sql");
		}

	}catch(PDOException $erro){
			echo "Erro:" . $erro->getMessage();
		}
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta chatset="UTF-8">
	 <meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" type="text/css" href="css/estilos.css">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<title>Agenda de contatos</title>
</head>
<body>
	<form class="form-signin" action="?act=save" method ="POST" name="form1">
		<h2 class="form-signin-heading">Agenda de contatos</h2>
		<div id="content"><input type="hidden" name="id" id="input_id"<?php 
			if(isset($id) && $id !=null || $id != ""){
				echo "value=\"{$id}\"";}?>/>
		<div class="div_input" id ="div1">Nome:<input type="text" name="nome" class="form-control" id="input_nome"<?php
		if(isset($nome)&& $nome !=null||$nome !=""){
			echo "value=\"{$nome}\"";}?>/></div>
		<div class="div_input" id ="div2">E-mail:<input type="email" name="email" class="form-control"id ="input_email"<?php
		if(isset($email) && $email !=null || $email !=""){
		echo "value=\"{$email}\"";}?>/></div>
		<div class="div_input" id="div3">Celular:<input type="text" name="celular" class="form-control" id="input_celular"<?php
		if(isset($celular) && $celular !=null || $celular !=""){
			echo "value=\"{$celular}\"";}?>/></div><div id="botoes">
		<button class="btn btn-lg btn-primary btn-block" type="submit" name="salvar" value="Salvar">Salvar</button>
		<button class="btn btn-lg btn-primary btn-block" type="reset" value="Novo">Novo</div>
		<hr>
	</form>
	<table class="table table-striped table-dark">
		<thead>
			<tr>
				<th scope="col">Nome</th>
				<th scope="col">E-mail</th>
				<th scope="col">Celular</th>
				<th scope="col">Ações</th>
			</tr>
			<?php
			try{
				$stmt = $conexao->prepare("SELECT * FROM contatos");
				if($stmt->execute()){
					while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
						echo "<tr>";
						echo "<td>".$rs->nome."</td><td>".$rs->email."</td<td>".$rs->celular."</td><td><center><a href=\"\">[Alterar]</a>"."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"."<a href=\"\">[Excluir]</a><center></td>";
						echo "</tr>";
					}
					}else{
						echo "Erro: Não foi possivel recuperar os dados do banco";
					}
				}catch(PDOException $erro){
					echo "Erro".$erro->getMessage();
				}
			
		?>
	</table>
</body>
</html>