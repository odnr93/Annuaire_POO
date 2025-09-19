<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Prénom</th>
        <th scope="col">Nom</th>
        <th scope="col">Actions</th> <!-- 👉 nouvelle colonne -->
    </tr>
    </thead>
    <tbody>
    <?php foreach ($les_membres as $un_membre) : ?>
        <tr>
            <th><?= htmlspecialchars($un_membre['id']) ?></th>
            <td><?= htmlspecialchars($un_membre['prenom']) ?></td>
            <td><?= htmlspecialchars($un_membre['nom']) ?></td>
            <td>
                <!-- Lien pour supprimer -->
                <a href="index.php?uc=Gerer&action=supprimer&id=<?= $un_membre['id'] ?>"
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Voulez-vous vraiment supprimer ce membre ?');">
                    Supprimer
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<ul>
    <li><a href='index.php'>Retour accueil</a></li>
</ul>
