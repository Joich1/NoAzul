<?php
session_start();
include 'config.php';
$mensagem = '';

function rUser($username, $pass, $email, $photo){
    global $conn;

    $cUser = mysqli_query($conn, "SELECT * FROM user WHERE nome = '$username' ")

}


if(isset($_POST['register'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $mensagem = rUser($username, $email, $pass, $photo);
}
?>




<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NoAzul</title>
</head>
<body>

    <form action="register.php" method="post" enctype="multipart/form-data">
        <div id="etapa1">
            <input type="text" name="email" placeholder="123@gmail.com">
            <input type="text" name="password" placeholder="*****">
            <button id="next" type="button" >Próximo</button>
        </div>

        <div id="etapa2" hidden>
            <input type="text" name="username" placeholder="Nome">
            <input type="submit" value="Cadastrar">
            <button id="back" type="button">Voltar</button>
            Já possui uma conta<a href="login.php">Logar</a>
        </div>
    </form>
    

    <script src="main.js"></script>
</body>
</html>

