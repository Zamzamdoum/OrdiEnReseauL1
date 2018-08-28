<!DOCTYPE html>
<html lang="fr">
  <head>
    <title>Résultat de la recherche</title>
    <meta charset="utf-8">
    <meta name="description" content="search result">
    <meta name="author" content="Claire Stalter">
    <meta name="viewport">
    <link rel="stylesheet" href="/PHP/styles.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Mono" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
  </head>
    
  <body>
    <header>
      <h1>Hello word</h1>
      <p>Des trucs et des machins mais je sais pas encore trop quoi.</p>
  	</header>
    
    <nav>
      <div>
        <ul>
          <li id=accueil><a href="/PHP/construction.html">Accueil</a></li>
          <li id=trad><a href="/PHP/construction.html">Traductions</a></li>
          <li id=cv><a href="/PHP/index.html">Qui suis-je ?</a></li>
          <li id=contact><a href="/PHP/construction.html">Contact</a></li>     
        </ul>  
      </div>
    </nav>
   
    <div class=container>
      <aside>
        <p>Dictionnaire de mots-valises</p>
        <form method="get"
              action=/PHP/search.php>
          <input id=searchfield type=text name="search">
          <input type=submit value="Chercher">
        </form>
        <p><a id=btnContrib href="/PHP/motvalcontrib.php"><input type=submit value="Contribuer"></a></p>
      </aside>
    
      <section>  
        <h2>PETIT DICTIONNAIRE DE MOTS-VALISES DU FRANÇAIS</h2>

        <?php
          //Connexion à la base de données
          $host_name = 'db747114388.db.1and1.com';
          $database = 'db747114388';
          $user_name = 'dbo747114388';
          $password = '************';
          $connect = mysqli_connect($host_name, $user_name, $password, $database);
          $connect -> set_charset("utf8");

          //Test de la connexion
          //if (mysqli_connect_errno()) {
          //  die('<p>La connexion au serveur MySQL a échoué: '.mysqli_connect_error().'</p>');
          //} else {
          //  echo '<p>Connexion au serveur MySQL établie avec succès.</p >';
          //  }
          
          //Traitement des données du formulaire
          $search = $_GET['search'];        
                  
          //Cas où $search est vide car aucun texte n'y a été entré
          if ($search == NULL){
            echo "<p>Vous ne cherchez aucun mot en particulier ? Voici la liste de tous
                 les mots présents actuellement dans le dictionnaire :</p>";
            $mots = mysqli_query($connect, "SELECT * FROM motval");
            echo "<section id=listemots>";
            foreach($mots as $clef => $valeur) {
              echo "<p><a id=mot3 href=search.php?search=$valeur[word]>$valeur[word]</a></p>";}
            echo "</section>";}
          else{
            $result = mysqli_query($connect, "SELECT * FROM motval WHERE word = '".$search."'");
            //Si aucun résultat n'a été trouvé, propose d'ajouter le mot
            if(! $ligne = mysqli_fetch_assoc($result)){
              echo "<p>Le mot « $search » n'est pas encore dans le dictionnaire.
                   Voulez-vous l'y <a class=lien href='/PHP/motvalcontrib.php?add=$search'>ajouter<a/> ?</p>"; }
            //Sinon, affiche les détails du mot trouvé
            else
            {
              $mot = $ligne["word"];
              $auteur = $ligne["author"];
              $auteur != NULL || $auteur = "quelqu'un qui préfère garder l'anonymat";
              $adddate = $ligne["created"];
              $category = $ligne["category"];
              $def = $ligne["definition"];        
              echo "<p id=mot2>$mot <span class=catgramm>($category)</span></p>";
              echo "<p id=defin>$def</p>";
              echo "<p><span id=creator>Définition proposée par $auteur le $adddate.</span></p>";            
            }        
          }
        ?>
        
      </section> 
    </div>
    
    <footer>Site hébergé par 1&amp;1 Internet SARL - 7, place de la Gare, BP  70109 - 
       57201 Sarreguemines Cedex - Téléphone : 0970 808 911
    </footer>
    
  </body>
</html>