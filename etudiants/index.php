<?php
require_once '../database/connexion.php';

$sql = "SELECT e.id_etudiant, e.nom, e.prenom, e.email, f.titre AS formation
        FROM etudiants e
        INNER JOIN formations f ON e.id_formation = f.id_formation
        ORDER BY e.nom, e.prenom";
$etudiants = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

$titrePage = 'Étudiants';
require_once '../includes/header.php';
?>
<div class="entete-page">
    <div>
        <h1>Étudiants</h1>
        <p><?= count($etudiants) ?> étudiant(s) inscrit(s)</p>
    </div>
    <a href="create.php" class="btn btn-primary px-4">Ajouter un étudiant</a>
</div>

<div class="card carte-table">
    <div class="table-responsive">
        <table class="table table-pro align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Formation</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php if (empty($etudiants)): ?>
                <tr><td colspan="6" class="text-center text-muted py-4">Aucun étudiant enregistré.</td></tr>
            <?php endif; ?>
            <?php foreach ($etudiants as $e): ?>
                <tr>
                    <td class="text-muted"><?= $e['id_etudiant'] ?></td>
                    <td class="fw-semibold"><?= htmlspecialchars($e['nom']) ?></td>
                    <td><?= htmlspecialchars($e['prenom']) ?></td>
                    <td class="text-muted"><?= htmlspecialchars($e['email']) ?></td>
                    <td><span class="pastille pastille-bleu"><?= htmlspecialchars($e['formation']) ?></span></td>
                    <td class="text-end">
                        <a href="edit.php?id=<?= $e['id_etudiant'] ?>" class="btn btn-sm btn-outline-primary">Modifier</a>
                        <a href="delete.php?id=<?= $e['id_etudiant'] ?>" class="btn btn-sm btn-outline-danger"
                           onclick="return confirm('Supprimer cet étudiant ?')">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once '../includes/footer.php'; ?>