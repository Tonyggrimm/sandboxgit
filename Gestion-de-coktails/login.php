<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
</head>
<body> -->
    <section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-10">
              <div class="card rounded-3 text-black">
                <div class="row g-0">
                  <div class="text-center">
                    <h4 class="mt-1 mb-5 pb-1">Nous sommes la team coktails de Metz</h4>
                    <p>Creez votre compte gratuitement</p>
                  </div>
                </div>
                <form action="./testUser.php?function=login" method="post" >
                  <div class="row g-0">
                    <div class="col-lg-6">
                      <div class="card-body p-md-5 mx-md-4">
                        <div class="form-outline mb-4">
                          <input type="text" id="login" name="login" class="form-control" placeholder="Entrez votre nom d'utilisateur"/>
                          <label class="form-label" for="login">Nom d'utilisateur<span style="color:red;" >*</span></label>
                        </div>
      
                        <div class="form-outline mb-4">
                          <input type="password" id="mdp" name="mdp" class="form-control" placeholder="Entrez votre mot de passe" />
                          <label class="form-label" for="mdp">Mot de passe<span style="color:red;" >*</span></label>
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <div class="text-center">
                          <img src="PhotosSite/coktail-banner.png" alt="coktail banner image" width="300px">
                        </div>    
                    </div>
                  </div>
                  <div class="row-0">
                    <div class="text-center pt-1 mb-5 pb-1">
                      <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Connexion</button>
                      <!-- <div>
                        <a class="text-muted" href="#">Mot de passe oublié?</a>
                      </div> -->
                    </div>
                    <div class="d-flex align-items-center justify-content-center pb-4">
                      <p class="mb-0 me-2">Vous n'avez pas de compte?</p>
                        <button type="button" class="btn btn-outline-danger" onclick="window.location.href='index.php?p=signup';">Créez un compte</button>
                    </div>
                  </div>
                </form> 
              </div>
            </div>
          </div>
        </div>
      </section>   
<!-- </body>
</html> -->