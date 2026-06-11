<?php

session_start();

$error = null;
$uid = '';

if (isset($_SESSION['uid'])) {
    header('Location: dashboard.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $uid = trim($_POST['uid'] ?? '');

    if (empty($uid)) {
        $error = 'Informe seu UID para continuar.';
    } else {

        $url = "https://api.mihomo.me/sr_info_parsed/$uid?lang=en";

        $json = file_get_contents($url);
        $dados = json_decode($json, true);

        if (isset($dados['detail'])) {

            $error = 'Informe um UID válido.';
        } else {

            $_SESSION['uid'] = $uid;
            $_SESSION['userName'] = "Usuario $uid";

            header('Location: dashboard.php');
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="assets/style.css">

    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body>
    <?php include 'components/header.php'; ?>

    <div class="layout">

        <main class="content">
            <section class="page-content">

                <div class="total-card login-card">
                    <div class="login-card-header">
                        <h3>Acessar sistema</h3>
                        <p>Informe seu UID para iniciar</p>
                    </div>

                    <?php if (isset($error)): ?>
                        <div class="error-message">
                            <?= htmlspecialchars($error) ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" class="login-form" id="loginForm">
                        <label class="login-field" for="uid">
                            <span>UID</span>
                            <input
                                id="uid"
                                type="text"
                                name="uid"
                                placeholder="Digite seu UID"
                                value="<?= htmlspecialchars($uid ?? '') ?>" />
                        </label>

                        <button id="loginButton" class="login-button" type="submit"> Entrar </button>
                    </form>
                </div>

            </section>
        </main>
    </div>


    <script>
        document.getElementById('loginForm').addEventListener('submit', function() {

            const uid = document.getElementById('uid');

            if (!uid.value.trim()) {
                return;
            }

            const button = document.getElementById('loginButton');

            uid.readOnly = true;

            button.disabled = true;

            button.innerHTML = `
        <span class="spinner"></span>
        <span style="margin-left:8px">Entrando...</span>
    `;
        });
    </script>
</body>

</html>