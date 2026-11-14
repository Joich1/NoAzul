<?php
include 'config.php';
session_start();
$mensagem = '';

function lUser($email, $pass){
    global $conn;

    $stmt = mysqli_prepare($conn, "SELECT * FROM user WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($pass, $user["senha"])) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['id'];
            header('location: index.php');
            exit();
        }
    }
    return 'E-mail ou senha incorretos';
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