<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    //header('location: login.php');
    echo 'atençao, você não está logado';
    //exit();
}

$mensagem = '';

function addTransaction($iduser, $type, $amount, $description, $notes, $date){

}


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $type = $_POST['type'] ?? '';
    $amount = $_POST['amont'] ?? '';
    $date = $_POST['transaction_date'] ?? '';
    $description = trim($_POST['description'] ?? '');
    $notes = trim($_POST['notes'] ?? '');
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
            <form action="overview.php" method="post">
                <button type="button" id="x">X</button>
                <h1>nova <select name="type">
                    <option hidden>Receita</option>
                    <option value="income">Despesa</option>
                    <option value="expense">Receita</option>
                    <option value="transfer">Transferência</option>
                </select>
            </h1>

                <input type="number" step="0.01" name="amount" placeholder="R$ 00,0"> 
                <input type="date" name="transaction">
                <select name="repetition">
                    <option hidden>Repetição</option>
                    <option>Única</option>
                    <option>Parcelada</option>
                    <option>Fixa</option>
                </select><br>

                <input type="text" name="description" placeholder="descrição">
                
                <!--não sei se eesse select vai entrar, talvez não-->
                <select name="status">
                    <option hidden>conta*</option>
                    <option>fazer depois isso aqui</option>
                </select><br>

                <select>
                    <option hidden>Categoria</option>
                    <option>Fazer isso depois tambem</option>
                </select><br>

                <input type="text" placeholder="Observações">

                <button type="submit">Salvar</button>

            </form>
        </div>

    </main>
    

    <script src="./js/overview.js"></script>
</body>
</html>