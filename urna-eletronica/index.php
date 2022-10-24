<?php
$form_header = "";

function verify_is_able_to_vote($age)
{
    global $isAbleToVote;
    if ($age < 16) {
        echo "Oops! Você tem $age anos e só poderá votar daqui a " . (18 - $age) . " anos";
    } else if ($age <= 18 || $age >= 70) {
        echo "Você tem $age anos e seu voto é opcional";
        $isAbleToVote = true;
    } else {
        echo "Você tem $age anos e está apto a votar.";
        $isAbleToVote = true;
    }
}

if (isset($_GET["submit"])) {
    $isAbleToVote = false;

    $name = $_GET["name"];
    $dateOfBirth = $_GET["birth"];

    $today = date("Y-m-d");
    $diff = date_diff(date_create($dateOfBirth), date_create($today));
    $age = $diff->format('%y');
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/form.css?v=<?php echo time() ?>">
    <link rel="stylesheet" href="src/css/global.css?v=<?php echo time() ?>">
    <title>Eleições 2022</title>
</head>

<body>
   <?php include_once("./src/includes/header.html") ?>

    <main class="container">
        <form action="index.php">
            <header>
                <?php
                if (isset($age)) {
                    verify_is_able_to_vote($age);
                } else {
                    echo "Antes de votar, insira seu nome e data de nascimento, por favor.";
                }
                ?>
            </header>
            <div class="content">
                <div class="labels">
                    <label for="name">
                        <span class="label">Nome</span>
                        <input 
                            type="text" 
                            <?php 
                                echo isset($isAbleToVote) && $isAbleToVote ? "disabled" : ""
                             ?> 
                            name="name" 
                            value="<?php echo isset($name) && $isAbleToVote ? $name : "" ?>" 
                            required
                        >
                    </label>
                    <label for="birth">
                        <span class="label">Data de nascimento</span>
                        <input
                         type="date" 
                         <?php 
                          echo isset($isAbleToVote) && $isAbleToVote ? "disabled" : "" 
                         ?>  
                          name="birth"
                          value="<?php echo isset($dateOfBirth) && $isAbleToVote ? $dateOfBirth : "" ?>"
                          required
                        >
                    </label>
                </div>
                <button type="submit" name="submit">
                    <?php
                    if (!isset($isAbleToVote) || !$isAbleToVote) {
                        echo "Enviar";
                    } 
                     else {
                        echo "Confirmar";
                        echo "
                        <script>
                            const form = document.querySelector('form');
                            form.action = './src/pages/voting.php'; 
                       </script>
                       ";
                    }
                    ?>
                </button>
            </div>
        </form>
    </main>

</body>

</html>