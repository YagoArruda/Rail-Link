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

        </main>
    </div>

    <script>
        document.getElementById('loader').style.display = 'flex';
        document.getElementById('dashboard-content').style.display = 'none';

        async function carregarDados() {

            const resposta = await fetch('api/player.php');

            const dados = await resposta.json();

            document.getElementById('nickname').textContent = dados.player.nickname;
            document.getElementById('signature').textContent = dados.player.signature;
            document.getElementById('level').textContent = dados.player.level;
            //document.getElementById('uid').textContent = dados.player.uid;
            document.getElementById('avatar').src = "https://raw.githubusercontent.com/Mar-7th/StarRailRes/master/" + dados.player.avatar.icon;

            const charactersDiv = document.getElementById('characters');
            charactersDiv.innerHTML = '';

            dados.characters.forEach((personagem, index) => {

                const div = document.createElement('div');
                //div.className = "character-card";

                if (personagem.rarity === 5) {
                    div.className = "character-card rarity-5";
                } else if (personagem.rarity === 4) {
                    div.className = "character-card rarity-4";
                } else {
                    div.className = "character-card rarity-other";
                }

                const p = document.createElement('p');
                p.textContent = `${index + 1} - ${personagem.name} - Lv ${personagem.level}`;
                //charactersDiv.appendChild(p);
                div.appendChild(p);

                const img = document.createElement('img');
                img.src = "https://raw.githubusercontent.com/Mar-7th/StarRailRes/master/" + personagem.icon;
                //charactersDiv.appendChild(img);
                img.className = "character-image";
                div.appendChild(img);

                charactersDiv.appendChild(div);

            });

            document.getElementById('loader').style.display = 'none';
            document.getElementById('dashboard-content').style.display = 'block';
        }

        carregarDados();
    </script>

    <script>
        lucide.createIcons();
    </script>

</body>

</html>