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
        'href' => 'characters.php',
        'icon' => 'astroid'
    ],
    [
        'label' => 'Artefatos',
        'href' => 'relics.php',
        'icon' => 'venetian-mask'
    ],
    [
        'label' => 'Estruturas',
        'href' => 'structures.php',
        'icon' => 'landmark'
    ]
];
?>

    <aside class="sidebar">
        <nav class="side-menu">

            <?php foreach ($menuItems as $item): ?>

                <a
                    class="side-menu-item <?= activeMenu($item['href']) ?>"
                    href="<?= $item['href'] ?>"
                >

                    <i data-lucide="<?= $item['icon'] ?>"></i>

                    <span><?= $item['label'] ?></span>

                </a>

            <?php endforeach; ?>

        </nav>
    </aside>

<?php

function activeMenu(string $href): string
{
    $currentPage = basename($_SERVER['PHP_SELF']);

    if($currentPage === 'character.php' && $href === 'characters.php') {
        return 'active';
    }

    return $currentPage === $href ? 'active' : '';
}
