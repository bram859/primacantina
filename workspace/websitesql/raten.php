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

$uname=$_SESSION["USER_ID"];

  $group1=$_POST['group1'];
              $group2=$_POST['group2'];
              $group3=$_POST['group3']; 
              $group4=$_POST['group4']; 
              $group5=$_POST['group5'];
              $group6=$_POST['group6']; 
              $group7=$_POST['group7']; 
              $group8=$_POST['group8']; 
              $group9=$_POST['group9']; 
              $group10=$_POST['group10']; 
              

              
               $ratingquery1 = "INSERT INTO voorkeurslijst (voorkeur_id,leerlingnummer,broodjes_id,rating) VALUES (NULL,'".$uname."', '1', '".$group1."'), (NULL,'".$uname."', '2','".$group2."'), (NULL,'".$uname."', '3', '".$group3."'), (NULL,'".$uname."', '4', '".$group4."'), (NULL,'".$uname."', '5', '".$group5."'),(NULL,'".$uname."', '8', '".$group6."'), (NULL,'".$uname."', '9','".$group7."'), (NULL,'".$uname."', '10', '".$group8."'), (NULL,'".$uname."', '11', '".$group9."'), (NULL,'".$uname."', '12', '".$group10."')";
              mysqli_query($dbverbinding,$ratingquery1);

            /*
              
            $test="INSERT INTO voorkeurslijst (id,leerlingnummer,etens_id,rating,Broodje) VALUES (NULL,'147320', '1', '3','1')";
            if  (mysqli_query($dbverbinding,$test)){
              echo "jo gelukt";
            }
            else {
              echo "doet het niet :(";
            }*/

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

 
  <section class="container">
    <form NAME="form1" METHOD="POST"> 
    <div class="intro" style="margin-bottom:35%">
      <div class="row">
          <div class="titel">
            <div class="site-heading">
              <h1>Prima Cantina</h1>
              <span class="subheading">Bedankt voor het stemmen deze week! Klik <a id="ratenlink" href="primacantina.php">hier</a>
              om verder te gaan!</span> 
          
            </div>
            </div>
        </div>
    </div>
 </form>
         </section>

</body>
 
  <footer>
     <section class="footer">
      <div id="footsticky" class="container">
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
      </section>
    </footer>
   
</html>
