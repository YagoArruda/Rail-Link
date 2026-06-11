<?php

$currentPage = basename($_SERVER['PHP_SELF']);

$menuItems = [
    [
        'label' => 'Dashboard',
        'href' => 'dashboard.php',
        'icon' => 'hexagon'
    ],
    [
        'label' => 'Personagens',
        'href' => 'personagens.php',
        'icon' => 'astroid'
    ],
    [
        'label' => 'Artefatos',
        'href' => 'artefatos.php',
        'icon' => 'venetian-mask'
    ],
    [
        'label' => 'Estruturas',
        'href' => 'estruturas.php',
        'icon' => 'landmark'
    ]
];
?>

    <aside class="sidebar">
        <nav class="side-menu">

            <?php foreach ($menuItems as $item): ?>

                <a
                    class="side-menu-item <?= $currentPage === $item['href'] ? 'active' : '' ?>"
                    href="<?= $item['href'] ?>"
                >

                    <i data-lucide="<?= $item['icon'] ?>"></i>

                    <span><?= $item['label'] ?></span>

                </a>

            <?php endforeach; ?>

        </nav>
    </aside>
