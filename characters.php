<?php

session_start();

if (!isset($_SESSION['uid'])) {
    header('Location: index.php');
    exit;
}

$uid = $_SESSION['uid'];

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personagens</title>

    <link rel="stylesheet" href="assets/style.css">

    <script src="https://unpkg.com/lucide@latest"></script>

</head>

<body>
    <?php include 'components/header.php'; ?>

    <div class="workspace">


        <?php include 'components/sidebar.php'; ?>

        <main class="content">
            <div class="loader" id="loader">
                <?php include 'components/loader.php'; ?>
            </div>

            <div id="dashboard-content">

                <h1>Lista de Personagens</h1>

                <div id="characters" class="characters"></div>
            </div>

        </main>
    </div>

    <script>
        window.userName = <?= json_encode($_SESSION['userName']) ?>;
        //window.uid = <?= json_encode($_SESSION['uid']) ?>;
    </script>

    <script type="module" src="assets/js/characters.js"></script>

    <script>
        lucide.createIcons();
    </script>

</body>

</html>