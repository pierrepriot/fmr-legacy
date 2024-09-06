<?php 
/** 
 * @package WordPress 
 * @subpackage Default_Theme 
 */
 
 // fonctions utiles, $valeur 
 function getSecond($valeur) {
	 return substr($valeur, 17, 2);
   }

   function getMinute($valeur) {
       return substr($valeur, 14, 2);
   }

  function getHour($valeur) {

      return substr($valeur, 11, 2);
  }

  function getDay($valeur)     {
     return substr($valeur, 8, 2);
  }

  function getMonth($valeur)     {
     return substr($valeur, 5, 2);
  }

  function getYear($valeur) {
     return substr($valeur, 0, 4);
 }

  function monthNumToName($mois) {
    $tableau = Array("", "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", 
    "Août", "Septembre", "Octobre", "Novembre", "Décembre");

    return (intval($mois) > 0 && intval($mois) < 13) ? $tableau[intval($mois)] : "Indéfini";
 }
 
 
 // Fonction pour afficher le calendrier
 function showCalendar($periode) {
    $leCalendrier = "";
    // Tableau des valeurs possibles pour un numéro 
   // de jour dans la semaine
    $tableau = Array("0", "1", "2", "3", "4", "5", "6", "0");

    $nb_jour = Date("t", mktime(0, 0, 0, getMonth($periode), 1, getYear($periode)));
    $pas = 0;
    $indexe = 1;

    // Affichage du mois et de l'année
    //$leCalendrier .= "<h2>&raquo; " . monthNumToName(getMonth($periode)) . " " . getYear($periode) . "</h2>
    //					<table>";
    $leCalendrier .= "<table>";

    // Affichage des entêtes
    $leCalendrier .= "
    <thead>
    <tr id=\"libelle\">
        <th scope=\"col\" class=\"weekday\">L</th>
        <th scope=\"col\" class=\"weekday\">M</th>
        <th scope=\"col\" class=\"weekday\">M</th>
        <th scope=\"col\" class=\"weekday\">J</th>
        <th scope=\"col\" class=\"weekday\">V</th>
        <th scope=\"col\" class=\"weekend\">S</th>
        <th scope=\"col\" class=\"weekend\">D</th>
    </tr>
    </thead>";
    
    // Tant que l'on n'a pas affecté tous les jours du mois traité 
    while ($pas < $nb_jour) {
        if ($indexe == 1) $leCalendrier .= 
        "<tbody><tr class=\"ligne\">";

        // Si le jour calendrier == jour de la semaine en cours
        if (Date("w", mktime(0, 0, 0, getMonth($periode), 1 + $pas, getYear($periode))) == $tableau[$indexe]) {
        
          // Si jour calendrier == aujourd'hui
          $afficheJour = Date("j", mktime(0, 0, 0, getMonth($periode), 1 + $pas, getYear($periode)));
          if (Date("Y-m-d", mktime(0, 0, 0, getMonth($periode), 1 + $pas, getYear($periode))) == Date("Y-m-d")) {
                $class = " class=\"weekday today\"";
                
          }
          else {
                // 1 est toujours vrai => on affiche 
                // un lien à chaque fois
                // A vous de faire les tests 
                // nécessaire si vous gérer un agenda par exemple
                if (1) {
                    $class = " class=\"weekday\"";
                    $afficheJour = Date("j",mktime(0, 0, 0, getMonth($periode), 1+$pas, getYear($periode)));

                } else {
               		   $class = "";
                }
          }
          // Ajout de la case avec la date
          $leCalendrier .= "<td$class>
          $afficheJour</td>";
          $pas++;
       }
             //
        else {

           // Ajout d'une case vide
           $leCalendrier .= "<td>&nbsp;</td>";
       }
       if ($indexe == 7 && $pas < $nb_jour) { 
       	  $leCalendrier .= "</tr>"; $indexe = 1;
       } else {
       		$indexe++;
       }
   }

   // Ajustement du tableau
   for ($i = $indexe; $i <= 7; $i++) {
        $leCalendrier .= "<td>&nbsp;</td>";
   }
   $leCalendrier .= "</tr>
				   </tbody>
   					</table>";

   // Retour de la chaine contenant le Calendrier
   return $leCalendrier;
} 

// Lis la date paramètre
if (isset($_GET['monthD']) && $_GET['monthD'] != '' && isset($_GET['yearD']) && $_GET['yearD'] != '') {
	$monthD = $_GET['monthD'];
	$yearD = $_GET['yearD'];
} else {
	$monthD = date("m");
	$yearD = date("Y");
}
?>

<script type="text/javascript" src="wp-content/themes/fmr/js/jcalendar.js"></script>

