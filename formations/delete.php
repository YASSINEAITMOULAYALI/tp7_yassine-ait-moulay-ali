<?php
require_once '../database/connexion.php';

$id = (int) ($_GET['id'] ?? 0);

try {
    $stmt = $pdo->prepare("DELETE FROM formations WHERE id_formation = :id");
    $stmt->execute(['id' => $id]);
    header('Location: index.php?msg=supprime');
} catch (PDOException $e) {
    // Clé étrangère : la formation a encore des étudiants ou des modules
    header('Location: index.php?msg=lie');
}
exit;