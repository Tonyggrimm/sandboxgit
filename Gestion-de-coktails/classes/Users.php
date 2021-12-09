<?php
session_start();

class Users {

    //Déclaration des propriétés d'un objet Utilisateur
    private $login="";
    private $mdp="";
    private $nom="";
    private $prenom="";
    private $sexe="";
    private $email="";
    private $naissance="";
    private $nomAdresse="";
    private $codePostal="";
    private $ville="";
    private $telephone="";
    private $ancienMdp="";
    private $errors=[];
    private $erreursEnregistrement=[];
    private $users=[];

    public function __construct() {

        //Chargement des données lors de l'appel de la création de l'objet
        $this->loadData();
        
    }

    public function loadData() {
            //Récupération des données apres réception par la méthode POST
            $this->login = trim($_POST['login']);
            $this->mdp = trim($_POST['mdp']);

            //Test de l'existence des données avant récupération et affectation dans les propriétés de la classe en cas d'existence 
            if(isset($_POST['nom'])) {
                $this->nom = trim($_POST['nom']);
            }
            if(isset($_POST['prenom'])) {
                $this->prenom = trim($_POST['prenom']);
            }
            if(isset($_POST['sexe'])) {
                $this->sexe = trim($_POST['sexe']);
            }
            if(isset($_POST['email'])) {
                $this->email = trim($_POST['email']);
            }
            if(isset($_POST['naissance'])) {
                $this->naissance = trim($_POST['naissance']);
            }
            if(isset($_POST['nomAdresse'])) {
                $this->nomAdresse = trim($_POST['nomAdresse']);
            }
            if(isset($_POST['codePostal'])) {
                $this->codePostal = trim($_POST['codePostal']);
            }
            if(isset($_POST['ville'])) {
                $this->ville = trim($_POST['ville']);
            }
            if(isset($_POST['telephone'])) {
                $this->telephone = trim($_POST['telephone']);
            }
            if(isset($_POST['ancienMdp'])) {
                $this->ancienMdp = trim($_POST['ancienMdp']);
            }

            if($this->users = unserialize(file_get_contents("users.txt"))) {

            } else {
                $this->users = [];
            }
            
            //Création des variables de session pour stockage de ces données afin de les rendre accessible partout pour faciliter le remplissage des formulaires
            $_SESSION['prenom'] = $this->prenom;
            $_SESSION['login'] = $this->login;
            $_SESSION['nom'] = $this->nom;
            $_SESSION['sexe'] = $this->sexe;
            $_SESSION['email'] = $this->email;
            $_SESSION['naissance'] = $this->naissance;
            $_SESSION['nomAdresse'] = $this->nomAdresse;
            $_SESSION['codePostal'] = $this->codePostal;
            $_SESSION['ville'] = $this->ville;
            $_SESSION['telephone'] = $this->telephone;
    }

    /**
     * Vérifie chaque donnée envoyer par l'utilisateur
     * @return false et stocke les erreurs dans la propriétés "erreurs" s'il y a des erreurs 
     */
    public function verifDonnees() {
        //Verification du login
        if(preg_match("/[^A-Za-z0-9]/", $this->login)) {
            array_push($this->errors, "Le login ne doit que contenir des lettres non accentués et des chiffres");
        }

        //Verification du nom
        if($this->nom != "") {
            if(preg_match("/[^A-Za-z0-9- ']/", $this->nom)) {
                array_push($this->errors, "Le nom ne peut contenir que des majuscules et/ou minuscules et les charactères - espace et '");
            }
        }

        //Verification du prenom
        if($this->prenom != "") {
            if(preg_match("/[^A-Za-z0-9- ']/", $this->prenom)) {
                array_push($this->errors, "Le prenom ne peut contenir que des majuscules et/ou minuscules et les charactères - espace et '");
            }
        }

        // Verification du numero de téléphone
        if($this->telephone != "") {
            if(strlen($this->telephone) != 10) {
                array_push($this->errors, "Le numéro de telephone doit commencer par 0 et doit etre suivi de 9 chiffres");
                
            } else if(!preg_match("/0[0-9]{9}/", $this->telephone)) {
                array_push($this->errors, "Le numéro de telephone doit commencer par 0 et doit etre suivi de 9 chiffres");
            }
        }

        //Verification de la date de naissance
        if($this->naissance != "") {
            $parsedDate = date_parse($this->naissance);
            if(!$parsedDate['year'] || !$parsedDate['month'] || !$parsedDate['day']) {
                array_push($this->errors, "La date entrée n'est pas valide. Veillez rentrer la date au format AAAA/MM/JJ");
            } else {
                $dateDiff = (array)date_diff(date_create_from_format('Y-m-d', $parsedDate['year'].'-'.$parsedDate['month'].'-'.$parsedDate['day']), date_create_from_format('Y-m-d', date('Y-m-d')));
                if($dateDiff['y'] < 18) {
                    array_push($this->errors, "Vous devez avoir plus de 18 ans pour avoir accès à ce site");
                }
            }

        }

        //Verification s'il y a des erreurs, on retourne false
        if(count($this->errors) > 0) {
            return false;
        }
        //S'il n'y a pas d'erreur, on retourne true
        return true;
    }

