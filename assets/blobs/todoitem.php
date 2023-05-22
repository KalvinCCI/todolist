<!-- To Do Item - START -->
<div class="todoitem <?= $todoitem['etat_valide']?'valide':'a_faire' ?>">
    <h2><strong><?= $todoitem['intitule'] ?></strong></h2>
    <form method="POST" action="todo.php"><input type="hidden" name="update[todoid]" value="<?= $todoitem['id'] ?>"><button class="switch" type="submit" title="Mettre a jour l'état"><span>Changer d'état</span></button></form>
    <footer>
        <p><time datetime="<?= $todoitem['date_creation'] ?>">Créé à <?= date_format(new DateTime($todoitem['date_creation']), 'G\hi \l\e d/m/o')?></time></p>
        <div>
            <form method="POST" action="todo.php"><input type="hidden" name="delete[todoid]" value="<?= $todoitem['id'] ?>"><button type="submit" title="Supprimer">Supprimer</button></form>
        </div>
    </footer>
</div>
<hr>
<!-- To Do Item - END -->
