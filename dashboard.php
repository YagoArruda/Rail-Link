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
    <title>Dashboard</title>

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
                <div class="d-flex">
                    <img id="avatar" src="" alt="Player_Icon">

                    <div>
                        <div class="d-flex">
                            <h1 id="nickname">Nickname</h1>
                            <p id="level">Level: 0</p>
                        </div>
                        <p id="signature">Signature</p>
                    </div>

                </div>

                <h1>Destaques</h1>
                <!--<p id="uid">UID</p>-->
                <!--<p id="characters">1 - Name - Lv 0 </p>-->

                <div id="characters" class="characters"></div>
            </div>

            <div id="farm-intentions">

            </div>

        </main>
    </div>

    <script type="module" src="assets/js/dashboard.js"></script>

    <script>
        lucide.createIcons();
    </script>

</body>

</html>