    /**
     * Permet d'enregistrer un nouvel utilisateur si toutes les données ont étés entrées correctement
     * @param successRedirectionPage Page de redirection en cas de succès de création de compte
     * @param failureRedirectionPage Page de redirection en cas d'échec de création de compte
     * @return bool true si tout s'est bien passé et false sinon
     */
    public function register($successRedirectionPage, $failureRedirectionPage) {
        //Vérification des données
        if($this->verifDonnees()) {
            //Si les données fournies sont valides d'après nos critères de vérification, on teste si l'utlisateur existe déjà. Dans ce cas, il n'est plus nécessaire de le créer.
            foreach($this->users as $user) {
                if ($user['login'] == $this->login) {
                    // L'utilisateur est existant. Redirection vers la page de connection avec message d'erreur: Utilisateur existant.
                    $error = "L'utilisateur est existant, veillez vous <a href=\"index.php?p=login\">connecter</a>";
                    echo "<br/> ".$error;
                    array_push($this->erreursEnregistrement, $error);
                    $error = $this->displayErrors($this->erreursEnregistrement);
                    header('Location: '.$failureRedirectionPage.'&error='.$error.'');
                    return false;
                }
            }
            //Construction du nouvel utilisateur
            $user = array(
                "login" => $this->login,
                "mdp" => $this->mdp,
                "nom" => $this->nom,
                "prenom" => $this->prenom,
                "sexe" => $this->sexe,
                "email" => $this->email,
                "naissance" => $this->naissance,
                "nomAdresse" => $this->nomAdresse,
                "codePostal" => $this->codePostal,
                "ville" => $this->ville,
                "telephone" => $this->telephone
            );
            //Ajout du nouvel utilisateur dans la liste des utilisateurs
            array_push($this->users, $user);
            //Enregistrement du nouvel utilisateur dans le fichier des utilisateurs pour stockage permanent
            file_put_contents("users.txt", serialize($this->users));
            $error = "Bonjour ".$this->prenom.", votre compte a bien été créé. Vous avez été redirigé vers la page d'acceuil";
            echo "<br/> ".$error;
            array_push($this->erreursEnregistrement, $error);
            $error = $this->displayErrors($this->erreursEnregistrement);
            $_SESSION['isLogin'] = true;
            $_SESSION['prenom'] = $this->prenom;
            $_SESSION['login'] = $this->login;
            $_SESSION['nom'] = $this->nom;
            $_SESSION['sexe'] = $this->sexe;
            $_SESSION['email'] = $this->email;
            $_SESSION['naissance'] = $this->naissance;
            $_SESSION['nomAdresse'] = $this->nomAdresse;
            $_SESSION['codePostal'] = $this->codePostal;
            $_SESSION['ville'] = $this->ville;
            $_SESSION['telephone'] = $this->telephone;
            header('Location: '.$successRedirectionPage.'&error='.$error.'');
            return true;
        }
        //Au cas où il y a des erreurs dans les données fournies, signalisation à l'utilisateur
        $error = "Veillez corriger les erreur(s) suivante(s): ";
        foreach($this->errors as $errorr) {
            $error = $error."<br/> - ".$errorr;
        }
        array_push($this->erreursEnregistrement, $error);
        $error = $this->displayErrors($this->erreursEnregistrement);
        header('Location: '.$failureRedirectionPage.'&error='.$error.'');
        return false;
    }

