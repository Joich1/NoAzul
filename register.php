<?php
session_start();
include 'config.php';
$mensagem = '';

function rUser($username, $pass, $email, $photo){
    global $conn;

    $hashePass = password_hash($pass, PASSWORD_DEFAULT);
    $query = "SELECT * FROM user WHERE nome = '$username' ";

    $cUser = mysqli_query($conn, "SELECT * FROM user WHERE nome = '$username' ");
    if (mysqli_num_rows($cUser) >0 ){
        return "Esse nome de usuário não está disponivél";
    }

    $cEmail = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email' ");
    if (mysqli_num_rows($cEmail) >0 ){
        return "Esse nome de usuário não está disponivél";
    }

    $upload = 'uploads/';
    $nPhoto = $_FILES['photo']['name'];
    $tmpnamephoto = $_FILES['photo']['tmp_name'];
    $pSize = $_FILES['photo']['size'];
    $photo_error = $_FILES['photo']['error'];


    if($photo_error === 0 ){
        if($pSize <= 2 * 1024 *1024){
            $new_name = uniqid('', true) . "." . pathinfo($nPhoto, PATHINFO_EXTENSION);
            $photopath = $upload . $new_name;

            if(move_uploaded_file($tmpnamephoto, $photopath)){
                $query = "INSERT INTO user (nome, email, senha, imagem) VALUES ('$username', '$email', '$hashePass', '$photopath') ";
                if(mysqli_query($conn, $query)){
                    header('location:login.php');
                    exit();
                }else{
                    return "Tente novamente mais tarde.";
                }
            }else{
                return "Erro ao fazer o upload.";
            }
        }else{
            return "ERRO! A imagem deve ter no máximo 2 MB.";
        }
    }else{
        return "Envie uma foto para concluir o cadastro.";
    }
}


if(isset($_POST['register'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $mensagem = rUser($username, $email, $pass, $_FILES['photo']);
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
            <input type="file" name="photo" accept="image/*" id="fInput" required><br>
            <div id="preview" class="photo-preview">
                <img src="#" alt="Prévia da foto escolhida" id="fPreview" width="100" height="100">
            </div>
            
            <input type="submit" name="register" value="Cadastrar">
            <button id="back" type="button">Voltar</button>
            Já possui uma conta<a href="login.php">Logar</a>
        </div>
    </form>
    

    <script src="main.js"></script>
</body>
</html>

