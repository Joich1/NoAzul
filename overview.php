<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('location: login.php');
    exit();
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NoAzul - Visão Geral</title>
</head>
<body>
    <main>
        <div>
            <p>sem lançamentos de receita</p>
            <button type="button" id="btnr">Fazer Lançamento</button> <a href="#">lançamento</a>
        </div>

        <div id="expense" hidden>
            <button type="button" id="x">X</button>
            <form action="overview.php" method="post">

            </form>
        </div>

    </main>
    

    <script src="overview.js"></script>
</body>
</html>