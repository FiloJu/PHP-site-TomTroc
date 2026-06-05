<?php

/**
 * Classe utilitaire : cette classe ne contient que des méthodes statiques qui peuvent être appelées
 * directement sans avoir besoin d'instancier un objet Utils.
 * Exemple : Utils::redirect('home'); 
 */
class Utils
{
    // redirection vers une URL 
    public static function redirect(string $action): void
    {
        header("Location: index.php?action=$action");
        exit();
    }
    //Vérifiez si l'utilisateur est connecté , utile pour protéger les pages " Mon compte"
    public static function isUserConnected(): bool
    {
        //vérification si la variable 'user_id' existe dans la session
        return isset($_SESSION['user_id']);
    }

    //date avec calcul ancienneté (1mois, 6jours, ...)
    public static function format(?string $dateString): string
    {
        //si pas de date
        if ($dateString === null) {
            return "";
        }
        $date = new DateTime($dateString);
        $now = new datetime();
        //calcul de la diff
        $interval = $now->diff($date);
        if ($interval->y >= 1) {
            //si plus d'1 an on affiche les années
            return $interval->y . 'an' . ($interval->y < 1 ? 's' : '');
        } elseif ($interval->m >= 1) {
            return $interval->m . 'mois';
        } else {
            return "moins d'1 mois";
        }
    }
}