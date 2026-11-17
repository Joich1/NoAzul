<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    //só pra teste, depois tirar!
    //header('location: login.php');
    echo 'Atençao, você não está logado';
    //exit();
}

$mensagem = '';

function addTransaction($iduser, $type, $amount, $description, $notes, $date, $repetition){
    global $conn;

    if($type === 'transfer'){
        return "Transferência ainda não está disponível.";
    }

    if($repetition !== 'single'){
        return "parcelada e fixa ainda não estão disponível.";
    }

    if(!in_array($type, ['income', 'expense'])){
        return "Escolha o tipo de lançamento.";
    }

    if(!is_numeric($amount) || $amount <= 0){
        return "Digite um valor maior que 0.";
    }
    $amount = round((float)$amount, 2);
    if($amount > 99999999.99){
        return "Valor muito alto.";
    }

    if(mb_strlen($description) > 255 || mb_strlen($notes) > 255){
        return "Descrição e observações podem ter no máximo 255 caracteres.";
    }

    $d = DateTime::CreateFromFormat('Y-m-d', $date);
    if(!$d || $d->format('Y-m-d') !== $date){
        return "Data inválida.";
    }

    $stmt = mysqli_prepare($conn, "INSERT INTO `transaction` (iduser, type, amount, description, notes, transaction_date) VALUES (?, ?, ?, ?, ?, ?) ");
    mysqli_stmt_bind_param($stmt, "isdsss", $iduser, $type, $amount, $description, $notes, $date );

    if(mysqli_stmt_execute($stmt)){
        header('location: overview.php');
        exit();
    }

    return "Tente novamente mais tarde.";
}


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $type = $_POST['type'] ?? '';
    $amount = $_POST['amount'] ?? '';
    $date = $_POST['transaction_date'] ?? '';
    $repetition = $_POST['repetition'] ?? 'single';
    $description = trim($_POST['description'] ?? '');
    $notes = trim($_POST['notes'] ?? '');

    /*
    if(!isset($_SESSION['user_id'])){
        $mensagem = "Você precisa estar logado para salvar.";
    }else{
        $mensagem = addTransaction($_SESSION['user_id'], $type, $amount, $description, $notes, $date, $repetition);
    }*/
}

$incomes = [];
if(isset($_SESSION['user_id'])){
    $stmt = mysqli_prepare($conn, "SELECT amount, description, transaction_date FROM `transaction` WHERE iduser = ? AND type = 'income' ORDER BY transaction_date  DESC, id DESC");
    mysqli_stmt_bind_param($stmt, "i", $_SESSION['user_id']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $incomes = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
            <?php if (empty($incomes)): ?>
                <p>sem lançamentos de receita</p>
            <?php else: ?>

                <ul>
                    <?php foreach($incomes as $income): ?>
                        <li>
                            <?php echo date('d/m/Y', strtotime($income['transaction_date'])); ?> -
                            <?php echo htmlspecialchars($income['description']); ?> -
                            R$ <?php echo number_format($income['amount'], 2, ',', '.'); ?> 
                        </li>
                        <?php endforeach; ?>
                </ul>
                <?php endif; ?>
                <button type="button" id="btnr">Fazer Lançamento</button> <a href="#">lançamento</a>
        </div>

        <div id="expense" <?php echo $mensagem === '' ? 'hidden' : ''; ?>>
            <form action="overview.php" method="post">
                <button type="button" id="x">X</button>
                <h1>nova <select name="type">
                    <option hidden>Receita</option>
                    <option value="income">Despesa</option>
                    <option value="expense">Receita</option>
                    <option value="transfer">Transferência</option>
                </select>
            </h1>

                <input type="number" step="0.01" min="0.01" name="amount" placeholder="R$ 00,0"> 
                <input type="date" name="transaction_date">
                <select name="repetition">
                    <option hidden>Repetição</option>
                    <option value="single">Única</option>
                    <option value="installemnt">Parcelada</option>
                    <option value="recurring">Fixa</option>
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

                <input type="text" name="notes" placeholder="Observações" maxlength="255">

                <button type="submit">Salvar</button>

            </form>
        </div>

    </main>
    

    <script src="./js/overview.js"></script>
</body>
</html>