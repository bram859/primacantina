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
      
$uname=$_SESSION["USER_ID"];
mysql_connect($host,$user,$password);
mysql_select_db($db);

$querynaam= "SELECT Voornaam FROM Profiel,login WHERE login.id=Profiel.id AND leerlingnummer='".$_SESSION["USER_ID"]."'";
$querynaamresultaat=mysqli_query($dbverbinding, $querynaam);

$queryachternaam= "SELECT Achternaam FROM Profiel,login WHERE login.id=Profiel.id AND leerlingnummer='".$_SESSION["USER_ID"]."'";
$queryachternaamresultaat=mysqli_query($dbverbinding, $queryachternaam);

$leerlingnummerquery="SELECT id FROM login WHERE leerlingnummer='".$uname."'";
$leerlingnummerqueryresultaat=mysqli_query($dbverbinding, $leerlingnummerquery);

while($row = $leerlingnummerqueryresultaat->fetch_assoc()) {
  $gebruiker=$row["id"];
} 

while($row = $querynaamresultaat->fetch_assoc()) {
  $voornaam=$row["Voornaam"];
} 

while($row = $queryachternaamresultaat->fetch_assoc()) {
  $achternaam= $row["Achternaam"];
} 

// Hieronder de orders enzo

$ordersquery="SELECT Naam FROM beschikbaar, Broodjes WHERE klant_id='".$gebruiker."' AND beschikbaar.broodjes_id=Broodjes.broodjes_id";
$ordersqueryresultaat=mysqli_query($dbverbinding, $ordersquery);

/* if (mysqli_num_rows($ordersqueryresultaat) > 0) {
    // maak een tabel met de broodjes_id van de gedibste broodjes
    while($row0 = mysqli_fetch_assoc($ordersqueryresultaat)) {
      $Naam=$row0["Naam"];
      
      
        echo "<b>-</b> " .$Naam. " <br>";
        
        
    }
} else {
    echo "0 results";
}
*/
/*
    // output data of each row
    while($row = mysqli_fetch_assoc($ordersqueryresultaat)) {
        echo "Naam: " . $row["Naam"]. "<br>";
    } 
*/



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

  
  <section class="container">
    <div class="profiel">
     
          <div class="titel">
            <div class="site-heading">
              <h1>
              <?php
            if ($querynaamresultaat->num_rows > 0) {
            
                echo "Welkom ". $voornaam. " bij Prima Cantina";
               
            }
            else {
              echo "Geen resultaat";
            }    
            
            ?>
            </h1>
            </div>
            <br>
            <h2 id="gegevens">Jouw gegevens</h2>
            <hr>
            <h3>
             <?php
             echo '<b>Voornaam:</b> '.$voornaam.'<hr>' ;
             echo '<b> Achternaam:</b> '.$achternaam.'<hr>';
             echo '<b> Leerlingnummer:</b> '.$uname.'<hr>';
       
             
             
             ?>

            </h3>
            
            </div>
           
              
                   
                    <div class="intro">
                    
                     <div class="titel">
                      <h1>Mijn Orders</h1>
                     
                      
                        <p id="stemuitleg">Hier staan broodjes en soepen die jij hebt gedibs en op kan halen in de pauze.</p>
                        <!-- hier komen de huidige gereserveerde broodjes-->
                        <?php
                        if (mysqli_num_rows($ordersqueryresultaat) > 0) {
                          // maak een tabel met de broodjes_id van de gedibste broodjes
                          while($row0 = mysqli_fetch_assoc($ordersqueryresultaat)) {
                            $Naam=$row0["Naam"];
                            echo "<b>-</b> " .$Naam. " <br>";
                            }
                          
                        } 
                        else {
                          echo "0 results";
                        }
                        ?>
                    
                    
    </div>
</div>
<div class="orders">
  <h2><a id="voorkeurtitel" href='wachtwoordwijzigen.php'>wijzig wachtwoord    &#9656;</a></h2>
              </div>

      </div>
    
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