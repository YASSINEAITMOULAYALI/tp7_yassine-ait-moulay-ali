<?php
require_once '../database/connexion.php';

$id = (int) ($_GET['id'] ?? 0);

$stmt = $pdo->prepare("SELECT * FROM formations WHERE id_formation = :id");
$stmt->execute(['id' => $id]);
$formation = $stmt->fetch();

if (!$formation) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare(
        "UPDATE formations
         SET titre = :titre, duree_mois = :duree, niveau = :niveau
         WHERE id_formation = :id"
    );
    $stmt->execute([
        'titre'  => trim($_POST['titre']),
        'duree'  => (int) $_POST['duree_mois'],
        'niveau' => $_POST['niveau'],
        'id'     => $id,
    ]);
    header('Location: index.php?msg=modifie');
    exit;
}

$titrePage = 'Modifier une formation';
require_once '../includes/header.php';
?>
<div class="entete-page">
    <div>
        <h1>Modifier la formation</h1>
        <p>Formation n° <?= $id ?></p>
    </div>
</div>

<div class="card carte-form p-4">
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Titre</label>
            <input type="text" name="titre" class="form-control"
                   value="<?= htmlspecialchars($formation['titre']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Durée (en mois)</label>
            <input type="number" name="duree_mois" class="form-control" min="1"
                   value="<?= $formation['duree_mois'] ?>" required>
        </div>
        <div class="mb-4">
            <label class="form-label">Niveau</label>
            <select name="niveau" class="form-select" required>
                <?php foreach (['Licence', 'Master', 'Certificat'] as $n): ?>
                    <option value="<?= $n ?>" <?= $formation['niveau'] === $n ? 'selected' : '' ?>><?= $n ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary px-4">Mettre à jour</button>
        <a href="index.php" class="btn btn-outline-secondary px-4">Annuler</a>
    </form>
</div>
<?php require_once '../includes/footer.php'; ?>