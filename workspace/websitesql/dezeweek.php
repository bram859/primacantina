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




for($A=1;$A<13;$A++){

  $rekenquery[$A]= "SELECT AVG(rating) FROM voorkeurslijst WHERE broodjes_id = '".$A."'";
  $resultaatrekenquery[$A] = mysqli_query($dbverbinding, $rekenquery[$A]);
  while($row = $resultaatrekenquery[$A]->fetch_assoc()) {
    $rating[$A]=$row["AVG(rating)"]*1000;
  } 

  $ratingquery[$A]= "UPDATE Rating SET rating='".$rating[$A]."' WHERE broodjes_id='".$A."'";
  mysqli_query($dbverbinding, $ratingquery[$A]);
  

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
        <a id="navwoord" class="btn btn-primary active" href="dezeweek.php">Deze Week</a>
      </li>
      <li class="nav-item">
        <a id="navwoord" class="btn btn-primary" href="profiel.php">Profiel</a>
      </li>
    </ul>
    
     
    
    <div class="loguit">
    <form class="form-inline my-2 my-lg-0">
      <a class="btn btn-outline-success2"  href="loguit.php">Uitloggen</a>
    </form>
    
    
    </div>
  </div>
</nav>
  
    
     <div class="container" id="jumboweek">
      <div class="bg-faded p-4 my-4">
       
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ul class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ul>
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
               
              <img class="d-block img-fluid w-100" src="foto/briecarousel.jpg" alt="">
              <div class="carousel-caption d-md-block">
              <div class="achtergrondcarousel">
               <h1 class="text-shadow" id="aanbieding">Aanbieding Van Deze Week</h1>
             <h2 class="text-shadow">Broodje Brie</h2>
                <h3 class="text-shadow">Nieuw deze week</h3>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid w-100" src="foto/gezondcarousel.jpg" alt="">
              <div class="carousel-caption d-md-block">
                <div class="achtergrondcarousel">
                <h2 class="text-shadow">Broodje gezond</h2>
                <h3 class="text-shadow">Extra gezond</h3>
              </div>
              </div>
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid w-100" src="foto/kipcarousel.jpg" alt="">
              <div class="carousel-caption d-md-block">
                <div class="achtergrondcarousel">
                <h2 class="text-shadow">Kippensoep</h2>
                <h3 id="kiponder" class="text-shadow">Heerlijk voor tussendoor</h3>
              </div>
              </div>
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
        </div>
        </div>
        
             <div class="container" id="jumboweek2">
      <div id="telliecarousel" class="bg-faded">
       
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ul class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ul>
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
               
              <img class="d-block img-fluid w-100" src="foto/briecarousel.jpg" alt="">
              <div class="carousel-caption d-md-block">
                <div class="achtergrondcarousel">
               <h1 class="text-shadow" id="aanbieding">Deze Week</h1>
             <h2 class="text-shadow">Broodje Brie</h2>
                <h3 class="text-shadow">Nieuw deze week</h3>
              </div>
              </div>
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid w-100" src="foto/gezondcarousel.jpg" alt="">
              <div class="carousel-caption d-md-block">
                <div class="achtergrondcarousel">
                <h2 class="text-shadow">Broodje gezond</h2>
                <h3 class="text-shadow">Extra gezond</h3>
              </div>
              </div>
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid w-100" src="foto/kipcarousel.jpg" alt="">
              <div class="carousel-caption d-md-block">
                <div class="achtergrondcarousel">
                <h2 class="text-shadow">Kippensoep</h2>
                <h3 class="text-shadow">Heerlijk voor tussendoor</h3>
              </div>
              </div>
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
        </div>
        </div>
        
        <section  class="container">
    <div class="intro">
      <div class="titel">
    <div class="row">
              <h1 id="titelweek">Top 5 broodjes</h1>
              
     </div>
            <?php
         $top5broodjesquery="SELECT rating,Naam FROM Rating,Broodjes WHERE Rating.broodjes_id>=1 AND Rating.broodjes_id<=5  AND Rating.broodjes_id=Broodjes.broodjes_id ORDER BY rating DESC LIMIT 5";
  $resultaattop5broodjesquery= mysqli_query($dbverbinding, $top5broodjesquery);
  //toon_tabel($top5broodjesquery,$dbverbinding);


if (mysqli_num_rows($resultaattop5broodjesquery) > 0) {
    // maak een tabel met de ratings en de broodjes_id
    while($row = mysqli_fetch_assoc($resultaattop5broodjesquery)) {
      $Rating=$row["rating"]/1000;
      $Naam=$row["Naam"];
      
        echo "<b>Naam:</b> " . $Naam. " - <b>Rating:</b> " . round($Rating,1). "<br>";
    }
} else {
    echo "0 results";
}


?>
        </div>
       </div>

        </section>
  
  
       <section  class="container">
    <div class="intro">
      <div class="titel">
    <div class="row">
              <h1 id="titelweek">Top 5 Soepen</h1>
     </div>
     <?php
     $top5soepenquery="SELECT rating,broodjes_id FROM Rating WHERE broodjes_id>=8 AND broodjes_id<=12 ORDER BY rating DESC LIMIT 5";
  $resultaattop5soepenquery= mysqli_query($dbverbinding, $top5soepenquery);
  //toon_tabel($top5soepenquery,$dbverbinding);



         $top5soepenquery="SELECT rating,Naam FROM Rating,Broodjes WHERE Rating.broodjes_id>=8 AND Rating.broodjes_id<=12  AND Rating.broodjes_id=Broodjes.broodjes_id ORDER BY rating DESC LIMIT 5";
  $resultaattop5soepenquery= mysqli_query($dbverbinding, $top5soepenquery);
  //toon_tabel($top5soepenquery,$dbverbinding);


if (mysqli_num_rows($resultaattop5soepenquery) > 0) {
    // maak een tabel met de ratings en de broodjes_id
    while($row = mysqli_fetch_assoc($resultaattop5soepenquery)) {
      $Rating=$row["rating"]/1000;
      $Naam=$row["Naam"];
      
        echo "<b>Naam:</b> " . $Naam. " - <b>Rating:    </b> "   .  round($Rating,1). "<br>";
        
        
    }
} else {
    echo "0 results";
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