<div id="rightsidebar">
	<div class="sidebarHeader">
		<h2 class="sidebarTitle">Choisis ton mois</h2>
	</div>

	<link rel="stylesheet" href="wp-content/themes/fmr/css/jcalendar.css" type="text/css" />

    <form>
    <fieldset class="jcalendar">
       <div class="jcalendar-wrapper">
       <div id="prev"></div>
       <div class="jcalendar-selects">
         <select name="month" id="month" class="jcalendar-select-month" onchange="selectDate();">
           <option value="1"<?php echo ($monthD == 1 ? ' selected="selected"' : ''); ?>>Janvier</option>
           <option value="2"<?php echo ($monthD == 2 ? ' selected="selected"' : ''); ?>>F&eacute;vrier</option>
           <option value="3"<?php echo ($monthD == 3 ? ' selected="selected"' : ''); ?>>Mars</option>
           <option value="4"<?php echo ($monthD == 4 ? ' selected="selected"' : ''); ?>>Avril</option>
           <option value="5"<?php echo ($monthD == 5 ? ' selected="selected"' : ''); ?>>Mai</option>
           <option value="6"<?php echo ($monthD == 6 ? ' selected="selected"' : ''); ?>>Juin</option>
           <option value="7"<?php echo ($monthD == 7 ? ' selected="selected"' : ''); ?>>Juillet</option>
           <option value="8"<?php echo ($monthD == 8 ? ' selected="selected"' : ''); ?>>Ao&ucirc;t</option>
           <option value="9"<?php echo ($monthD == 9 ? ' selected="selected"' : ''); ?>>Septembre</option>
           <option value="10"<?php echo ($monthD == 10 ? ' selected="selected"' : ''); ?>>Octobre</option>
           <option value="11"<?php echo ($monthD == 11 ? ' selected="selected"' : ''); ?>>Novembre</option>
           <option value="12"<?php echo ($monthD == 12 ? ' selected="selected"' : ''); ?>>D&eacute;cembre</option>
         </select>
         <select name="year" id="year" class="jcalendar-select-year" onchange="selectDate();">
           <option value="2009"<?php echo ($yearD == 2009 ? ' selected="selected"' : ''); ?>>2009</option>
           <option value="2010"<?php echo ($yearD == 2010 ? ' selected="selected"' : ''); ?>>2010</option>
           <option value="2011"<?php echo ($yearD == 2011 ? ' selected="selected"' : ''); ?>>2011</option>
           <option value="2012"<?php echo ($yearD == 2012 ? ' selected="selected"' : ''); ?>>2012</option>
           <option value="2013"<?php echo ($yearD == 2013 ? ' selected="selected"' : ''); ?>>2013</option>
           <option value="2014"<?php echo ($yearD == 2014 ? ' selected="selected"' : ''); ?>>2014</option>
           <option value="2015"<?php echo ($yearD == 2015 ? ' selected="selected"' : ''); ?>>2015</option>
           <option value="2016"<?php echo ($yearD == 2016 ? ' selected="selected"' : ''); ?>>2016</option>
           <option value="2017"<?php echo ($yearD == 2017 ? ' selected="selected"' : ''); ?>>2017</option>
           <option value="2018"<?php echo ($yearD == 2018 ? ' selected="selected"' : ''); ?>>2018</option>
           <option value="2019"<?php echo ($yearD == 2019 ? ' selected="selected"' : ''); ?>>2019</option>
           <option value="2020"<?php echo ($yearD == 2020 ? ' selected="selected"' : ''); ?>>2020</option>
           <option value="2021"<?php echo ($yearD == 2021 ? ' selected="selected"' : ''); ?>>2021</option>
           <option value="2022"<?php echo ($yearD == 2022 ? ' selected="selected"' : ''); ?>>2022</option>
           <option value="2023"<?php echo ($yearD == 2023 ? ' selected="selected"' : ''); ?>>2023</option>
           <option value="2024"<?php echo ($yearD == 2024 ? ' selected="selected"' : ''); ?>>2024</option>
           <option value="2025"<?php echo ($yearD == 2025 ? ' selected="selected"' : ''); ?>>2025</option>
         </select>
<div class="jcalendar">
<div class="jcalendar-links">

<a href="?page_id=208&monthD=<?php echo (($monthD-1)>=1 ? ($monthD-1) . '&yearD=' . $yearD : 12 . '&yearD=' . ($yearD-1)); ?>" class="link-prev">‹ Mois Précédent</a>
<a href="?page_id=208&monthD=<?php echo  date('m'); ?>&yearD=<?php echo date('Y'); ?>" class="link-today">Aujourd'hui</a>
<a href="?page_id=208&monthD=<?php echo (($monthD+1)<=12 ? ($monthD+1) . '&yearD=' . $yearD : 1 . '&yearD=' . ($yearD+1)); ?>" class="link-next">Mois suivant ›</a>

</div>
<?php 
	echo showCalendar($yearD . '-' . $monthD); 
?>
</div>   

       </div>
       </div>
    </fieldset>
    </form>

</div>
<div class="clear"></div>