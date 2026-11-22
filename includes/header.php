<?php
$base = '/tp7-crud';
$messages = [
    'ajoute'   => ['success', 'Élément ajouté avec succès.'],
    'modifie'  => ['info',    'Élément modifié avec succès.'],
    'supprime' => ['warning', 'Élément supprimé.'],
    'lie'      => ['danger',  'Suppression impossible : des données dépendent de cet élément.'],
];

// Détermine la page active pour surligner le lien dans le menu
$uri = $_SERVER['SCRIPT_NAME'];
function actif(string $section, string $uri, string $base): string
{
    if ($section === 'accueil') {
        return $uri === $base . '/index.php' ? 'active' : '';
    }
    return str_contains($uri, "/$section/") ? 'active' : '';
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($titrePage ?? 'Centre de formation') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f4f6fb; }

        .navbar-pro {
            background: #0f2a5c;
            border-bottom: 3px solid #3b82f6;
            box-shadow: 0 2px 12px rgba(0, 0, 0, .18);
        }
        .navbar-pro .navbar-brand {
            color: #fff;
            font-weight: 700;
            letter-spacing: .5px;
        }
        .navbar-pro .navbar-brand span { color: #7db3ff; }

        .navbar-pro .nav-link {
            color: rgba(255, 255, 255, .75);
            font-weight: 500;
            padding: .9rem 1.1rem;
            border-bottom: 3px solid transparent;
            margin-bottom: -3px;
            transition: color .2s, border-color .2s, background .2s;
        }
        .navbar-pro .nav-link:hover {
            color: #fff;
            background: rgba(255, 255, 255, .07);
        }
        .navbar-pro .nav-link.active {
            color: #fff;
            border-bottom-color: #fff;
        }
        .navbar-pro .navbar-toggler { border-color: rgba(255, 255, 255, .4); }

        .carte { border: 0; border-radius: 14px; box-shadow: 0 4px 14px rgba(0, 0, 0, .08); }
    .entete-page { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
.entete-page h1 { font-size: 1.6rem; font-weight: 700; margin: 0; color: #0f2a5c; }
.entete-page p { margin: 0; color: #6b7280; }

.table-pro { margin: 0; }
.table-pro thead th {
    background: #0f2a5c; color: #fff;
    font-size: .78rem; text-transform: uppercase; letter-spacing: .6px;
    font-weight: 600; border: 0; padding: .85rem 1rem;
}
.table-pro tbody td { padding: .85rem 1rem; border-color: #eef0f5; }
.table-pro tbody tr:hover { background: #f1f6ff; }
.carte-table { border: 0; border-radius: 14px; overflow: hidden; box-shadow: 0 4px 14px rgba(0,0,0,.08); }
.pastille { display: inline-block; padding: .25rem .7rem; border-radius: 20px; font-size: .8rem; font-weight: 600; }
.pastille-bleu  { background: #dbeafe; color: #1e40af; }
.pastille-vert  { background: #dcfce7; color: #166534; }
.pastille-gris  { background: #e5e7eb; color: #374151; }

.carte-form { border: 0; border-radius: 14px; box-shadow: 0 4px 14px rgba(0,0,0,.08); max-width: 640px; }
.carte-form .form-label { font-weight: 600; font-size: .9rem; color: #0f2a5c; }
.carte-form .form-control, .carte-form .form-select { padding: .6rem .8rem; }
   </style>
</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark navbar-pro mb-4 py-0">
    <div class="container">
        <a class="navbar-brand py-3" href="<?= $base ?>/index.php">
            Centre de <span>Formation</span>
        </a>

        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse" data-bs-target="#menuPrincipal"
                aria-controls="menuPrincipal" aria-expanded="false" aria-label="Ouvrir le menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menuPrincipal">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link <?= actif('accueil', $uri, $base) ?>" href="<?= $base ?>/index.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= actif('formations', $uri, $base) ?>" href="<?= $base ?>/formations/index.php">Formations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= actif('etudiants', $uri, $base) ?>" href="<?= $base ?>/etudiants/index.php">Étudiants</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= actif('modules', $uri, $base) ?>" href="<?= $base ?>/modules/index.php">Modules</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
<?php if (isset($_GET['msg'], $messages[$_GET['msg']])): ?>
    <div class="alert alert-<?= $messages[$_GET['msg']][0] ?> shadow-sm">
        <?= $messages[$_GET['msg']][1] ?>
    </div>
<?php endif; ?>