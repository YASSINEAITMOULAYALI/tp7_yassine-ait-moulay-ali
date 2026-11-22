<?php
require_once '../database/connexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare(
        "INSERT INTO formations (titre, duree_mois, niveau)
         VALUES (:titre, :duree, :niveau)"
    );
    $stmt->execute([
        'titre'  => trim($_POST['titre']),
        'duree'  => (int) $_POST['duree_mois'],
        'niveau' => $_POST['niveau'],
    ]);
    header('Location: index.php?msg=ajoute');
    exit;
}

$titrePage = 'Ajouter une formation';
require_once '../includes/header.php';
?>
<div class="entete-page">
    <div>
        <h1>Ajouter une formation</h1>
        <p>Renseignez les informations de la nouvelle formation.</p>
    </div>
</div>

<div class="card carte-form p-4">
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Titre</label>
            <input type="text" name="titre" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Durée (en mois)</label>
            <input type="number" name="duree_mois" class="form-control" min="1" required>
        </div>
        <div class="mb-4">
            <label class="form-label">Niveau</label>
            <select name="niveau" class="form-select" required>
                <option value="Licence">Licence</option>
                <option value="Master">Master</option>
                <option value="Certificat">Certificat</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary px-4">Enregistrer</button>
        <a href="index.php" class="btn btn-outline-secondary px-4">Annuler</a>
    </form>
</div>
<?php require_once '../includes/footer.php'; ?>