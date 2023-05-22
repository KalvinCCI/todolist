<dialog id="ajouter">
    <form method="POST" action ="todo.php">
        <label for="intitule">Intitulé : </label>
        <input  id="intitule" name="add[intitule]" type="text" required>
        <button type="submit">Ajouter</button>
    </form>
    <button onclick="ajouter.close()">Fermer</button>
</dialog>
