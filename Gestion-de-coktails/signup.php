<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Création de compte</title>
</head>
<body>
    <section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-10">
              <div class="card rounded-3 text-black">
                <form action="./testUser.php?function=signup" method="post">
                  <div class="row g-0">
                    <div class="text-center">
                      <h4 class="mt-1 mb-5 pb-1">Nous sommes la team coktails de Metz</h4>
                      <p>Creez votre compte gratuitement</p>
                    </div>
                  </div>
                  <div class="row g-0">
                    <div class="col-lg-6">
                      <div class="card-body p-md-5 mx-md-4">
                        <div class="form-outline mb-4">
                          <input type="text" id="login" name="login" class="form-control" placeholder="Entrez votre nom d'utilisateur"
                          <?php 
                            if(isset($_SESSION['login'])) { $login = $_SESSION['login']; echo "value=\"$login\""; }
                          ?>
                          />
                          <label class="form-label" for="login">Nom d'utilisateur<span style="color:red;" >*</span></label>
                        </div>
        
                        <div class="form-outline mb-4">
                          <input type="password" id="mdp" name="mdp" class="form-control" placeholder="Entrez votre mot de passe" />
                          <label class="form-label" for="mdp">Mot de passe<span style="color:red;" >*</span></label>
                        </div>

                        <div class="form-outline mb-4">
                          <input type="text" id="prenom" name="prenom" class="form-control" placeholder="Entrez votre nom" 
                          <?php 
                            if(isset($_SESSION['nom'])) { $nom = $_SESSION['nom']; echo "value=\"$nom\""; }
                          ?>
                          />
                          <label class="form-label" for="prenom">Nom</label>
                        </div>

                        <div class="form-outline mb-4">
                          <input type="text" id="nom" name="nom" class="form-control" placeholder="Entrez votre prenom" 
                          <?php 
                            if(isset($_SESSION['prenom'])) { $prenom = $_SESSION['prenom']; echo "value=\"$prenom\""; }
                          ?>
                          />
                          <label class="form-label" for="nom">Prénom</label>
                        </div>

                        <div class="form-outline mb-4">
                          <input type="email" id="email" name="email" class="form-control" placeholder="Entrez votre E-mail" 
                          <?php 
                            if(isset($_SESSION['email'])) { $email = $_SESSION['email']; echo "value=\"$email\""; }
                          ?>
                          />
                          <label class="form-label" for="email">Email</label>
                        </div>

                        <div class="form-outline mb-4">
                          <input type="tel" id="telephone" name="telephone" class="form-control" placeholder="Telephone" 
                          <?php 
                            if(isset($_SESSION['telephone'])) { $telephone = $_SESSION['telephone']; echo "value=\"$telephone\""; }
                          ?>
                          />
                          <label class="form-label" for="telephone">Telephone</label>
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-lg-6">
                      <div class="card-body p-md-5 mx-md-4">
                        <div class="form-outline mb-4">
                          <select class="form-select" name="sexe" id="">
                            <option value="femme"
                            <?php 
                              if(isset($_SESSION['sexe']) && $_SESSION['sexe'] == "femme") { echo "selected"; }
                            ?>
                            >Femme</option>
                            <option value="homme"
                            <?php 
                              if(isset($_SESSION['sexe']) && $_SESSION['sexe'] == "homme") { echo "selected"; }
                            ?>
                            >Homme</option>
                          </select>
                          <label class="form-label" for="sexe" id="sexe">Sexe</label>
                        </div>
        
                        <div class="form-outline mb-4">
                          <input type="date" id="naissance" name="naissance" class="form-control" 
                          <?php 
                            if(isset($_SESSION['naissance'])) { $naissance = $_SESSION['naissance']; echo "value=\"$naissance\""; }
                          ?>
                          />
                          <label class="form-label" for="naissance">Date de naissance</label>
                        </div>

                        <div class="form-outline mb-4">
                          <input type="text" id="nomAdresse" name="nomAdresse" class="form-control" placeholder="11 Rue Dupont" 
                          <?php 
                            if(isset($_SESSION['nomAdresse'])) { $nomAdresse = $_SESSION['nomAdresse']; echo "value=\"$nomAdresse\""; }
                          ?>
                          />
                          <label class="form-label" for="nomAdresse">Adresse</label>
                        </div>

                        <div class="form-outline mb-4">
                          <input type="number" id="codePostal" name="codePostal" class="form-control" placeholder="57000" 
                          <?php 
                            if(isset($_SESSION['codePostal'])) { $codePostal = $_SESSION['codePostal']; echo "value=\"$codePostal\""; }
                          ?>
                          />
                          <label class="form-label" for="codePostal">Code Postal</label>
                        </div>

                        <div class="form-outline mb-4">
                          <input type="text" id="ville" name="ville" class="form-control" placeholder="" 
                          <?php 
                            if(isset($_SESSION['ville'])) { $ville = $_SESSION['ville']; echo "value=\"$ville\""; }
                          ?>
                          />
                          <label class="form-label" for="ville">Ville</label>
                        </div>     
                      </div>
                    </div>
                  </div>
                  <div class="row-0">
                    <div class="text-center pt-1 mb-5 pb-1">
                      <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Creer mon compte</button>
                      <div>
                        <a class="text-muted" href="#!">Mot de pass oublié?</a>
                      </div>
                    </div>
                  </div> 
                </form>      
              </div>
            </div>
          </div>
        </div>
      </section>
</body>
</html>