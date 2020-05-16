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


// hoeveelheid broodjes

for($A=1;$A<13;$A++){
  
  $voorraadquery[$A]="SELECT COUNT(*) FROM beschikbaar WHERE  broodjes_id='".$A."' AND klant_id IS NULL";
  $resultaatvoorraadquery[$A]=mysqli_query($dbverbinding, $voorraadquery[$A]);
  
  while($row = $resultaatvoorraadquery[$A]->fetch_assoc()) {
    $voorraad_eind[$A]=$row["COUNT(*)"];
  } 
  
  $voorraadinclquery[$A]="SELECT COUNT(*) FROM beschikbaar WHERE  broodjes_id='".$A."'";
  $resultaatvoorraadinclquery[$A]=mysqli_query($dbverbinding, $voorraadinclquery[$A]);
  
  while($row = $resultaatvoorraadinclquery[$A]->fetch_assoc()) {
    $voorraadincl_eind[$A]=$row["COUNT(*)"];
  } 
  
  
  

}
 
 
 // toevoegen hieronder belangerijk


if($_POST['submit']){
  //hoeveelheid vaststellen(kan voor elke form)
  for($a=0;$a<13;$a++){
    // naam van de form maken
    $naamform=$a;
    //sla de hoeveelheid op
    $hoeveelheid=$_POST[$naamform];
    if($_POST[$naamform]){
      // sla de formnaam op waarvan je de hoeveelheid hebt
      $naam_eind=$naamform;
      // hierna word de toevoeg query uitgevoerd met de juiste gegevens
      $toevoegquery = "INSERT INTO beschikbaar (broodjes_id) VALUES ('".$naam_eind."')";
      for($B=0;$B<$hoeveelheid;$B++){
        mysqli_query($dbverbinding,$toevoegquery);
        header("Loctation: primacantinaadmin.php");
      }
      header("Refresh:0");
    }
  }
}



// het verwijderen gebeurt hieronder:


if($_POST['delete']){
  //leerlingnummer naar klant_id omzetten:
  $klant_idquery="SELECT id FROM login WHERE leerlingnummer='".$_POST['verwijderen']."'";
  $klant_idqueryresultaat=mysqli_query($dbverbinding, $klant_idquery);
  while($row = $klant_idqueryresultaat->fetch_assoc()) {
    $klant_id=$row["id"];
  } 
  //alle rows met de geselecteerde klant_id worden verwijderd
  $verwijderquery="DELETE FROM beschikbaar WHERE klant_id='".$klant_id."'";
  if(mysqli_query($dbverbinding, $verwijderquery)){
    $verwijderd=true;
  }
  else{
    $verwijderd=false;
  }
  
  
}






 

?>
<!doctype html>
<html lang="en">
  <head>
    <title>Prima Admin</title>
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
  
    
    <div class="loguit">
    <form class="form-inline my-2 my-lg-0">
      <a class="btn btn-outline-success2"  href="loguitadmin.php">Uitloggen</a>
    </form>
    
    
    </div>
  </div>
