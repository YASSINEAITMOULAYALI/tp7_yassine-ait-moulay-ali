<?php
require_once '../database/connexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare(
        "INSERT INTO modules (intitule, volume_horaire, id_formation)
         VALUES (:intitule, :volume, :formation)"
    );
    $stmt->execute([
        'intitule'  => trim($_POST['intitule']),
        'volume'    => (int) $_POST['volume_horaire'],
        'formation' => (int) $_POST['id_formation'],
    ]);
    header('Location: index.php?msg=ajoute');
    exit;
}

$formations = $pdo->query("SELECT id_formation, titre FROM formations ORDER BY titre")->fetchAll();

$titrePage = 'Ajouter un module';
require_once '../includes/header.php';
?>
<div class="entete-page">
    <div>
        <h1>Ajouter un module</h1>
        <p>Renseignez les informations du nouveau module.</p>
    </div>
</div>

<div class="card carte-form p-4">
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Intitulé</label>
            <input type="text" name="intitule" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Volume horaire (en heures)</label>
            <input type="number" name="volume_horaire" class="form-control" min="1" required>
        </div>
        <div class="mb-4">
            <label class="form-label">Formation</label>
            <select name="id_formation" class="form-select" required>
                <option value="">Choisir une formation</option>
                <?php foreach ($formations as $f): ?>
                    <option value="<?= $f['id_formation'] ?>"><?= htmlspecialchars($f['titre']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary px-4">Enregistrer</button>
        <a href="index.php" class="btn btn-outline-secondary px-4">Annuler</a>
    </form>
</div>
<?php require_once '../includes/footer.php'; ?>