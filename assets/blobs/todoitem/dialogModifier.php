<script>
    function todoUpdate( id , intituleTexte ) {
        modifierId.value = id;
        modifierIntitule.value = intituleTexte;
        modifier.showModal();
    }
</script>
<dialog id="modifier">
    <form method="POST" action ="todo.php">
        <input id="modifierId" name="update[intitule][todoid]" type="hidden" required>
        <label for="modifierIntitule">Intitulé : </label>
        <input  id="modifierIntitule" name="update[intitule][intitule]" type="text" required>
        <button type="submit">Modifier l'intitulé</button>
    </form>
    <button onclick="modifier.close()">Fermer</button>
</dialog>
