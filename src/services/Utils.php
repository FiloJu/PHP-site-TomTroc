<?php
namespace Services;

use DateTime;
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
    public static function format($date): string
    {
        if ($date === null) {
            return "";
        }

        if ($date instanceof DateTime) {
            $dateTime = $date;
        } else {
            $dateTime = new DateTime($date);
        }

        $now = new DateTime();
        $interval = $now->diff($dateTime);

        if ($interval->y >= 1) {
            return $interval->y . ' an' . ($interval->y > 1 ? 's' : '');
        } elseif ($interval->m >= 1) {
            return $interval->m . ' mois';
        }

        return "moins d'1 mois";
    }

    public static function trim ($string): string
    {
        if(!empty($string)) {
            return trim($string);
        }
        return "";
    }
}