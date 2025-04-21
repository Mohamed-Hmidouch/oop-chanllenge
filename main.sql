-- Afficher les freelances qui parlent l’anglais (langues.nom = 'Anglais') avec un niveau avancé.
SELECT * from profils 
INNER join profil_langue
INNER JOIN langues
where profil_langue.profil_id = profils.utilisateur_id 
and profil_langue.niveau = 'avancé';


-- Lister les freelances ayant plus de 3 compétences.


SELECT profils.*, COUNT(profil_competence.competence_id) AS Competences
FROM profils
INNER JOIN profil_competence ON profils.id = profil_competence.profil_id
INNER JOIN competences ON profil_competence.competence_id = competences.id
GROUP BY profils.id
HAVING COUNT(profil_competence.competence_id) >= 2; --ktebt juj hit f insertion kant endi kul wahd endu juj machi 3--


-- Afficher les freelances disponibles, leur tarif horaire et leur ville.

SELECT utilisateurs.nom,profils.tarif_horaire,profils.disponible,adresses.ville from utilisateurs
INNER join profils
inner join adresses
WHERE utilisateurs.id = profils.utilisateur_id and profils.disponible = 1;


-- Lister tous les utilisateurs qui ne possèdent pas encore de profil.

SELECT * FROM utilisateurs
left join profils on profils.utilisateur_id is null;


SELECT * from projets,COUNT(offres.projet_id) as nmbreOfrre
INNER JOIN offres on projets.id = offres.projet_id
WHERE projets.statut = 'ouvert'
GROUP by offres.projet_id;