    /**
     * Fonction pour connecter un utilisateur à son compte
     * @param successRedirectionPage Page de redirection en cas de succès de connection
     * @param failureRedirectionPage Page de redirection en cas d'échec de l'opération
     * @return bool true si tout s'est bien passé et false sinon
     */
    public function login($successRedirectionPage, $failureRedirectionPage) {
        //Récuperation de tout les utilisateurs enregistrés
        $this->users = unserialize(file_get_contents("users.txt"));
        //Vérification de l'existence de l'utilisateur dans notre fichier
        foreach($this->users as $user) {
            if ($user['login'] == $this->login) {
                //Vérification du mot de passe
                if($user['mdp'] == $this->mdp) {
                    //Si le mot de passe est correct, on connecte l'utilisateur
                    $error = "L'utilisateur est bien connecté";
                    echo "<br/> ".$error;
                    array_push($this->erreursEnregistrement, $error);
                    $error = $this->displayErrors($this->erreursEnregistrement);
                    $_SESSION['isLogin'] = true;
                    $_SESSION['prenom'] = $this->prenom;
                    $_SESSION['login'] = $this->login;
                    $_SESSION['nom'] = $this->nom;
                    $_SESSION['sexe'] = $this->sexe;
                    $_SESSION['email'] = $this->email;
                    $_SESSION['naissance'] = $this->naissance;
                    $_SESSION['nomAdresse'] = $this->nomAdresse;
                    $_SESSION['codePostal'] = $this->codePostal;
                    $_SESSION['ville'] = $this->ville;
                    $_SESSION['telephone'] = $this->telephone;
                    header('Location: '.$successRedirectionPage.'&error='.$error.'');
                    return true;
                } else {
                    //Si le mot de passe n'est pas correct, on le signale à l'utilisateur
                    $error = "Le mot de passe n'est pas correct";
                    array_push($this->erreursEnregistrement, $error);
                    $error = $this->displayErrors($this->erreursEnregistrement);
                    header('Location: '.$failureRedirectionPage.'&error='.$error.'');
                    return false;
                }
                break;
            }
        }
        //Si l'utilisateur n'est pas existant, on le lui signale en lui proposant de créer son compte
        $error = "Aucun utilisateur associé au nom d'utilisateur fourni, veillez vous <a href=\"index.php?p=signup\">enregistrer</a>";
        echo "<br/> ".$error;
        array_push($this->erreursEnregistrement, $error);
        $error = $this->displayErrors($this->erreursEnregistrement);
        header('Location: '.$failureRedirectionPage.'&error='.$error.'');
        return false;

    }

