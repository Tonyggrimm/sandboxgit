<div class="container">
<?php


include('./fonctions.php');
require './classes/Recherche.php';

$newSearch = new Recherche(trim($_GET['cocktail']));

echo "<br/><h3>Partie 1</h3>";

//Test de la validité de la syntaxe
if(!$newSearch->verifSyntaxeRequete()) {
    //S'il y a des erreurs on les affiche
    $erreurs = $newSearch->getErreur();

    foreach($erreurs as $erreur) {
        echo $erreur . "<br/>";
    }
} else {
    //S'il n'y a pas d'erreur de syntaxe on récupère les mots
    $newSearch->analyseRequete();
    /*$mots = $newSearch->analyseRequete();
    foreach($mots as $mot) {
        echo $mot . "<br/>";
    }*/

    //Affichage du rapport
    $aliments = $newSearch->separationAliments();
    $souhaites = "Liste des aliments souhaités: ";
    $nonSouhaites = "Liste des aliments non souhaités: ";
    $nonReconnus = "Éléments non reconnus dans la requête: ";

    if(count($aliments["alimentsSouhaites"]) > 0) {
        foreach($aliments["alimentsSouhaites"] as $catSouhait) {
            $souhaites = $souhaites.$catSouhait.", ";
        }
        echo rtrim($souhaites, ', ')."<br/>"; //Retire la virgule à la fin de la chaine
    }
    
    if(count($aliments["alimentsNonSouhaites"]) > 0) {
        foreach($aliments["alimentsNonSouhaites"] as $catNonSouhait) {
            $nonSouhaites = $nonSouhaites.$catNonSouhait.", ";
        }
        echo rtrim($nonSouhaites, ', ')."<br/>"; //Retire la virgule à la fin de la chaine
    }
    
    if(count($aliments["elementsNonReconnus"]) > 0) {
        foreach($aliments["elementsNonReconnus"] as $catNonReconnu) {
            $nonReconnus = $nonReconnus.$catNonReconnu.", ";
        }
        echo rtrim($nonReconnus, ', ')."<br/>"; //Retire la virgule à la fin de la chaine
    }

}
//echo print_r($aliments);
echo "<br/><hr/>";
echo "<h3>Partie 2</h3>";
$recettesRequete = [];
if($scoreDesRecettes = $newSearch->recuperationRecettes()) {
    //file_put_contents('exemple.txt', print_r($scoreDesRecettes));
    //echo print_r($scoreDesRecettes);
    //print_r($scoreDesRecettes);
    foreach($scoreDesRecettes as $key => $value) {
        //echo $key." => ".$value." ";
        if($value>0){
            $recettesCourantes = $newSearch->getRecettes();
            $nouvelleStructure = [
                                    "titre" => $recettesCourantes[$key]["titre"],
                                    "preparation" => $recettesCourantes[$key]["preparation"],
                                    "img" => "./Photos/cocktail.png",
                                    "likeColor" => "",
                                    "index" => $recettesCourantes[$key]["index"]
                                 ];
            array_push($recettesRequete, $nouvelleStructure);
            /*echo $recettesCourantes[$key]["titre"]."<br/>";
            foreach($recettesCourantes[$key]["index"] as $val) {
                echo "&nbsp;&nbsp; ".$val."<br/>";
            }*/
        }
    }
    //print_r($recettesRequete);
    echo afficherListeRecettes($recettesRequete);;
} else {
    echo "Problème dans votre requête: recherche impossible";
}

echo "<br/>";

?>
</div>