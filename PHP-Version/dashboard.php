<?php

session_start();

if (!isset($_SESSION['uid'])) {
    header('Location: index.php');
    exit;
}

$uid = $_SESSION['uid'];

$dados = null;
$erro = null;

try {

    $url = "https://api.mihomo.me/sr_info_parsed/$uid?lang=en";

    $json = file_get_contents($url);

    if ($json === false) {
        throw new Exception("Falha ao consultar API");
    }

    $dados = json_decode($json, true);
} catch (Exception $e) {
    $erro = $e->getMessage();
}

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

    <!--<?php var_dump($dados); ?>-->

    <div class="workspace">


        <?php include 'components/sidebar.php'; ?>

        <main class="content">
            <?php if ($erro): ?>

                <div class="loader">
                    <?php include 'components/loader.php'; ?>
                </div>


            <?php elseif ($dados): ?>

                <h1><?= $dados['player']['nickname'] ?></h1>
                <p><?= $dados['player']['signature'] ?></p>
                <p>Level: <?= $dados['player']['level'] ?></p>
                <h1>Personagens</h1>
                <p><?= $dados['player']['uid'] ?></p>
                <p>1 - <?= $dados['characters'][0]['name'] ?> - Lv <?= $dados['characters'][0]['level'] ?> </p>
                <p>2 - <?= $dados['characters'][1]['name'] ?> - Lv <?= $dados['characters'][1]['level'] ?> </p>
                <p>3 - <?= $dados['characters'][2]['name'] ?> - Lv <?= $dados['characters'][2]['level'] ?> </p>
                <p>4 - <?= $dados['characters'][3]['name'] ?> - Lv <?= $dados['characters'][3]['level'] ?> </p>
                <p>5 - <?= $dados['characters'][4]['name'] ?> - Lv <?= $dados['characters'][4]['level'] ?> </p>
                <p>6 - <?= $dados['characters'][5]['name'] ?> - Lv <?= $dados['characters'][5]['level'] ?> </p>
                <p>7 - <?= $dados['characters'][6]['name'] ?> - Lv <?= $dados['characters'][6]['level'] ?> </p>
                <p>8 - <?= $dados['characters'][7]['name'] ?> - Lv <?= $dados['characters'][7]['level'] ?> </p>

            <?php endif; ?>
        </main>
    </div>

    <script>
        lucide.createIcons();
    </script>

</body>

</html>