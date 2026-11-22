<?php
require_once '../database/connexion.php';

$sql = "SELECT f.*,
               (SELECT COUNT(*) FROM etudiants e WHERE e.id_formation = f.id_formation) AS nb_etudiants,
               (SELECT COUNT(*) FROM modules m   WHERE m.id_formation = f.id_formation) AS nb_modules
        FROM formations f
        ORDER BY f.id_formation";
$formations = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

$titrePage = 'Formations';
require_once '../includes/header.php';
?>
<div class="entete-page">
    <div>
        <h1>Formations</h1>
        <p><?= count($formations) ?> formation(s) au catalogue</p>
    </div>
    <a href="create.php" class="btn btn-primary px-4">Ajouter une formation</a>
</div>

<div class="card carte-table">
    <div class="table-responsive">
        <table class="table table-pro align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Durée</th>
                    <th>Niveau</th>
                    <th class="text-center">Étudiants</th>
                    <th class="text-center">Modules</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php if (empty($formations)): ?>
                <tr><td colspan="7" class="text-center text-muted py-4">Aucune formation enregistrée.</td></tr>
            <?php endif; ?>
            <?php foreach ($formations as $f): ?>
                <tr>
                    <td class="text-muted"><?= $f['id_formation'] ?></td>
                    <td class="fw-semibold"><?= htmlspecialchars($f['titre']) ?></td>
                    <td><?= $f['duree_mois'] ?> mois</td>
                    <td><span class="pastille pastille-gris"><?= htmlspecialchars($f['niveau']) ?></span></td>
                    <td class="text-center"><span class="pastille pastille-bleu"><?= $f['nb_etudiants'] ?></span></td>
                    <td class="text-center"><span class="pastille pastille-vert"><?= $f['nb_modules'] ?></span></td>
                    <td class="text-end">
                        <a href="edit.php?id=<?= $f['id_formation'] ?>" class="btn btn-sm btn-outline-primary">Modifier</a>
                        <a href="delete.php?id=<?= $f['id_formation'] ?>" class="btn btn-sm btn-outline-danger"
                           onclick="return confirm('Supprimer cette formation ?')">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once '../includes/footer.php'; ?>