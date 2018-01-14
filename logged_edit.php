<?php
    $msg = "";
    session_start();
    include_once("config.php");
    $result = mysqli_query($dbcon, "SELECT * FROM tasks ORDER BY CODIGO DESC"); 
    if(isset($_POST['logout'])){
      header("Location: index.php");
      exit();
    }


if(isset($_POST['atualizar']))
{	

	$codigo = mysqli_real_escape_string($dbcon, $_POST['codigo']);
	
	$nome = mysqli_real_escape_string($dbcon, $_POST['nome']);
	$descricao = mysqli_real_escape_string($dbcon, $_POST['descricao']);
	$anexo = mysqli_real_escape_string($dbcon, $_POST['anexo']);	
	

		$resulta = mysqli_query($dbcon, "UPDATE tasks SET nome='$nome',descricao='$descricao',anexo='$anexo' WHERE codigo=$codigo");
		header("Location: logged.php");
}
?>
<?php

$codigo = $_GET['codigo'];

$result = mysqli_query($dbcon, "SELECT * FROM tasks WHERE codigo=$codigo");

while($res = mysqli_fetch_array($result))
{
	$nome = $res['nome'];
	$descricao = $res['descricao'];
	$anexo = $res['anexo'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD</title>

   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="css/style.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
</head>
<body>
    
    <div>
    <header>
        <nav class="navbar navbar-default" >
            <div class="container-fluid">
                <div class="navbar-header">
                    <span class="welcomeuser"><h5>Olá <b><?php echo $_SESSION['usuario']; ?></b>. Você está logado(a).</h5></span>
                </div>
                
                
                <ul class="nav navbar-nav navbar-right" style="padding: 10px;">
                    
                    <form method="POST">
                    <a href="logged_add.php" class="btn btn-success">Adicionar</a>
                    <input type="submit" name="logout" class="btn btn-danger" value="Sair"> 
                    
                    </form>
                    
                    
                </ul>
            </div>
        </nav>
    </header>
    </div>
    <span class="help-block"><?php echo $msg; ?></span>
        
    <div class="conteudo" style="width: 30%;">
        <form method="POST" action="logged_edit.php" name="form1">
                        
            <div class="form-group"><input type="text" name="nome" class="form-control" value="<?php echo $nome;?>" required></div>
            <div class="form-group"><input type="text" name="descricao" class="form-control" value="<?php echo $descricao;?>" required></div>
            <div class="form-group"><input type="text" name="anexo" class="form-control" value="<?php echo $anexo;?>"></div>
            <td><input type="hidden" name="codigo" value=<?php echo $_GET['codigo'];?>></td>
            <input type="submit" name="atualizar" class="btn btn-success" value="Atualizar">
            <a href="logged.php" class="btn btn-primary">Voltar</a>
        </form>
        
        
    </div>

    
    <?php include'footer.php'?> 

</body>
</html>