</nav>

  
  <section class="container">
    <div class="intro">
      <div class="row">
          <div class="titel">
            <div class="site-heading">
              <h1>Prima Admin</h1>
              <span class="subheading">Door Maartje, Bram, Matteo & Sjoerd</span>
            </div>
            </div>
        </div>
    </div>
    </section>
      
      <div id="admincontain">
        
        
        
        <div class="row">
          
      
  <div id="adminrow">
  <div id="adminvoorraad" class="intro">
  <div class="toevoegen">
    
   <form method="POST" action="#">
    
      
      <label for="exampleDropdownFormEmail1">Voeg Broodjes Mexicano toe:</label>
      <div>
      <?php
      echo "Voorraad zonder reservering: ".$voorraad_eind[1]."<br>";
      echo "Voorraad incl. reserveringen: ".$voorraadincl_eind[1];
      ?>
      <div class="toevoegen">
        
       <input type="hoeveelheid1" name="1" class="form-control" id="typesubmit" placeholder="Hoeveelheid">
       
       <input type="submit" name="submit" value="Voeg toe!" class="btn btn-primary">
       
     </div>
     
  </form>
  
  </div>
  
 
    </div>
  </div>
  
  
  
    <div id="adminvoorraad" class="intro">
  <div class="toevoegen">
    
   <form method="POST" action="#">
    
      
      <label for="exampleDropdownFormEmail1">Voeg Broodjes Worst toe:</label>
      <div>
      <?php
      echo "Voorraad zonder reservering: ".$voorraad_eind[2]."<br>";
      echo "Voorraad incl. reserveringen: ".$voorraadincl_eind[2];
      ?>
      <div class="toevoegen">
        
       <input type="hoeveelheid2" name="2" class="form-control" id="typesubmit" placeholder="Hoeveelheid">
       
       <input type="submit" name="submit" value="Voeg toe!" class="btn btn-primary">
       
     </div>
     
  </form>
  
  </div>
  
 
    </div>
  </div>
    
    
    
    
    <div id="adminvoorraad" class="intro">
  <div class="toevoegen">
    
   <form method="POST" action="#">
    
      
      <label for="exampleDropdownFormEmail1">Voeg Saucijzen Broodje toe:</label>
      <div>
      <?php
      echo "Voorraad zonder reservering: ".$voorraad_eind[3]."<br>";
      echo "Voorraad incl. reserveringen: ".$voorraadincl_eind[3];
      ?>
      <div class="toevoegen">
        
       <input type="hoeveelheid3" name="3" class="form-control" id="typesubmit" placeholder="Hoeveelheid">
       
       <input type="submit" name="submit" value="Voeg toe!" class="btn btn-primary">
       
     </div>
     
  </form>
  
  </div>
  

    </div>
  </div>

  
  
    <div id="adminvoorraad" class="intro">
  <div class="toevoegen">
    
   <form method="POST" action="#">
    
      
      <label for="exampleDropdownFormEmail1">Voeg Broodjes Brie toe:</label>
      <div>
      <?php
      echo "Voorraad zonder reservering: ".$voorraad_eind[4]."<br>";
      echo "Voorraad incl. reserveringen: ".$voorraadincl_eind[4];
      ?>
      <div class="toevoegen">
        
       <input type="hoeveelheid4" name="4" class="form-control" id="typesubmit" placeholder="Hoeveelheid">
       
       <input type="submit" name="submit" value="Voeg toe!" class="btn btn-primary">
       
     </div>
     
  </form>
  
  </div>
  
    </div>
  </div>
  </div>
    </div>
  
  
  
   <div class="row">
      <div id="adminrow">
  
  <div id="adminvoorraad" class="intro">
  <div class="toevoegen">
    
   <form method="POST" action="#">
    
      
      <label for="exampleDropdownFormEmail1">Voeg Broodje Gezond toe:</label>
      <div>
      <?php
      echo "Voorraad zonder reservering: ".$voorraad_eind[5]."<br>";
      echo "Voorraad incl. reserveringen: ".$voorraadincl_eind[5];
      ?>
      <div class="toevoegen">
        
       <input type="hoeveelheid5" name="5" class="form-control" id="typesubmit" placeholder="Hoeveelheid">
       
       <input type="submit" name="submit" value="Voeg toe!" class="btn btn-primary">
       
     </div>
     
  </form>
  
  </div>
  
 
    </div>
  </div>
  
  
  
  
    <div id="adminvoorraad" class="intro">
  <div class="toevoegen">
    
   <form method="POST" action="#">
    
      
      <label for="exampleDropdownFormEmail1">Voeg Groentesoep toe:</label>
      <div>
      <?php
      echo "Voorraad zonder reservering: ".$voorraad_eind[8]."<br>";
      echo "Voorraad incl. reserveringen: ".$voorraadincl_eind[8];
      ?>
      <div class="toevoegen">
        
       <input type="hoeveelheid8" name="8" class="form-control" id="typesubmit" placeholder="Hoeveelheid">
       
       <input type="submit" name="submit" value="Voeg toe!" class="btn btn-primary">
       
     </div>
     
  </form>
  
  </div>
  
 
    </div>
  </div>
  
  
  
  
  
   
          
      
      
  
  <div id="adminvoorraad" class="intro">
  <div class="toevoegen">
    
   <form method="POST" action="#">
    
      
      <label for="exampleDropdownFormEmail1">Voeg Tomatensoep toe:</label>
      <div>
      <?php
      echo "Voorraad zonder reservering: ".$voorraad_eind[9]."<br>";
      echo "Voorraad incl. reserveringen: ".$voorraadincl_eind[9];
      ?>
      <div class="toevoegen">
        
       <input type="hoeveelheid9" name="9" class="form-control" id="typesubmit" placeholder="Hoeveelheid">
       
       <input type="submit" name="submit" value="Voeg toe!" class="btn btn-primary">
       
     </div>
     
  </form>
  
  </div>
  
 
    </div>
  </div>
  
  
  
  
  
  
    <div id="adminvoorraad" class="intro">
  <div class="toevoegen">
    
   <form method="POST" action="#">
    
      
      <label for="exampleDropdownFormEmail1">Voeg Mosterdsoep toe:</label>
      <div>
      <?php
      echo "Voorraad zonder reservering: ".$voorraad_eind[10]."<br>";
      echo "Voorraad incl. reserveringen: ".$voorraadincl_eind[10];
      ?>
      <div class="toevoegen">
        
       <input type="hoeveelheid10" name="10" class="form-control" id="typesubmit" placeholder="Hoeveelheid">
       
       <input type="submit" name="submit" value="Voeg toe!" class="btn btn-primary">
       
     </div>
     
  </form>
  
  </div>
  

    </div>
  </div>
  
  
  </div>
  </div>
  
  
   <div class="row">
          <div id="adminrow">
      
      
      
      
  
  <div id="adminvoorraad" class="intro">
  <div class="toevoegen">
    
   <form method="POST" action="#">
    
      
      <label for="exampleDropdownFormEmail1">Voeg Kippensoep toe:</label>
      <div>
      <?php
      echo "Voorraad zonder reservering: ".$voorraad_eind[11]."<br>";
      echo "Voorraad incl. reserveringen: ".$voorraadincl_eind[11];
      ?>
      <div class="toevoegen">
        
       <input type="hoeveelheid11" name="11" class="form-control" id="typesubmit" placeholder="Hoeveelheid">
       
       <input type="submit" name="submit" value="Voeg toe!" class="btn btn-primary">
       
     </div>
     
  </form>
  
  </div>
  

    </div>
  </div>
  
  
  
  
  
    <div id="adminvoorraad" class="intro">
  <div class="toevoegen">
    
   <form method="POST" action="#">
    
      
      <label for="">Voeg Champignonsoep toe:</label>
      <div>
      <?php
      echo "Voorraad zonder reservering: ".$voorraad_eind[12]."<br>";
      echo "Voorraad incl. reserveringen: ".$voorraadincl_eind[12];
      ?>
      <div class="toevoegen">
        
       <input type="hoeveelheid12" name="12" class="form-control" id="typesubmit" placeholder="Hoeveelheid">
       
       <input type="submit" name="submit" value="Voeg toe!" class="btn btn-primary">
       
     </div>
     
  </form>
  
  </div>
  
 
    </div>
  </div>
  </div>
  
  
  </div>
  </div>
  

  
  
 
  <section class="container">
    <div class="intro">
      <div class="row">
        <form method="POST" action="#">
        <label for="exampleDropdownFormEmail1">Verwijder gegevens uit de voorraad:</label><br><br>
        <p>Selecteer een leerlingnummer om broodjes uit de dibslijst te verwijderen,</p>
        <p>Van het geselecteerde leerlingnummer zullen alle broodjes uit de dibslijst verwijderd worden</p>
        
        <div class="toevoegen">
          <input type="verwijderen" name="verwijderen" class="form-control" id="typesubmit" placeholder="Leerlingnummer">
          <input type="submit" name="delete" value="Verwijder" class="btn btn-primary"> 
          </div>
            
            
        </form>
        <?php
        if($verwijderd==true&&$_POST['verwijderen']){
          echo "De etenswaren gereserveert op leerlingnummer ".$_POST['verwijderen']." zijn verwijderd.";
        }
        else if($verwijderd==false&&$_POST['verwijderen']){
          echo "De etenswaren op leerlingnummer ".$_POST['verwijderen']." konden niet worden verwijderd.";
        }
        ?>
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



