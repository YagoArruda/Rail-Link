<?php

session_start();

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

header('Content-Type: application/json');

$uid = $_SESSION['uid'];

try {
    $pdo = new PDO(
        "mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_DATABASE']};charset=utf8mb4",
        $_ENV['DB_USER'],
        $_ENV['DB_PASSWORD']
    );

    $sql = "
SELECT *
FROM rail_character
WHERE character_id = :id
ORDER BY character_id DESC
";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $_GET['id']]);

    $characters = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($characters);
} catch (PDOException $e) {

    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
