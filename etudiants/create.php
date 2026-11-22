<?php
require_once '../database/connexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare(
        "INSERT INTO etudiants (nom, prenom, email, id_formation)
         VALUES (:nom, :prenom, :email, :formation)"
    );
    $stmt->execute([
        'nom'       => trim($_POST['nom']),
        'prenom'    => trim($_POST['prenom']),
        'email'     => trim($_POST['email']),
        'formation' => (int) $_POST['id_formation'],
    ]);
    header('Location: index.php?msg=ajoute');
    exit;
}

// Liste déroulante alimentée depuis MySQL
$formations = $pdo->query("SELECT id_formation, titre FROM formations ORDER BY titre")->fetchAll();

$titrePage = 'Ajouter un étudiant';
require_once '../includes/header.php';
?>
<div class="entete-page">
    <div>
        <h1>Ajouter un étudiant</h1>
        <p>Renseignez les informations du nouvel étudiant.</p>
    </div>
</div>

<div class="card carte-form p-4">
    <form method="POST">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Nom</label>
                <input type="text" name="nom" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Prénom</label>
                <input type="text" name="prenom" class="form-control" required>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
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