# CHIMB Croissantage

Bienvenue sur **CHIMB Croissantage**, un site interactif conçu pour promouvoir les bonnes pratiques en matière de sécurité informatique tout en ajoutant une touche ludique à votre quotidien. Ce site permet de "croissanter" vos collègues en leur attribuant un gage amusant et éducatif.

---

## Fonctionnalités principales

### Pour les utilisateurs :
 **Croissanter un collègue** :
   - Remplissez le formulaire avec votre nom et choisissez une viennoiserie.
   - Cliquez sur le bouton **Croissanter** pour générer un gage amusant.
   - Le site passe en plein écran pour afficher le gage.
   - Une notification par email est automatiquement envoyée au service informatique.

---

### Pour les administrateurs :
1. **Modifier le contenu du site** :
   - Les textes, images et options du formulaire sont centralisés dans des fichiers JavaScript pour une gestion facile :
     - **Accueil** : [`src/components/Accueil/accueil.js`](src/components/Accueil/accueil.js)
     - **Croissant** : [`src/components/Croissant/croissant.js`](src/components/Croissant/croissant.js)

2. **Ajouter ou modifier les options du formulaire** :
   - Les options du formulaire sont définies dans le tableau `formOptions` dans [`accueil.js`](src/components/Accueil/accueil.js).
   - Exemple :
     ```javascript
     formOptions: [
       "Croissant",
       "Pain au chocolat",
       "Chocolatine",
       "Pain aux raisins",
       "Éclair au chocolat",
       "Éclair au café",
       "A définir avec le croissanteur",
     ],
     ```
   - Ajoutez ou modifiez les options directement dans ce tableau.

3. **Modifier les textes et images** :
   - Les images du site sont éditables de la même façon que le texte. Cependant, notez que pour ajouter une image, il ne faut que écrire le nom de l'image et non pas le chemin en plus.
   - Exemple: 👍 "chimb-logo.jpg" | 👎 "../../public/chimb-logo.jpg"

4. **Modifier les templates HTML** :
   - Les templates HTML sont situés dans :
     - [`src/components/Accueil/accueil.html.inc`](src/components/Accueil/accueil.html.inc)
     - [`src/components/Croissant/croissant.html.inc`](src/components/Croissant/croissant.html.inc)
   - Les placeholders dynamiques (`{{variable}}`) sont remplacés automatiquement par les données définies dans les fichiers JavaScript.

5. **Configurer l'API et le backend** :
   - L'URL de l'API est configurable dans [`src/lib/api-request.js`](src/lib/api-request.js).
   - Le backend est développé en PHP et utilise une architecture MVC simple.
   - La base de données est configurée dans [`backend/Repository/EntityRepository.php`](backend/Repository/EntityRepository.php).

6. **Système de notification par email** :
   - Chaque croissantage déclenche l'envoi automatique d'un email au service informatique.
   - Le template de l'email est personnalisable dans [`backend/Controller/CroissantController.php`](backend/Controller/CroissantController.php).
   - Le système utilise la commande `mail` native du serveur pour un envoi fiable des emails.

7. **Déploiement** :
   - Pour le déploiement en production, activez la base URL dans [`vite.config.js`](vite.config.js) en décommentant : 
     ```javascript
     base: '/croissantage',
     ```
   - Assurez-vous que les fichiers `.htaccess` sont correctement configurés.

---

## Technologies utilisées

- **Frontend** :
  - **Vite** : Pour le développement rapide et la gestion des modules.
  - **Tailwind CSS** : Pour un style moderne et personnalisable.
  - **JavaScript** : Pour la gestion dynamique des templates et du contenu.
  - **Canvas Confetti** : Pour les animations festives.

- **Backend** :
  - **PHP** : Pour le traitement des données côté serveur.
  - **MySQL** : Pour le stockage des données de croissantage.
  - **Architecture MVC** : Pour une organisation claire du code.

---

## Installation et déploiement

1. **Cloner le dépôt** :
   ```bash
   git clone https://github.com/BradSavary/croissantage.git
   cd croissantage
