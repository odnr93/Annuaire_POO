<?php
// Si on a reçu un membre (cas modification)
$isEdit = isset($unMembre);
$action = $isEdit ? "maj" : "ajouter"; // maj pour modifier, ajouter sinon
?>

<h2><?= $isEdit ? "Modifier un membre" : "Ajouter un membre" ?></h2>

<form action="index.php?uc=Gerer&action=<?= $action ?>" method="post">
    <?php if ($isEdit): ?>
        <!-- Champ caché pour envoyer l'id du membre -->
        <input type="hidden" name="id" value="<?= htmlspecialchars($unMembre['id']) ?>">
    <?php endif; ?>

    <div class="mb-3">
        <label for="nom" class="form-label">Nom</label>
        <input type="text" id="nom" name="nom" class="form-control"
               value="<?= $isEdit ? htmlspecialchars($unMembre['nom']) : '' ?>" required>
    </div>

    <div class="mb-3">
        <label for="prenom" class="form-label">Prénom</label>
        <input type="text" id="prenom" name="prenom" class="form-control"
               value="<?= $isEdit ? htmlspecialchars($unMembre['prenom']) : '' ?>" required>
    </div>

    <button type="submit" class="btn btn-primary">
        <?= $isEdit ? "Enregistrer les modifications" : "Ajouter" ?>
    </button>
</form>
