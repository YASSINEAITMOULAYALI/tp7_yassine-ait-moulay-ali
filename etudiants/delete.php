<?php
require_once '../database/connexion.php';

$id = (int) ($_GET['id'] ?? 0);

try {
    $stmt = $pdo->prepare("DELETE FROM etudiants WHERE id_etudiant = :id");
    $stmt->execute(['id' => $id]);
    header('Location: index.php?msg=supprime');
} catch (PDOException $e) {
    header('Location: index.php?msg=lie');
}
exit;