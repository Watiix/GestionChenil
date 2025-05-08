<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Liste des animaux</h2>
        <a href="/animal-form" class="btn btn-success" style="background-color: rgb(55, 118, 173); color: white;">Ajouter un animal</a>
    </div>
    <?php $utilisateur = $_SESSION['user'] ?? null; ?>
    <?php if (empty($animaux)): ?>
        <div class="alert alert-warning">Aucun animal trouvé.</div>
    <?php else: ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
            <?php foreach ($animaux as $animal): ?>
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body p-3 position-relative">
                            <!-- Icône Modifier en haut à droite -->
                            <a href="/animal-edit/<?= $animal['IdAnimal'] ?>" class="position-absolute top-0 end-0 m-2 text-primary" title="Modifier">
                                <i class="bi bi-pencil-square fs-5"></i>
                            </a>

                            <h5 class="card-title"><?= htmlspecialchars($animal['NomAnimal'] ?? 'N/A') ?></h5>
                            <p class="card-text mb-1"><strong>Race :</strong> <?= htmlspecialchars($animal['Race'] ?? 'N/A') ?></p>
                            <p class="card-text mb-1"><strong>Âge :</strong> <?= htmlspecialchars($animal['Age'] ?? 'N/A') ?> ans</p>
                            <p class="card-text mb-1"><strong>Sexe :</strong> <?= htmlspecialchars($animal['Sexe'] ?? 'N/A') ?></p>
                            <p class="card-text mb-1"><strong>Poids :</strong> <?= htmlspecialchars($animal['Poids'] ?? 'N/A') ?> kg</p>
                            <p class="card-text mb-1"><strong>Taille :</strong> <?= htmlspecialchars($animal['Taille'] ?? 'N/A') ?> cm</p>
                            <p class="card-text mb-1"><strong>Alimentation :</strong> <?= htmlspecialchars($animal['Alimentation'] ?? 'N/A') ?></p>
                            <hr class="my-2">
                                <?php if ($utilisateur && $utilisateur['IdUtilisateur'] != $animal['IdProprietaire']): ?>
                                    <p class="card-text"><strong>Propriétaire :</strong>
                                    <?= htmlspecialchars($animal['NomProprietaire'] ?? '') . ' ' . htmlspecialchars($animal['PrenomProprietaire'] ?? '') ?>
                                <?php endif; ?>
                            </p>
                        </div>

                        <div class="card-footer bg-white text-center">
                            <a href="/animal-delete/<?= $animal['IdAnimal'] ?>" class="btn btn-danger w-100" onclick="return confirm('Supprimer cet animal ?')">
                                Supprimer
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($_SESSION['form_succes'])): ?>
        <div class="alert alert-success mt-4">
            <?= htmlspecialchars($_SESSION['form_succes']) ?>
        </div>
        <?php unset($_SESSION['form_succes']); ?>
    <?php endif; ?>
</div>
