function switchimg(e) {
  // fonction associée aux flèches permettant de changer une des trois images
  
  // récupération des données de l'événement :
  var e = window.event || e;
  var elem = e.target || e.srcElement;
  
  var mnstrpart = elem.id;
  // récupère l'id correspondant à la flèche cliquée  
  var imgId = mnstrpart.slice(0, 4) + "img";
  // extrait une partie du précédent et y accole la chaîne "img"
  var imgname = document.getElementById(imgId).src;
  /* utilise la variable précédente pour récupérer le nom de l'image source
  sur laquelle porte la flèche cliquée */
  var nbimg = imgname.charAt(imgname.length - 5);
  // extrait de ce nom le numéro de l'image actuellement affichée

  var newnb;
  switch (mnstrpart.charAt(mnstrpart.length - 1)) {
  // détermine le numéro de la nouvelle image selon le type de flèche
    case "l":
      // pour les flèches headl, bodyl et feetl
      newnb = -1 + Number(nbimg);
      if (newnb == -1) {
        newnb = 5;
      }
      break;
    case "r":
      // pour les flèches headr, bodyr et feetr
      newnb = 1 + Number(nbimg);
      if (newnb == 6) {
        newnb = 0;
      }
      break;
  }

  var newimg;
  switch (mnstrpart.slice(0, 4)) {
  /* détermine le nom de la nouvelle image selon la partie de l'image
      correspondant à la flèche cliquée */
    case "head":
      newimg = "images/Tete" + newnb + ".png";
      break;
    case "body":
      newimg = "images/Corps" + newnb + ".png";
      break;
    case "feet":
      newimg = "images/Pattes" + newnb + ".png";
      break;
  }

  document.getElementById(imgId).src = newimg;
  //remplace l'image
}


function switchcolor() {
  // fonction associée au sélecteur de couleur d'arrière-plan
  var selectedcolor = document.getElementById("bgcolor").value;
  // récupère la valeur sélectionnée dans l'élément HTML select "bgcolor"
  var coloredbox = document.getElementById("monsterbox");
  // récupère l'élément dont on veut changer la couleur de fond
  coloredbox.style.backgroundColor = selectedcolor;
  // applique la nouvelle couleur
}


function getRandomInt(max) {
  // fonction aléatoire utilisée par randommnstr()
  return Math.floor(Math.random() * Math.floor(max));
}


function randommnstr() {
  // fonction permettant de créer une combinaison aléatoire de monstre + couleur
  
  // initialisation des nombres aléatoires :
  var nbtete = getRandomInt(6);
  var nbcorps = getRandomInt(6);
  var nbpattes = getRandomInt(6);
  var nbcolor = getRandomInt(5);
  
  var coloredbox = document.getElementById("monsterbox");
  // récupère l'élément dont on veut changer la couleur de fond
  var colorlist = document.getElementById("bgcolor");
  // récupère l'élément select "bgcolor"
  var colors = colorlist.options;
  // récupère la liste d'options de l'élément select "bgcolor"
  var newcolor = colors[nbcolor].value;
  // récupère la couleur correspondant à l'index nbcolor

  document.getElementById("headimg").src = "images/Tete" + nbtete + ".png";
  document.getElementById("bodyimg").src = "images/Corps" + nbcorps + ".png";
  document.getElementById("feetimg").src = "images/Pattes" + nbpattes + ".png";
  // remplacent chacune des trois images

  coloredbox.style.backgroundColor = newcolor;
  // applique la nouvelle couleur
  colorlist.value = newcolor;
}
