import TemplateController from './lib/templateController';
import { accueilContent } from './components/Accueil/accueil';
import { croissantContent } from './components/Croissant/croissant';
import confetti from 'canvas-confetti';
import { postRequest } from './lib/api-request';

import './style.css';

// Initialiser la bibliothèque de confettis
function launchConfetti() {
    console.log('Confetti launched!');
    confetti({
      particleCount: 150,
      spread: 200,
      origin: { y: 0.6, z: 50 },
    });
  }

const templateController = new TemplateController('template-container');

// Charger la template "accueil" par défaut
templateController.loadTemplate('./src/components/Accueil/accueil.html.inc', accueilContent);

// Gérer la soumission du formulaire
document.addEventListener('submit', async (event) => {
  event.preventDefault();

  const form = event.target;
  if (form.id === 'accueil-form') {
    // Récupérer les données du formulaire
    const formData = new FormData(form);
    const croissanteur = formData.get("author");
    const viennoiserie = formData.get('croissantType');

    // Validation des champs
    const errorContainer = document.getElementById('form-error');
    if (!croissanteur) {
      if (errorContainer) {
        errorContainer.textContent = 'Veuillez renseigner le nom de l\'auteur.';
      }
      return;
    }
    if (!viennoiserie || viennoiserie === 'default') {
      if (errorContainer) {
        errorContainer.textContent = 'Veuillez sélectionner un type de viennoiserie.';
      }
      return;
    }

        // Envoyer le nom au backend
        try {
          await postRequest('/croissants', { croissanteur });
          console.log('Nom envoyé avec succès au backend.:' + croissanteur);
        } catch (error) {
          console.error('Erreur lors de l\'envoi du nom au backend :', error);
          return;
        }

    // Ajouter les données dynamiques au contenu croissant
    const croissantData = {
      ...croissantContent,
      author: croissanteur,
      gage: `Apportez un <span class="font-semibold text-custom-reverse">${viennoiserie}</span> à <span class="font-semibold text-custom-reverse">${croissanteur}</span> demain matin.`,
    };

    // Charger la template "croissant" avec les données
    templateController.loadTemplate('./src/components/Croissant/croissant.html.inc', croissantData).then(() => {
        // Lancer les confettis après le chargement de la template
        launchConfetti();
        // Passer en plein écran après le chargement de la template avec un délai de 1.5 secondes
        setTimeout(() => {
          const croissantSection = document.getElementById('croissant-section');
          if (croissantSection.requestFullscreen) {
            croissantSection.requestFullscreen();
          } else if (croissantSection.webkitRequestFullscreen) { // Safari
            croissantSection.webkitRequestFullscreen();
          } else if (croissantSection.msRequestFullscreen) { // IE/Edge
            croissantSection.msRequestFullscreen();
          }
        }, 1250);
  
        // Ajouter un gestionnaire pour quitter le plein écran au clic sur close.svg
        const closeButton = document.getElementById('close-button');
        closeButton.addEventListener('click', () => {
          if (document.exitFullscreen) {
            document.exitFullscreen();
          } else if (document.webkitExitFullscreen) { // Safari
            document.webkitExitFullscreen();
          } else if (document.msExitFullscreen) { // IE/Edge
            document.msExitFullscreen();
          }
        });
      });
  }
});