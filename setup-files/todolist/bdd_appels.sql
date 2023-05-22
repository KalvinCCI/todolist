/* REquetes preparees pour de le php */
/*** Requetes utilisateurs ***/

/* Verification mot de passe connexion */
SELECT id FROM utilisateurs WHERE identifiant = :identifiant AND motDePasse = :motDePasse;
SELECT id, motDePasse FROM utilisateurs WHERE identifiant = :identifiant;

/* Information affichage */
SELECT identifiant, pseudonyme FROM utilisateurs WHERE id = :id;
/* Si pseudonyme == null : pseudonyme = identifiant*/

/* Information modification profil */
SELECT identifiant, courriel, pseudonyme FROM utilisateurs WHERE id = :id_util;

/* Creation compte */
INSERT INTO utilisateurs (identifiant, motDePasse, courriel, pseydonyme) VALUES (:identifiant, :motDePasse, :courriel, :pseudonyme);

/* Mise a jour informations */
UPDATE utilisateurs SET identifiant = :newIdentifiant WHERE id = :id_util AND motDePasse = :motDePasse;
UPDATE utilisateurs SET motDePasse = :newMotDePasse WHERE id = :id_util AND motDePasse = :motDePasse;
UPDATE utilisateurs SET courriel = :newCourriel WHERE id = :id_util AND motDePasse = :motDePasse;
UPDATE utilisateurs SET pseudonyme = :pseudonyme WHERE id = :id_util AND motDePasse = :motDePasse;

/* Suppresion compte */
DELETE FROM utilisateurs WHERE id = :id_util AND utilisateurs = :utilisateurs AND motDePasse = :motDePasse;


/*** Requetes liste_items ***/

/* Affichage 5 derniers liste_item */
SELECT id, intitule, etat_valide, date_creation FROM liste_items WHERE id_utilisateur = :id_util ORDER BY date_creation DESC LIMIT 5;

/* Ajout un liste_item */
INSERT INTO liste_items (id_utilisateur, intitule) VALUES (:id_util, :intitule);

/* Suppr un liste_item*/
DELETE FROM liste_items WHERE id = :id_item AND id_utilisateur = :id_util;

/* Update un liste_item */
UPDATE liste_items SET intitule = :intitule WHERE id = :id_item AND id_utilisateur = :id_util;
UPDATE liste_items SET etat_valide = :etat_valide WHERE id = :id_item AND id_utilisateur = :id_util;