    /**
     * Fonction pour modifier les données d'un utilisateur connecté
     * @param successRedirectionPage Page de redirection en cas de succès de modification
     * @param failureRedirectionPage Page de redirection en cas d'échec de l'opération
     * @return bool true si tout s'est bien passé et false sinon
     */
    public function modifDonnees($successRedirectionPage, $failureRedirectionPage) {
        //Vérification si l'utilisateur est connecté ou pas
        if(isset($_SESSION['isLogin'])) {
            //Vérification des nouvelles données fournies
            if($this->verifDonnees()) {
                //Si tout est bon on identifie l'utilisateur dans notre fichier
                foreach($this->users as $key => $user) {
                    //Si l'utilisateur existe on modifie ses données avec les nouvelles
                    if ($user['login'] == $_SESSION['login']) {
                        if($user['mdp'] == $this->ancienMdp) {
                            $user = array(
                                "login" => $this->login,
                                "mdp" => $this->mdp,
                                "nom" => $this->nom,
                                "prenom" => $this->prenom,
                                "sexe" => $this->sexe,
                                "email" => $this->email,
                                "naissance" => $this->naissance,
                                "nomAdresse" => $this->nomAdresse,
                                "codePostal" => $this->codePostal,
                                "ville" => $this->ville,
                                "telephone" => $this->telephone
                            );
                            //$this->users = unserialize(file_get_contents("users.txt"));
                            //On modifies les variables de session avec les nouvelles données
                            $_SESSION['prenom'] = $this->prenom;
                            $_SESSION['login'] = $this->login;
                            $_SESSION['nom'] = $this->nom;
                            $_SESSION['sexe'] = $this->sexe;
                            $_SESSION['email'] = $this->email;
                            $_SESSION['naissance'] = $this->naissance;
                            $_SESSION['nomAdresse'] = $this->nomAdresse;
                            $_SESSION['codePostal'] = $this->codePostal;
                            $_SESSION['ville'] = $this->ville;
                            $_SESSION['telephone'] = $this->telephone;

                            //On enregistre les nouvelles données dans notre fichier
                            $this->users[$key] = $user;
                            file_put_contents("users.txt", serialize($this->users));
                            $error = "Vos données ont bien étés modifées";
                            echo "<br/> ".$error;
                            array_push($this->erreursEnregistrement, $error);
                            $error = $this->displayErrors($this->erreursEnregistrement);
                            header('Location: '.$successRedirectionPage.'&error='.$error.'');
                            return true;
                        }
                        //Si l'ancien mot de passe n'est pas correct on ne modifie pas les données car on n'est pas sûre que c'est l'utilisateur lui même qui modifie les données
                        $error = "L'ancien mot de passe n'est pas correct";
                        array_push($this->erreursEnregistrement, $error);
                        $error = $this->displayErrors($this->erreursEnregistrement);
                        header('Location: '.$failureRedirectionPage.'&error='.$error.'');
                        return false;
                    }
                }
            }
            $error = "Veillez corriger les erreur(s) suivante(s): ";
            foreach($this->errors as $errorr) {
                $error = $error."<br/> - ".$errorr;
            }
            array_push($this->erreursEnregistrement, $error);
            $error = $this->displayErrors($this->erreursEnregistrement);
            header('Location: '.$failureRedirectionPage.'&error='.$error.'');
            return false;
        }
        //Si l'utilisateur n'est pas connecté il ne peut pas modifier ses données
        $error = "Vous n'êtes pas connectés et ne pouvez donc pas modifier vos données";
        array_push($this->erreursEnregistrement, $error);
        $error = $this->displayErrors($this->erreursEnregistrement);
        header('Location: '.$failureRedirectionPage.'&error='.$error.'');
        return false;

    }

    /**
     * Permet de transformer l'array d'affichage des erreurs
     * @param errors Le array des erreurs
     */
    public function displayErrors($errors) {
        //Génération du texte de l'erreur
        $errorText = "<h6><div class=\"bg-warning text-success\">";
        foreach($errors as $error) {
          $errorText .= $error . "</br>";
        }
        $errorText .= "</div></h6>";
        return $errorText;
    }

    // Accesseurs -> Permet d'accéder aux propriétés privées hors de la classe
    public function getErreursEnregistrement() {
        return $this->erreursEnregistrement;
    }

    public function getErrors() {
        return $this->errors;
    }

    public function getlogin() {
        return $this->login;
    }

    public function getMdp() {
        return $this->mdp;
    }

    public function getNom() {
        return $this->nom;

    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getSexe() {
        return $this->sexe;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getNaissance() {
        return $this->naissance;
    }

    public function getNomAdresse() {
        return $this->nomAdresse;
    }

    public function getCodePostal() {
        return $this->codePostal;
    }

    public function getVille() {
        return $this->ville;
    }

    public function getTelephone() {
        return $this->telephone;
    }



    // Mutateurs -> Permet de modifier les propriétés privées hors de la classe
    public function setlogin() {
        

    }

    public function setMdp() {
        
    }

    public function setNom($nom) {

    }

    public function setPrenom($prenom) {

    }

    public function setSexe($sexe) {

    }

    public function setEmail($email) {

    }

    public function setNaissance($naissance) {

    }

    public function setNomAdresse($nomAdresse) {

    }

    public function setCodePostal($codePostal) {

    }

    public function setVille($ville) {

    }

    public function setTelephone($telephone) {

    }

}