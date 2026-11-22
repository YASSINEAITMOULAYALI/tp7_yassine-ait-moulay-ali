<?php
require_once 'database/connexion.php';

$nbFormations = $pdo->query("SELECT COUNT(*) FROM formations")->fetchColumn();
$nbEtudiants  = $pdo->query("SELECT COUNT(*) FROM etudiants")->fetchColumn();
$nbModules    = $pdo->query("SELECT COUNT(*) FROM modules")->fetchColumn();

$titrePage = 'Accueil';
require_once 'includes/header.php';
?>
<div class="mb-5">
    <h1 class="fw-bold">Gestion du centre de formation</h1>
    <p class="text-muted fs-5">Choisissez un espace de gestion.</p>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card carte p-4 h-100 border-top border-primary border-4">
            <p class="text-uppercase text-muted small fw-semibold mb-1">Formations</p>
            <p class="display-5 fw-bold mb-1"><?= $nbFormations ?></p>
            <p class="text-muted">formation(s) enregistrée(s)</p>
            <a href="formations/index.php" class="btn btn-primary mt-auto">Gérer les formations</a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card carte p-4 h-100 border-top border-success border-4">
            <p class="text-uppercase text-muted small fw-semibold mb-1">Étudiants</p>
            <p class="display-5 fw-bold mb-1"><?= $nbEtudiants ?></p>
            <p class="text-muted">étudiant(s) enregistré(s)</p>
            <a href="etudiants/index.php" class="btn btn-success mt-auto">Gérer les étudiants</a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card carte p-4 h-100 border-top border-warning border-4">
            <p class="text-uppercase text-muted small fw-semibold mb-1">Modules</p>
            <p class="display-5 fw-bold mb-1"><?= $nbModules ?></p>
            <p class="text-muted">module(s) enregistré(s)</p>
            <a href="modules/index.php" class="btn btn-warning mt-auto">Gérer les modules</a>
        </div>
    </div>
</div>
<?php require_once 'includes/footer.php'; ?>