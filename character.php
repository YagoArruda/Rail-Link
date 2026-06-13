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
    <title>Personagem</title>

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

                <h1>Personagem</h1>

                <div id="characters" class="characters"></div>
            </div>

        </main>
    </div>

    <script type="module" src="assets/js/character.js"></script>

    <script>
        lucide.createIcons();
    </script>

</body>

</html>