<?php
    session_start();
    include_once("config.php");
    $result = mysqli_query($dbcon, "SELECT * FROM tasks ORDER BY CODIGO DESC"); 
    if(isset($_POST['logout'])){
      header("Location: index.php");
      exit();
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
    
    <div>
        
        
        
        
        
    <div class="container"> 
        <input class="form-control" id="myInput" type="text" placeholder="Procurar..">
        <br>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Nome</th>
        <th>Descrição</th>
        <th>Anexo</th>
        <th>Ação</th>
      </tr>
    </thead>
    <tbody id="myTable">
      <?php 
        while($res = mysqli_fetch_array($result)){
            echo "<tr>";
            echo "<td width='15%'>".$res['nome']."</td>";
            echo "<td>".$res['descricao']."</td>";
            echo "<td width='25%'>".$res['anexo']."</td>";
            echo "<td width='14%'><a href=\"logged_edit.php?codigo=$res[codigo]\" class=\"btn btn-primary\">Editar</a> <a href=\"delete.php?codigo=$res[codigo]\" class=\"btn btn-danger\">Deletar</a></td>";
        }
	?>
    </tbody>
  </table>
    </div>

<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
    </div>
    
    <?php include'footer.php'?> 

</body>
</html>