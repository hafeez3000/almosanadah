Event.observe(document,"dom:loaded",function(){
  // resa classique
  var calendar1 = new MultiCalendars({
    'arrivalID': 'arrivee1',    //id de l'input dans lequel va s'afficher la date
    'buttonID': 'date_arrivee_img1', // id de l'image qui permet d'afficher le calendrier au clic
    'arrivalDayID': 'jour_arrivee1',  // id de l'input hidden qui renvoie le jour ATTENTION cet input doit avoir pour name "jour_arrivee"
    'arrivalMonthID': 'mois_arrivee1', // id de l'input hidden qui renvoie le mois ATTENTION cet input doit avoir pour name "mois_arrivee"
    'arrivalYearID': 'annee_arrivee1', // // id de l'input hidden qui renvoie l'annee ATTENTION cet input doit avoir pour name "annee_arrivee"
    'nightsID': 'nb_nuit1', // id du select des nuits ATTENTION ce select doit avoir pour name "nb_nuit"
    'departureID': 'depart1' // id du champs dans lequel va s'afficher la date de départ
  });
 
  // resa express
  var calendar2 = new MultiCalendars({
    'arrivalID': 'arrivee2',
    'buttonID': 'date_arrivee_img2',
    'arrivalDayID': 'jour_arrivee2',
    'arrivalMonthID': 'mois_arrivee2',
    'arrivalYearID': 'annee_arrivee2',
    'nightsID': 'nb_nuit2',
    'departureID': 'depart2'
  });
});