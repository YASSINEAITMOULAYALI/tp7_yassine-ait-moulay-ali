<?php
require_once '../database/connexion.php';

$sql = "SELECT m.id_module, m.intitule, m.volume_horaire, f.titre AS formation
        FROM modules m
        INNER JOIN formations f ON m.id_formation = f.id_formation
        ORDER BY f.titre, m.intitule";
$modules = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

$titrePage = 'Modules';
require_once '../includes/header.php';
?>
<div class="entete-page">
    <div>
        <h1>Modules</h1>
        <p><?= count($modules) ?> module(s) enregistré(s)</p>
    </div>
    <a href="create.php" class="btn btn-primary px-4">Ajouter un module</a>
</div>

<div class="card carte-table">
    <div class="table-responsive">
        <table class="table table-pro align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Intitulé</th>
                    <th>Volume horaire</th>
                    <th>Formation</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php if (empty($modules)): ?>
                <tr><td colspan="5" class="text-center text-muted py-4">Aucun module enregistré.</td></tr>
            <?php endif; ?>
            <?php foreach ($modules as $m): ?>
                <tr>
                    <td class="text-muted"><?= $m['id_module'] ?></td>
                    <td class="fw-semibold"><?= htmlspecialchars($m['intitule']) ?></td>
                    <td><?= $m['volume_horaire'] ?> h</td>
                    <td><span class="pastille pastille-bleu"><?= htmlspecialchars($m['formation']) ?></span></td>
                    <td class="text-end">
                        <a href="edit.php?id=<?= $m['id_module'] ?>" class="btn btn-sm btn-outline-primary">Modifier</a>
                        <a href="delete.php?id=<?= $m['id_module'] ?>" class="btn btn-sm btn-outline-danger"
                           onclick="return confirm('Supprimer ce module ?')">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once '../includes/footer.php'; ?>