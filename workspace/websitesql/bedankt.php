<?php
session_start();

$host="localhost";
$user="root";
$password="";
$db="jojojo";
$wachtwoordonjuist=false;

$dbverbinding=mysqli_connect("localhost","root","",$db);

     if (!$dbverbinding) {
         //Geef de foutmelding die de server teruggeeft en stop met de uitvoer van PHP (die)
       echo '<p>jo verbinding mislukt</p>';
        die("Verbinding mislukt: " . mysqli_connect_error());
      }
      

mysql_connect($host,$user,$password);
mysql_select_db($db);



// het dibsen:


for($A=1;$A<13;$A++){
  
  $voorraadquery[$A]="SELECT COUNT(*) FROM beschikbaar WHERE  broodjes_id='".$A."' AND klant_id IS NULL";
  $resultaatvoorraadquery[$A]=mysqli_query($dbverbinding, $voorraadquery[$A]);
  
  while($row = $resultaatvoorraadquery[$A]->fetch_assoc()) {
    $voorraad_eind[$A]=$row["COUNT(*)"];
  } 

}





$klant_id=$_SESSION["USER_ID"];


function dips($klant_id, $broodjes_id,$dbverbinding){
  //achterhaal gegevens van de user en het gewilde broodje
  $queryklant="SELECT id FROM login WHERE leerlingnummer='".$klant_id."'";
  $resultaatqueryklant=mysqli_query($dbverbinding, $queryklant);
  $selecteerbroodje="SELECT beschikbaar_id FROM beschikbaar WHERE broodjes_id='".$broodjes_id."' AND klant_id IS NULL";
  $resultaatselecteerbroodje=mysqli_query($dbverbinding, $selecteerbroodje);
  //zet deze resultaten om naar bruikbare getallen
  while($row = $resultaatqueryklant->fetch_assoc()) {
    $klant_id_eind=$row["id"];
  } 
  while($row2 = $resultaatselecteerbroodje->fetch_assoc()) {
    $broodjes_ID_eind=$row2["beschikbaar_id"];
  } 
  //vind de naam van het gedibste broodje
  $naambroodjequery="SELECT Naam FROM Broodjes WHERE broodjes_id='".$broodjes_id."'";
  $naambroodje=mysqli_query($dbverbinding, $naambroodjequery);
    while($row3 = $naambroodje->fetch_assoc()) {
    $naambroodje_eind=$row3["Naam"];
  } 
  //update de tabel beschikbaar(dibs) met de gegevens uit de vorige querys
  $dipsquery="UPDATE beschikbaar SET  klant_id='".$klant_id_eind."' WHERE beschikbaar_id='".$broodjes_ID_eind."' ";
  if(mysqli_query($dbverbinding, $dipsquery)){
    //geef aan dat het broodje is gedibst
    echo "Jouw ".$naambroodje_eind." is gedibst en ligt op jouw te wachten in de kantine";
  }
  else{
    // anders is het niet gelukt
    echo "Sorry jouw ".$naambroodje_eind." kon niet worden gedibst";
  }
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
  <link rel="stylesheet" type="text/css" href="primacantinaadmin.css">
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
  </form>
    
    
    </div>
  </div>
</nav>
<section id="wwwijzig" class="container">
  <form NAME="form1" METHOD="POST"> 
  
    <div class="intro">
      <div class="row">
          <div class="titel">
            <div class="site-heading">
              <h1>Prima Cantina</h1>
              <?php
              // In de POST wordt de hoeveelheid broodjes opgeslagen de name van de POST die wordt gelaad is de soort broodje
              
              
              for($b=0;$b<13;$b++){
                if($_POST[$b]<=$voorraad_eind[$b]){
                  for($a=0;$a<$_POST[$b];$a++){
                     dips($klant_id,$b,$dbverbinding);
                  }  
                }
                else {
                   echo "Sorry dit product is niet meer beschikbaar";
                 }
              }
              
              
              
              ?>
              
              
              <span class="subheading">Klik <a id="ratenlink" href="primacantina.php">hier</a> om verder te gaan!</span> 
              
              
              
              
              
            </div>
            </div>
        </div>
    </div>
    </form>
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
