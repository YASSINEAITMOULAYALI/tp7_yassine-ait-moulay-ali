<?php
require_once '../database/connexion.php';

$id = (int) ($_GET['id'] ?? 0);

$stmt = $pdo->prepare("SELECT * FROM modules WHERE id_module = :id");
$stmt->execute(['id' => $id]);
$module = $stmt->fetch();

if (!$module) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare(
        "UPDATE modules
         SET intitule = :intitule, volume_horaire = :volume, id_formation = :formation
         WHERE id_module = :id"
    );
    $stmt->execute([
        'intitule'  => trim($_POST['intitule']),
        'volume'    => (int) $_POST['volume_horaire'],
        'formation' => (int) $_POST['id_formation'],
        'id'        => $id,
    ]);
    header('Location: index.php?msg=modifie');
    exit;
}

$formations = $pdo->query("SELECT id_formation, titre FROM formations ORDER BY titre")->fetchAll();

$titrePage = 'Modifier un module';
require_once '../includes/header.php';
?>
<div class="entete-page">
    <div>
        <h1>Modifier le module</h1>
        <p>Module n° <?= $id ?></p>
    </div>
</div>

<div class="card carte-form p-4">
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Intitulé</label>
            <input type="text" name="intitule" class="form-control"
                   value="<?= htmlspecialchars($module['intitule']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Volume horaire (en heures)</label>
            <input type="number" name="volume_horaire" class="form-control" min="1"
                   value="<?= $module['volume_horaire'] ?>" required>
        </div>
        <div class="mb-4">
            <label class="form-label">Formation</label>
            <select name="id_formation" class="form-select" required>
                <?php foreach ($formations as $f): ?>
                    <option value="<?= $f['id_formation'] ?>"
                        <?= $f['id_formation'] == $module['id_formation'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($f['titre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary px-4">Mettre à jour</button>
        <a href="index.php" class="btn btn-outline-secondary px-4">Annuler</a>
    </form>
</div>
<?php require_once '../includes/footer.php'; ?>