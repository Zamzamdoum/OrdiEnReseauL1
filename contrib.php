<!DOCTYPE html>
<html lang="fr">
  <head>
    <title>Votre contribution au dictionnaire</title>
    <meta charset="utf-8">
    <meta name="description" content="contribute to database">
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
          $contrib = $_POST;        
          
          $mot = addslashes(htmlspecialchars($contrib["word"]));
          $definition = addslashes(htmlspecialchars($contrib["definition"]));
          $categ = $contrib["category"];
          $auteur = addslashes(htmlspecialchars($contrib["contributor"]));
        
          $date = getdate();
          $mois = getdate()[mon];
          if (strlen($mois) == 1){
            $mois = '0'.$mois;}
          $created = "$date[mday]/$mois/$date[year]";
      
          
          $result = mysqli_query($connect, "SELECT * FROM motval WHERE word = '".$mot."'");
          if($ligne = mysqli_fetch_assoc($result)){
            echo "<p style='color: red;'>Le mot « $mot » est déjà dans le dictionnaire.</p>"; }
        
          elseif ((! $mot) || (! $definition) || (! $categ)){
            echo "<p style='color: red;'>Les champs Mot, Définition et Catégorie grammaticale
            doivent être renseignés.</p>";}
          else{
            
            //Envoi des données à la base de données
            $send = "INSERT INTO `motval`(`word`, `author`, `created`, `category`, `definition`)
            VALUES ('$mot','$auteur','$created','$categ','$definition')";
            
            if ($connect -> query($send) === TRUE) {
              echo "<p>Votre contribution a bien été prise en compte. Merci !</p>";}
            else {
              echo "<p>Une erreur est survenue. Veuillez réessayer plus tard.</p>";}
          }
   
          $connect -> close();        
        ?>
        
        
        <form id=contrib method="post"
              action=/PHP/contrib.php>
          <h4>Mot</h4>
          <p><input type=text name="word"></p>
          <h4>Définition</h4>
          <p><textarea type=text name="definition" maxlength=500
                       placeholder="Entrez votre définition (500 caractères max.)"></textarea></p>      
          <h4>Catégorie grammaticale</h4>
          <p><input type=radio name="category" value="nom">nom
             <input type=radio name="category" value="adjectif">adjectif
             <input type=radio name="category" value="verbe">verbe</p>
          <h4>Votre nom (facultatif)</h4>
          <p><input type=text name="contributor"></p>
          <input type=submit value="Soumettre">
        </form>
        
      </section> 
    </div>
    
    <footer>Site hébergé par 1&amp;1 Internet SARL - 7, place de la Gare, BP  70109 - 
       57201 Sarreguemines Cedex - Téléphone : 0970 808 911
    </footer>
    
  </body>
</html>