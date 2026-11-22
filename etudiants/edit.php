<?php
require_once '../database/connexion.php';

$id = (int) ($_GET['id'] ?? 0);

$stmt = $pdo->prepare("SELECT * FROM etudiants WHERE id_etudiant = :id");
$stmt->execute(['id' => $id]);
$etudiant = $stmt->fetch();

if (!$etudiant) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare(
        "UPDATE etudiants
         SET nom = :nom, prenom = :prenom, email = :email, id_formation = :formation
         WHERE id_etudiant = :id"
    );
    $stmt->execute([
        'nom'       => trim($_POST['nom']),
        'prenom'    => trim($_POST['prenom']),
        'email'     => trim($_POST['email']),
        'formation' => (int) $_POST['id_formation'],
        'id'        => $id,
    ]);
    header('Location: index.php?msg=modifie');
    exit;
}

$formations = $pdo->query("SELECT id_formation, titre FROM formations ORDER BY titre")->fetchAll();

$titrePage = 'Modifier un étudiant';
require_once '../includes/header.php';
?>
<div class="entete-page">
    <div>
        <h1>Modifier l'étudiant</h1>
        <p>Étudiant n° <?= $id ?></p>
    </div>
</div>

<div class="card carte-form p-4">
    <form method="POST">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Nom</label>
                <input type="text" name="nom" class="form-control"
                       value="<?= htmlspecialchars($etudiant['nom']) ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Prénom</label>
                <input type="text" name="prenom" class="form-control"
                       value="<?= htmlspecialchars($etudiant['prenom']) ?>" required>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control"
                   value="<?= htmlspecialchars($etudiant['email']) ?>" required>
        </div>
        <div class="mb-4">
            <label class="form-label">Formation</label>
            <select name="id_formation" class="form-select" required>
                <?php foreach ($formations as $f): ?>
                    <option value="<?= $f['id_formation'] ?>"
                        <?= $f['id_formation'] == $etudiant['id_formation'] ? 'selected' : '' ?>>
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