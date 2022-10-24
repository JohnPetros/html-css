<?php
// include_once("");
$url = "http://localhost:3000/roles";

$data = json_decode(file_get_contents($url));

$roleId = $_POST["role-id"] ?? 0;

include_once("../includes/test.php");

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/global.css?v=<?php echo time() ?>">
    <link rel="stylesheet" href="../css/urn.css?v=<?php echo time() ?>">
    <script defer src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script defer src="https://kit.fontawesome.com/583fd2bd34.js" crossorigin="anonymous"></script>
    <title>Urna Eletrônica</title>
</head>

<body>

    <i class="fa-solid fa-x close"></i>

    <?php include_once("../includes/parties-table.php"); ?>

    <div class="candidates-table PEsp remove">
        <?php
        $party = "PEsp";
        get_candidates($data, $roleId, $party);
        ?>
    </div>
    <div class="candidates-table PMus remove">
        <?php
        $party = "PMus";
        get_candidates($data, $roleId, $party);
        ?>
    </div>
    <div class="candidates-table PProf remove">
        <?php
        $party = "PProf";
        get_candidates($data, $roleId, $party);
        ?>
    </div>
    <div class="candidates-table PFest remove">
        <?php
        $party = "PFest";
        get_candidates($data, $roleId, $party);
        ?>
    </div>
    <div class="candidates-table PFolc remove">
        <?php
        $party = "PFolc";
        get_candidates($data, $roleId, $party);
        ?>
    </div>

    <main class="container">

    <div class="final-message hide">
        FINALIZAR 
    </div>

        <form class="urn" method="POST">
            <input type="hidden" name="role-id" value="<?php echo $roleId ?>">
            <input type="hidden" name="url" value="<?php echo $url ?>">
            <div class="display">
                <div class="content">
                    <div class="left-side">
                        <div class="header hide">
                            SEU VOTO PARA
                        </div>
                        <div class="role-title">
                            Deputado Federal
                        </div>
                        <div class="digits ">
                        </div>
                        <div class="information hide">

                        </div>
                    </div>
                    <div class="right-side hide">
                        <aside class="right-side">

                        </aside>
                    </div>
                </div>
                <footer class="footer hide">
                    Aperte a tecla: <br>
                    &nbsp;&nbsp;CONFIRMA para CONFIRMAR este voto <br>
                    &nbsp;&nbsp;CORRIGE para reiniciar este voto
                </footer>
            </div>
            <div class="keyboard">
                <div class="urn-logo">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/62/Coat_of_arms_of_Brazil_%28grayscale%29.svg/766px-Coat_of_arms_of_Brazil_%28grayscale%29.svg.png" alt="Escudo da justiça eleitoral">
                    <h2>JUSTIÇA <br> ELEITORAL</h2>
                </div>
                <div class="keyboard-grid">
                    <button data-number type="button" class="keyboard-button">1</button>
                    <button data-number type="button" class="keyboard-button">2</button>
                    <button data-number type="button" class="keyboard-button">3</button>
                    <button data-number type="button" class="keyboard-button">4</button>
                    <button data-number type="button" class="keyboard-button">5</button>
                    <button data-number type="button" class="keyboard-button">6</button>
                    <button data-number type="button" class="keyboard-button">7</button>
                    <button data-number type="button" class="keyboard-button">8</button>
                    <button data-number type="button" class="keyboard-button">9</button>
                    <button data-number type="button" class="keyboard-button zero">0</button>
                    <button data-white type="button" class="keyboard-button action white">BRANCO</button>
                    <button data-correct type="button" class="keyboard-button action correct">CORRIGE</button>
                    <button data-confirm type="button" class="keyboard-button action confirm">CONFIRMA</button>
                </div>
            </div>
        </form>

       
    </main>


    <audio id="confirm-sound" src="../assets/audios/confirm.wav"></audio>
    <audio id="key-sound" src="../assets/audios/key.wav"></audio>
    <script src="../js/main.js?v=<?php echo time() ?>"></script>
</body>

</html>