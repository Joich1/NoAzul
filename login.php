<?php
include 'config.php';
session_start();
$mensagem = '';

function lUser($email, $pass){
    global $conn;

    $query = "SELECT * FROM user WHERE email = '$email' ";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $email = mysqli_fetch_assoc($result);
        if (password_verify($pass, $email["senha"])) {
            $_SESSION['user_id'] = $email['id'];
            header('location: index.php');
            exit();
        }else{
            return 'Senha incorreta';
        }
    }else{
        return 'Email errado, ou não encontrado';
    }
}



if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = trim($_POST['email']);
    $pass = $_POST['password'];
    $mensagem = lUser($email, $pass);
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

<form action="login.php" method="post">
    <input type="text" name="email">
    <input type="text" name="password">

    <input type="submit" name="logar" value="Login">
</form>
    

    <script src="main2.js"></script>
</body>
</html>