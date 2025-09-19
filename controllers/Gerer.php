<?php
// controllers/Gerer.php
require_once 'models/PdoBridge.php';

class Gerer
{
    private $pdo;

    public function __construct()
    {
        // Récupère l’instance unique de connexion
        $this->pdo = PdoBridge::getPdoBridge();
    }

    // Page d’accueil
    public function accueil(): void
    {
        $message = "Ce site permet d'enregistrer les participants à une épreuve.";
        include("views/v_accueil.php");
    }

    // Affiche la liste des membres
    public function lister(): void
    {
        $les_membres = $this->pdo->getLesMembres();
        require 'views/v_listemembres.php';
    }

    // Affiche le formulaire de saisie
    public function saisir(): void
    {
        require 'views/v_saisirmembre.php';
    }

    
    public function ajouter(): void
    {
        // récupère les valeurs envoyées par le formulaire
        $nom    = isset($_POST['nom']) ? $_POST['nom'] : '';
        $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';

        // appel au modèle pour insérer (retour non vérifié ici)
        $this->pdo->insertMembre($nom, $prenom);

        // retour vers la liste après insertion
        header('Location: index.php?uc=Gerer&action=lister');
        exit;
    }


    // Affiche la page de choix d’un membre (optionnel)
    public function choisir(): void
    {
        $les_membres = $this->pdo->getLesMembres();
        require 'views/v_choisirmembre.php';
    }

    // Modifier un membre existant (optionnel)
    public function modifier(): void
    {
        $id = $_REQUEST['id'];
        $unMembre = $this->pdo->getUnMembre($id);
        $unMembre = $unMembre[0];
        require "views/v_saisirmembre.php";
    }

    public function maj(): void
    {
        // Récupération des données du formulaire
        $id     = $_POST['id'] ?? 0;
        $nom    = $_POST['nom'] ?? '';
        $prenom = $_POST['prenom'] ?? '';

        // Validation rapide
        if ($id <= 0 || $nom === '' || $prenom === '') {
            echo "Erreur : données invalides";
            return;
        }

        // Appel de la fonction updateMembre (corrigée avec requête préparée)
        $this->pdo->updateMembre($id, $nom, $prenom);

        // Redirection vers la liste après mise à jour
        header('Location: index.php?uc=Gerer&action=lister');
        exit;
    }
    
    public function supprimer(): void
    {
        // Récupération de l'id depuis l'URL
        $id = $_GET['id'] ?? 0;

        if ($id > 0) {
            $this->pdo->deleteMembre($id);
        }

        // Redirection vers la liste après suppression
        header('Location: index.php?uc=Gerer&action=lister');
        exit;
    }





    // Page d’erreur
    public function error(): void
    {
        $_SESSION["message_erreur"] = "Site en construction";
        include("views/404.php");
    }
}
