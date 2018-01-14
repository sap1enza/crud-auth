<?php
    $reg_err = "";
    include_once("config.php");

  if(isset($_POST['registrar'])){
        $nome = $_POST['nome'];
        $email = $_POST['email_registrar'];
        $senha = md5($_POST['password_registrar']);
                
        $verificar = mysqli_query($dbcon, "SELECT * FROM TB_USUARIO WHERE EMAIL='$email'");
        if(mysqli_num_rows($verificar)>0) {
            $reg_err = "<div class='alert alert-danger alert-dismissable'>
  Já existe uma conta cadastrada com este email.
</div>";
        } else {
            $insert = mysqli_query($dbcon, "INSERT INTO TB_USUARIO (NOME,EMAIL,SENHA) VALUES ('$nome','$email','$senha')");
            $reg_err = "<div class='alert alert-success alert-dismissable'>
  Cadastro realizado com sucesso!
</div>";
               
        }
    }

        if(isset($_POST['login'])){
        $email = $_POST['email'];
        $senha = md5($_POST['senha']);        
        $verificar = mysqli_query($dbcon, "SELECT * FROM TB_USUARIO WHERE EMAIL='$email' and SENHA='$senha'");
        
        if(mysqli_num_rows($verificar)<= 0) {
            $login_err = "<div class='alert alert-danger alert-dismissable'>
  Login ou senha inválidos
</div>";
        } else {
            session_start();            
            $_SESSION['usuario'] = $email;  
            header("Location: logged.php");   
        }
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
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">CRUD</a>
                </div>
                
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
                </ul>
                
                <ul class="nav navbar-nav navbar-right" style="padding: 10px;">                    
                    <form class="form-inline" method="POST">
                        <div class="form-group"><input type="email" name="email" class="form-control" placeholder="Email" required></div>
                        <div class="form-group"><input type="password" name="senha" class="form-control" placeholder="Senha" required></div>
                        <input type="submit" name="login" class="btn btn-success" value="Entrar">
                    </form>
                </ul>
            </div>
        </nav>
    </header>
    </div>
    
    
    
    <section>
    
    <span class="help-block"><?php echo $reg_err; ?></span>
    </section>
    
     <div class="conteudo" style="width: 30%;">
        <form method="POST">
                        
            <div class="form-group"><input type="text" name="nome" class="form-control" placeholder="Nome" required></div>
            <div class="form-group"><input type="email" name="email_registrar" class="form-control" placeholder="Email" required></div>
            <div class="form-group"><input type="password" name="password_registrar" class="form-control" placeholder="Senha" required></div>
            <input type="submit" name="registrar" class="btn btn-success" value="Cadastrar">
            <a href="index.php" class="btn btn-primary">Voltar</a>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
    <?php include'footer.php'?> 
    
</body>
</html>