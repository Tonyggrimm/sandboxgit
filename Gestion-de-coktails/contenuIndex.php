<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head> -->
<body>
  
    <!-- MAIN -->
    <main>  
        <div class="container-fluid">
          <div class="row">
            <div class="col-2 border border-top-0">
              <div class="row">
                <span class="header-coktail">Aliment courant</span>
              </div>
			  <?php 
				include("Donnees.inc.php");
				
                $sousCatExist = false;
                if (isset($_GET['superCat']) && isset($_GET['element'])) {
                  $superCat = $_GET['superCat'];
                  $element = $_GET['element'];
				  
				  
				  
				  
				  if(isset($_GET['path'])){
					 $path=$_GET['path']."/".$element;
				  }else{
					$path=$element;
				  }
				  
                  if($superCat != null && $element != null){
                    $sousCat = calculerSousCategories($Hierarchie,$element);
					//Il est nécessaire de bien représenter l'element(sans underscores)dans le fil d'ariane
                    $affichage = '<div class="row">
                                    <a href="#">'.str_replace('_',' ',$path).'</a>
                                  </div>
								  </br>
                                    <!-- Liste des sous-categories -->
                                  <div class="row">
                                    <span >Sous-categories: <span>
                                  </div>
                                  <div id=linkList class="row">
                                    <ul class="nav nav-pills flex-column">';
                    
                    if(count($sousCat) != 0){
                      $sousCatExist = true;
                      foreach($sousCat as $cat){
						  if(substr_count($cat,' ')>=1){
							  $replacedCat=str_replace(' ','_',$cat);
								$affichage .= 	  "<li class=nav-item>
												   <a class='nav-link' href=index.php?p=contenuIndex&superCat=$element&element=$replacedCat&path=$path>$cat</a>
												   </li>";
							  
						  }else{
							   $affichage .= "<li class=nav-item>
                                        <a class='nav-link' href=index.php?p=contenuIndex&superCat=$element&element=$cat&path=$path>$cat</a>
                                       </li>"; 
							  
						  }
                      
                      }
                      $affichage .=  ' </ul>
                                    </div>'; 
                      echo $affichage;     
					}
                  }

                } else {
						$element = "Aliment";
						$affichageStandard= '<div class="row">
												<a href="#">'.$element.'</a>
											</div>
											</br>
											
											<!-- Liste des sous-categories -->
											
											<div class="row">
												<span >Sous-categories: <span>
											</div>';
						
						
						$sousCat=calculerSousCategories($Hierarchie,"Aliment");
						
						$affichageStandard .=  '<div id=linkList class="row">
												<ul class="nav nav-pills flex-column">';
						  
						foreach($sousCat as $cat){
							if(substr_count($cat,' ')>=1){
								$replacedCat=str_replace(' ','_',$cat);
								$affichageStandard .= "<li class=nav-item>
												   <a class='nav-link' href=index.php?p=contenuIndex&superCat=$element&element=$replacedCat&path=$element>$cat</a>
												   </li>";
								
							}else{
								$affichageStandard .= "<li class=nav-item>
												   <a class='nav-link' href=index.php?p=contenuIndex&superCat=$element&element=$cat&path=$element>$cat</a>
												   </li>";
							}
							
						}
							$affichageStandard .=  ' </ul>
												   </div>'; 
                      echo $affichageStandard;   
                }
				
				if($sousCatExist==false && $element !="Aliment" ){
					echo '<div class="row">
                                    <a href="#">'.str_replace('_',' ',$path).'</a>
                                  </div>
								  </br>
                                    <!-- Liste des sous-categories -->
                                  <div class="row">
                                    <span >Sous-categories: <span>
                                  </div>Non existantes !';
				}
              ?>    
            </div>
            <div class="col-10" id="display-zone">
              <div class="row-0">
                <div class="text-center">
                  <h4 class="mt-1 mb-2">Vos recettes de coktails en details...</h4>
                  <p>Bonne préparation!</p>
                </div>
              </div>

              <!-- Affichage des recettes selon la catégorie sélectionné | Génération avec php -->
              <?php
                if($sousCatExist) {
                  $coktailsExtrait = extraireCoktails($superCat, $element);
                  echo afficherListeRecettes($coktailsExtrait);

                } else {
                  echo afficherListeRecettes($tableau);
                }              
              ?>
              <!-- Fin de la génération PHP -->
            </div>
          </div>
          <hr class="d-sm-none">
        </div>
      </main>
</body>
<!-- </html> -->