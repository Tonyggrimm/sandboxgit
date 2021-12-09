<!-- Template d'array pour affichage de coktail  -->
<?php
                $tableau = array(
                  0 => array(
                    "titre" => "Coktails",
                    "preparation" => "Melanger le tout dans une caserole et fermer pendant 10 minutes.",
                    "img"       => "Photos/cocktail.png",
                    "likeColor" => "red",
                    'index' =>  array ( 0 => 'Aperol', 1 => 'Prosecco', 2 => 'Glaçon', 
                                        3 => 'Orange sanguine', 4 => 'Eau gazeuse',
                                      )
                 ),
                  1 => array(
                    "titre" => "Coktails",
                    "img"       => "Photos/cocktail.png",
                    "likeColor" => "aliceblue",
                    'index' =>  array ( 0 => 'Aperol', 1 => 'Prosecco', 2 => 'Glaçon',
                                        3 => 'Orange sanguine', 4 => 'Eau gazeuse',
                                      )
                  ),
                  2 => array(
                    "titre" => "Coktails",
                    "img"       => "Photos/cocktail.png",
                    "likeColor" => "red",
                    'index' =>  array ( 0 => 'Aperol', 1 => 'Prosecco', 2 => 'Glaçon',
                                        3 => 'Orange sanguine', 4 => 'Eau gazeuse',
                                      )
                  ),
                  3 => array(
                    "titre"     => "Coktails",
                    "img"       => "Photos/cocktail.png",
                    "likeColor" => "aliceblue",
                    'index' =>  array ( 0 => 'Aperol', 1 => 'Prosecco', 2 => 'Glaçon',
                                        3 => 'Orange sanguine', 4 => 'Eau gazeuse',
                                      )
                  ),

                  4 => array(
                    "titre"     => "Coktails",
                    "img"       => "Photos/cocktail.png",
                    "likeColor" => "red",
                    'index' =>  array ( 0 => 'Aperol', 1 => 'Prosecco', 2 => 'Glaçon',
                                        3 => 'Orange sanguine', 4 => 'Eau gazeuse',
                                      )
                  )
                );


//  Fonctions Utilitaires pour extraction de contenus 

// Extraction des ingredients du tableau
    function extraireIndex($tableau) {
        $index  = null;
        foreach($tableau as $key => $value) {
            $index .="<br/>$value" ;
        }
        return $index;
    }

    function makeCoktail($title , $colorLike, $index, $img){
      $coktail = '<div class="col-sm-3 mb-2">
                    <div class="card" style="width: 12rem;">
                    <div class="text-left">
                        <form class="d-flex" method="POST" action="index.php?p=detailsRecette" target="_blank">
                        <button type="submit" class="btn ms-2 h4 coktail-title" name="preparation" value="Preparation">' . $title . ' </button>
                        <button class="btn mb-2 btn-yellow ms-2 heart" type="button"> ' .
                           displayHeart($colorLike) .'
                        </button>
                        </form>
                    </div>
                    <img src="' . $img . '" class="card-img-top" alt="..." width="30px" height="100px">
                    <div class="card-body">
                        <p class="card-text">'. $index . '</p>
                    </div>
                    </div>
                  </div>' ;
      return $coktail;
    }

    function afficherListeRecettes($recettes){
        $row = 4;
        $rowDisplay = '<div class="row mb-2">';
        foreach($recettes as $coktails => $details){
            if($row >= 0) { 
              // On affiche quatre coktails par ligne bootstrap
              $rowDisplay .= makeCoktail($details["titre"], $details["likeColor"],
                                          extraireIndex($details["index"]), $details["img"]);
              $row--;      
          } else {
              $rowDisplay . "</div>";
              // Il faut encore addiche que 3 coktails dans la div
              $row = 3;
              // On affiche la suite sur une nouvelle ligne
              $rowDisplay .= '<div class="row mb-2">' . 
                              makeCoktail($details["titre"], $details["likeColor"],
                              extraireIndex($details["index"]), $details["img"]);
              //$rowDisplay.=$details["preparation"];
          }
        }
        return $rowDisplay;
    }

    function displayHeart($heartColor) {
        if($heartColor == "red"){
            $button = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-heart-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                        </svg>';
        } else {
            $button = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-heart" viewBox="0 0 16 16">
                            <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                        </svg>';
                        }
        return $button;

    }

    		
        /// Parcourir le tableau et afficher les sous-categories
        // retourner le tableau des sous catégories de l'élément
		
    function calculerSousCategories($Hierarchie,$element){
		
		//Re-enlever les underscores placés pour que le passage de la variable "$element" fonctionne
		if(substr_count($element,'_')>=1){
			$element=str_replace('_',' ',$element);
		}
		
		if($Hierarchie[$element]!=null){
			$array=$Hierarchie[$element];
			if(array_key_exists("sous-categorie",$array)){
				$array=array_values($array["sous-categorie"]);
				return $array;
			}	
		}
		
		
    }

    function extraireCoktails($superCat, $element){

      $tableau = array(
        0 => array(
          "titre" => "Coktails",
          "preparation" => "Melanger le tout dans une caserole et fermer pendant 10 minutes.",
          "img"       => "Photos/cocktail.png",
          "likeColor" => "red",
          'index' =>  array ( 0 => 'Aperol', 1 => 'Prosecco', 2 => 'Glaçon', 
                              3 => 'Orange sanguine', 4 => 'Eau gazeuse',
                            )
       ),
        1 => array(
          "titre" => "Coktails",
          "img"       => "Photos/cocktail.png",
          "likeColor" => "aliceblue",
          'index' =>  array ( 0 => 'Aperol', 1 => 'Prosecco', 2 => 'Glaçon',
                              3 => 'Orange sanguine', 4 => 'Eau gazeuse',
                            )
        ));
      return $tableau ;
        /// Parcourir le tableau et afficher les sous-categories
        // retourner le tableau des sous catégories de l'élément

    }

    function afficherSousCategories($element){
        //calculerSousCategories($element);

    }

?>
