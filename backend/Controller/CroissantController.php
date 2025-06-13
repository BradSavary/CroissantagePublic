<?php

require_once "Controller.php";
require_once "Repository/CroissantRepository.php";

class CroissantController extends Controller{

    private CroissantRepositery $croissants;

    public function __construct() {
        $this->croissants = new CroissantRepositery();
    }

    private function sendEmailNotification($croissanteur, $imprudent, $date) {
        $to = "informatique@chimb.fr";
        $subject = "Nouveau croissantage : $croissanteur";
        
        // Créer le message HTML
        $htmlMessage = "
            <html>
            <head>
            <style>body {font-family: Arial, sans-serif; background-color: #f9f9f9; color: #333;} .email-container {max-width: 600px; margin: 20px auto; background: #fff; border: 1px solid #ddd; border-radius: 8px;} .email-header {background: #377E9A; color: #fff; padding: 15px; text-align: center;} .email-body {padding: 15px;} .email-footer {background: #f1f1f1; text-align: center; padding: 10px; font-size: 12px;}</style>
            </head>
            <body>
            <div class='email-container'>
                <div class='email-header'>
                <h1>Nouveau Croissantage !</h1>
                </div>
                <div class='email-body'>
                <p><strong>Croissanteur :</strong> $croissanteur</p>
                <p><strong>Imprudent :</strong> $imprudent</p>
                <p><strong>Date :</strong> $date</p>
                </div>
                <div class='email-footer'>
                <p>Merci de faire partie de notre communauté de croissantage !</p>
                </div>
            </div>
            </body>
            </html>
        ";
        
        // Écrire le HTML dans un fichier temporaire
        $tmpFile = tempnam(sys_get_temp_dir(), 'mail_');
        file_put_contents($tmpFile, $htmlMessage);
        
        // Exécuter la commande mail avec l'en-tête Content-Type
        $command = "cat " . escapeshellarg($tmpFile) . " | mail -a 'Content-Type: text/html; charset=UTF-8' -s " . escapeshellarg($subject) . " " . escapeshellarg($to);
        $result = shell_exec($command);
        
        // Nettoyer
        @unlink($tmpFile);
        
        error_log("Email HTML envoyé via commande mail à $to");
        
        return true;
    }

    protected function processPostRequest(HttpRequest $request) {
        try {
            //Définir le fuseau horaire
            date_default_timezone_set('Europe/Paris');

            // Récupérer les données JSON envoyées par le frontend
            $data = json_decode($request->getJson(), true);
            
            // Vérifier si le champ "croissanteur" est présent
            $croissanteur = $data['croissanteur'] ?? null;
            // Récupérer le nom de l'hôte comme valeur pour "imprudent"
            $imprudent = $_SERVER['REMOTE_ADDR'];;
    
            // Ajouter une date actuelle
            $date = date('Y-m-d H:i:s');
    
            if ($croissanteur) {
                // Appeler la méthode addCroissant du repository
                $this->croissants->addCroissant($croissanteur, $imprudent, $date);

                //Envoyer un email de notification
                $this->sendEmailNotification($croissanteur, $imprudent, $date);

                return ['message' => 'Croissant ajouté avec succès.'];
            } else {
                throw new Exception("Le champ 'croissanteur' est requis.");
            }
        } catch (Exception $e) {
            // En cas d'erreur, retourner une réponse avec le message d'erreur
            http_response_code(500);
            return ['error' => $e->getMessage()];
        }
    }

}

