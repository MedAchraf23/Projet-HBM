<!DOCTYPE html>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../cssFiles/login.css">


</head>
<body>

<h1>BIENVENUE </h1>

<form action="authentification.php" method="post">
  <div class="imgcontainer">
    
  </div>

  <div class="container">
    <p id="erreur">Connexion impossible. Données incorrectes*</p>
    <label for="uname"><b>Nom d'utilisateur</b></label>
    <input type="text" placeholder="Entrer votre nom d'utilisateur" name="uname" required>

    <label for="psw"><b>Mot de passe</b></label>
    <input type="password" placeholder="Entrer votre mot de passe" name="psw" required>
        
    <button type="submit" value="Connecter">Connecter</button>
   
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <a href="accueil.php"><button type="button" class="cancelbtn">Quitter</button></a>
    <span class="psw">oublier <a href="../htmlFiles/motDePasseOublier.html">Mot de passe?</a></span>
  </div>
</form>

</body>
</html>