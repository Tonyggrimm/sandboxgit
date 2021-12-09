<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  <?php 
    include("fonctions.php");
  ?>
    <!-- MAIN -->
    <main>  
        <div class="container-fluid">
          <div class="row">
            <div class="col-2 border border-top-0">
              <div class="row">
                <span class="header-coktail">Liste des Aliments</span>
              </div>
              <!-- Listes de liens dirigeant au menu -->
              <div class="row">
                <a href="#">Aliment</a>
              </div>
              <!-- Liste des sous-categories -->
              <div class="row">
                <span >Sous-categories: <span>
              </div>
              <div class="row">
                <ul class="nav nav-pills flex-column">
                  <li class="nav-item">
                    <a class="nav-link" href="">Fruit</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Légumes</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Epices</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Disabled</a>
                  </li>
                </ul>
              </div>    
            </div>
            
            <?php
                //print_r($_GET);
                //Array ( [p] => listeCoktails ,[parent] => Aliment [enfant] => fruit );
                // Creation du fils d'ariane           
            ?>

            <div class="col-10" id="display-zone">
              <div class="row-0">
                <div class="text-center">
                  <h4 class="mt-1 mb-2">Vos recettes de coktails en details...</h4>
                  <p>Bonne préparation!</p>
                </div>
              </div>

              <!-- Affichage des recettes selon la catégorie sélectionné | Génération avec php -->
              <?php
                echo afficherListeRecettes($tableau);
              ?>
              <!-- Fin de la génération PHP -->
            </div>
          </div>
          <hr class="d-sm-none">
        </div>
      </main>
</body>
</html>