<?php
session_start();

$host="localhost";
$user="root";
$password="";
$db="jojojo";
$wachtwoordonjuist=false;

$dbverbinding=mysqli_connect("localhost","root","",$db);

      if (!$dbverbinding) {
        // Geef de foutmelding die de server teruggeeft en stop met de uitvoer van PHP (die)
        echo '<p>jo verbinding mislukt</p>';
        die("Verbinding mislukt: " . mysqli_connect_error());
      }
      

mysql_connect($host,$user,$password);
mysql_select_db($db);


$leerlingnummerquery="SELECT ID FROM login WHERE leerlingnummer='".$_SESSION["USER_ID"]."'";
$leerlingnummerqueryresultaat=mysqli_query($dbverbinding, $leerlingnummerquery);

while($row = $leerlingnummerqueryresultaat->fetch_assoc()) {
  $USER_ID=$row["ID"];
} 




?>
<!doctype html>
<html lang="en">
  <head>
    <title>Prima Cantina</title>
     <meta name="theme-color" content="#50a050" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link href="https://fonts.googleapis.com/css?family=Pacifico|Rokkitt" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="primacantina.css">
  
  <!-- sjoerd hier nog ff met de primacantina.css aanpassen enzo-->
    <link rel="icon" href="foto/Prima5.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  </head>
  <body>
   
        <nav class="navbar navbar-expand-lg navbar-light">
          <a class="navbar-logo" href="primacantina.php">
        <img src="foto/Prima1.png" width="213" height="120" class="d-inline-block align-top" >
    
    </a>
          <div class="navcollapse">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  </div>


  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      
      <li class="nav-item active">
        <a id="navwoord" class="btn btn-primary" href="voorkeur.html">Voorkeurlijst <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a id="navwoord" class="btn btn-primary" href="etenswaren.php">Etenswaren</a>
      </li>
      <li class="nav-item">
        <a id="navwoord" class="btn btn-primary" href="dezeweek.php">Deze Week</a>
      </li>
      <li class="nav-item">
        <a id="navwoord" class="btn btn-primary active" href="profiel.php">Profiel</a>
      </li>
    </ul>
   
      
    
    <div class="loguit">
    <form class="form-inline my-2 my-lg-0">
      <a class="btn btn-outline-success2" href="login.php">Uitloggen</a>
    </form>
    
    
    </div>
  </div>
</nav>

  
  <section id="wwwijzig" class="container">

<?php    
    
if($_POST['submit']){
  // veranderen wachtwoord gebeurt hier:
  
  $oud_wachtwoord=$_POST['oud_wachtwoord'];
  $nieuw_wachtwoord=$_POST['nieuw_wachtwoord'];
  $herhaal_nieuw_wachtwoord=$_POST['herhaal_nieuw_wachtwoord'];
  
  $queryhuidigww="SELECT wachtwoord FROM login WHERE leerlingnummer='".$_SESSION['USER_ID']."'";
  $queryhuidigwwresultaat=mysqli_query($dbverbinding,$queryhuidigww);
  while($row = $queryhuidigwwresultaat->fetch_assoc()) {
    $huidigww=$row["wachtwoord"];
  } 
  
  if($huidigww==$oud_wachtwoord){
    // nieuw ww controle
    if($nieuw_wachtwoord==$herhaal_nieuw_wachtwoord){
      // het ww definitief veranderen met een update query
      
      $veranderwwquery="UPDATE login SET wachtwoord='".$nieuw_wachtwoord."' WHERE leerlingnummer='".$_SESSION['USER_ID']."'";
      mysqli_query($dbverbinding,$veranderwwquery);
      die("<div id='aanbieding' class='profiel'>Jouw wachtwoord is veranderd.</div>");
      
    }
    else{
      // Zelfde hier als de notitie hieronder, het ziet er niet uit
      die("<div id='aanbieding' class='profiel'>Nieuwe wachtwoorden komen niet overeen.</div>");
    }
  }
  else{
    // Wat hier gebeurt moet nog anders, de div class=profiel moet buiten de php komen voor een mooie website
    die("<div id='aanbieding'class='profiel'>Oud Wachtwoord klopt niet.</div>");
  }
  
}
else{
  
echo "
  <div class='profiel'>
 <form method='POST' action='wachtwoordwijzigen.php'>
    <div class='form-group'>
      <label for='exampleDropdownFormEmail1'>Huidig wachtwoord</label>
       <input type='password' name='oud_wachtwoord' class='form-control' id='exampleDropdownFormEmail1' placeholder='Wachtwoord'>
    </div>
    <div class='form-group'>
      <label for='exampleDropdownFormPassword1'>Nieuw Wachtwoord</label>
     <input type='password' name='nieuw_wachtwoord' class='form-control' id='exampleDropdownFormPassword1' placeholder='Nieuw Wachtwoord'>
    </div>
    <div class='form-group'>
      <label for='exampleDropdownFormPassword1'>Bevestig Wachtwoord</label>
     <input type='password' name='herhaal_nieuw_wachtwoord' class='form-control' id='exampleDropdownFormPassword1' placeholder='Nieuw Wachtwoord'>
    </div>
   <input type='submit' name='submit' value='Verander Wachtwoord' class='btn btn-primary'>
  </form>
  </div>";
}
?>    

      
    
    </section>
   
    </body>
  <section class="footer">
  <footer>
      <div class="container">
        <div class="row">
          
          <div class="col-lg-8 col-md-10 mx-auto">
            
            <p class="copyright">
              <a class="csg" href="http://www.csg.nl/">
              <div class="copyright">
              <img src="http://www.csg.nl/build/img/logo.svg" width="221" height="146">
              </a>
              <br>
              &copy; CSG augustinus</p>
              </div>
          </div>
        </div>
      </div>
    </footer>
   </section>
</html>