<?php
session_start();

$host="localhost";
$user="root";
$password="";
$db="jojojo";
$wachtwoordonjuist=false;

$dbverbinding=mysqli_connect("localhost","root","",$db);

     if (!$dbverbinding) {
     //    Geef de foutmelding die de server teruggeeft en stop met de uitvoer van PHP (die)
      echo '<p>jo verbinding mislukt</p>';
       die("Verbinding mislukt: " . mysqli_connect_error());
      }
      

mysql_connect($host,$user,$password);
mysql_select_db($db);


//voorraadquerys en prijsquerys:

for($A=1;$A<13;$A++){
  
  $voorraadquery[$A]="SELECT COUNT(*) FROM beschikbaar WHERE  broodjes_id='".$A."' AND klant_id IS NULL";
  $resultaatvoorraadquery[$A]=mysqli_query($dbverbinding, $voorraadquery[$A]);
  
  while($row = $resultaatvoorraadquery[$A]->fetch_assoc()) {
    $voorraad_eind[$A]=$row["COUNT(*)"];
  } 
  $prijsquery[$A]="SELECT prijs FROM Broodjes WHERE broodjes_id='".$A."'";
  $resultaatprijsquery[$A]=mysqli_query($dbverbinding, $prijsquery[$A]);
  
  while($row = $resultaatprijsquery[$A]->fetch_assoc()) {
    $prijs_eind[$A]=$row["prijs"]/100;
  } 
}


?>

<!doctype html>
<html lang="en">
  <head>
    <title>Prima Cantina</title>
     <meta name="theme-color" content="#50a050">
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
        <a id="navwoord" class="btn btn-primary active" href="etenswaren.php">Etenswaren</a>
      </li>
      <li class="nav-item">
        <a id="navwoord" class="btn btn-primary" href="dezeweek.php">Deze Week</a>
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
<section class="container">
   <div class="menulijst">
          <div class="menutitel">
     <h2>Menulijst</h2>
     </div>
     <p id="onzebrood">Onze Broodjes:</p>
     
     <div class="assortiment">
     <div class="row">
             <div class="dibs">
                    <div class="broodje">
                        <img id="fotobroodje"src="foto/mexicano.png">
                        
                        <div class="titelorder">
                        <h5>Broodje Mexicano</h5>
                        <p class="orderbeschrijving">
                        Met Saus Naar Keuze
                        </p>
                        </div>
                        <hr>
                        

<form method="POST" ACTION="bedankt.php">
  <?php
  echo $voorraad_eind[1]." Broodjes beschikbaar <br>
  Hoeveelheid: <input type='number' name='1' min='1' max='3' value='1'><br>
  Prijs: ".$prijs_eind[1]." euro";
  
  
  ?>
  

  
  <div class="knopdibs">

  <a id="myBtn" href="#popup1">Dibs</a>
  <div id="popup1" class="overlay">
  	<div class="popup">
  		<h2>Broodje Mexicano</h2>
  		<a class="close" href="#">&times;</a>
  		<div class="content">
  			Weet u zeker dat u dit broodje wil dibsen?<br>
  			<div class="knopdibs">

  			       <input type="submit" value="Ja ik wil dit broodje!!!"  id="myBtn">

  			</div>
  		</div>
          
  		</div>
  	</div>
  </div>

  </div>
</form>
                      </div>
                      
                      
                      <div class="dibs">
                      <div class="broodje">
                      
                        <img id="fotobroodje" src="foto/broodjeworst.png"> 
                        <div class="titelorder">
                        <h5>Broodje Worst</h5>
                        
                                                <p class="orderbeschrijving">
                        Met Saus Naar Keuze
                        </p>
                        </div>
                      <hr>
                      
                      
<form method="POST" ACTION="bedankt.php">
  <?php
  echo $voorraad_eind[2]." Broodjes beschikbaar <br>
  Hoeveelheid: <input type='number' name='2' min='1' max='3' value='1'><br>
  Prijs: ".$prijs_eind[2]." euro";
  
  
  ?>
  
  
                                        <div class="knopdibs">
<a id="myBtn" href="#popup2">Dibs</a>
<div id="popup2" class="overlay">
	<div class="popup">
		<h2>Broodje Worst</h2>
		<a class="close" href="#">&times;</a>
		<div class="content">
			Weet u zeker dat u dit broodje wil dibsen?<br>
			<div class="knopdibs">
			    			       <input type="submit" value="Ja ik wil dit broodje!!!"  id="myBtn">
			  </div>
		</div>
	</div>
</div>
</div>
</div>
</form> 
                      </div>
                      
                    
                      <div class="dibs">
                      <div class="broodje">
                      
                        <img id="fotobroodje" src="foto/saucijzen.png"> 
                        <div class="titelorder">
                        <h5>Saucijzen Broodje</h5>
                        
                        
                        <p class="orderbeschrijving">
                        <br>                                              </p>
                        </div>
                        <hr>
                        
                        
<form method="POST" ACTION="bedankt.php">
  <?php
  echo $voorraad_eind[3]." Broodjes beschikbaar <br>
  Hoeveelheid: <input type='number' name='3' min='1' max='3' value='1'><br>
  Prijs: ".$prijs_eind[3]." euro";
  
  
  ?>
  
  
       <div class="knopdibs">

<a id="myBtn" href="#popup3">Dibs</a>
<div id="popup3" class="overlay">
	<div class="popup">
		<h2>Saucijzen Broodje</h2>
		<a class="close" href="#">&times;</a>
		<div class="content">
			Weet u zeker dat u dit broodje wil dibsen?<br>
			<div class="knopdibs">
			    			       <input type="submit" value="Ja ik wil dit broodje!!!"  id="myBtn">
			  </div>
        
		</div>
	</div>
</div>

</div>
                      </div>
</form>                      
                      </div>
                      

                      <div class="dibs">
                      <div class="broodje">
                      
                        <img id="fotobroodje" src="foto/gezond.png"> 
                        <div class="titelorder">
                        <h5>Broodje Gezond</h5>
                        
                        
                        <p class="orderbeschrijving">
                        <br>
                        </p>
                        </div>
                        <hr>
                        
                        
 <form method="POST" ACTION="bedankt.php">
  <?php
  echo $voorraad_eind[5]." Broodjes beschikbaar <br>
  Hoeveelheid: <input type='number' name='5' min='1' max='3' value='1'><br>
  Prijs: ".$prijs_eind[5]." euro";
  
  
  ?>
  
  
  <div class="knopdibs">

<a id="myBtn" href="#popup4">Dibs</a>
<div id="popup4" class="overlay">
	<div class="popup">
		<h2>Broodje Gezond</h2>
		<a class="close" href="#">&times;</a>
		<div class="content">
			Weet u zeker dat u dit broodje wil dibsen?<br>
			<div class="knopdibs">
			    			       <input type="submit" value="Ja ik wil dit broodje!!!"  id="myBtn">
			  </div>
        
		</div>
	</div>
</div>

</div>
                      </div>
                      </form>
                      </div>

                      <div class="dibs">
                      <div class="broodje">
                      
                        <img id="fotobroodje" src="foto/broodje-brie.png"> 
                        <div class="titelorder">
                        <h5>Broodje Brie</h5>
                        
                        
                        <p class="orderbeschrijving">
                        Met Saus Naar Keuze
                        </p>
                        </div>
                        <hr>
                        
                        
                        <form method="POST" ACTION="bedankt.php">
  <?php
  echo $voorraad_eind[4]." Broodjes beschikbaar <br>
  Hoeveelheid: <input type='number' name='4' min='1' max='3' value='1'><br>
  Prijs: ".$prijs_eind[4]." euro";

  
  ?>
  
  
  <div class="knopdibs">

<a id="myBtn" href="#popup5">Dibs</a>
<div id="popup5" class="overlay">
	<div class="popup">
		<h2>Broodje Brie</h2>
		<a class="close" href="#">&times;</a>
		<div class="content">
			Weet u zeker dat u dit broodje wil dibsen?<br>
			<div class="knopdibs">
			    			       <input type="submit" value="Ja ik wil dit broodje!!!"  id="myBtn">
			  </div>
        
		</div>
	</div>
</div>

</div>
                      </div>
                      </div>
                      </div>
                      </form>
                     </div>

                    <hr>
                    <p id="onzebrood">Onze Soepen:</p>
                    <div class="row">
                      <div class="dibs">
                      <div class="broodje">
                      
                        <img id="fotobroodje" src="foto/Tomatensoep.png"> 
                        <div class="titelorder">
                        <h5>Tomatensoep</h5>
                        
                        
                        <p class="orderbeschrijving">
                        <br>
                        </p>
                        </div>
                        <hr>
                        
                        
                                                <form method="POST" ACTION="bedankt.php">
                          <?php
  echo $voorraad_eind[9]." Soepen beschikbaar <br>
  Hoeveelheid: <input type='number' name='9' min='1' max='3' value='1'><br>
  Prijs: ".$prijs_eind[9]." euro";
  
  
  ?>
  
  
  <div class="knopdibs">

<a id="myBtn" href="#popup6">Dibs</a>
<div id="popup6" class="overlay">
	<div class="popup">
		<h2>Tomatensoep</h2>
		<a class="close" href="#">&times;</a>
		<div class="content">
			Weet u zeker dat u deze soep wil dibsen?<br>
			<div class="knopdibs">
			   			       <input type="submit" value="Ja ik wil dit Soepje!!!"  id="myBtn">
			  </div>
        
		</div>
	</div>
</div>

</div>
                      </div>
                      </form>
                      </div>
                      
                      <div class="dibs">
                      <div class="broodje">
                      
                        <img id="fotobroodje" src="foto/kippensoep.png"> 
                        <div class="titelorder">
                        <h5>Kippensoep</h5>
                        
                        
                        <p class="orderbeschrijving">
                        <br>
                        </p>
                        </div>
                        <hr>
                        
                        
                                                <form method="POST" ACTION="bedankt.php">
                          <?php
  echo $voorraad_eind[11]." Soepen beschikbaar <br>
  Hoeveelheid: <input type='number' name='11' min='1' max='3' value='1'><br>
  Prijs: ".$prijs_eind[11]." euro";
  
  
  ?>
  
  
  <div class="knopdibs">

<a id="myBtn" href="#popup7">Dibs</a>
<div id="popup7" class="overlay">
	<div class="popup">
		<h2>Kippensoep</h2>
		<a class="close" href="#">&times;</a>
		<div class="content">
			Weet u zeker dat u deze soep wil dibsen?<br>
			<div class="knopdibs">
			    			       <input type="submit" value="Ja ik wil dit Soepje!!!"  id="myBtn">
			  </div>
        
		</div>
	</div>
</div>

</div>
                      </div>
                      </form>
                      </div>
                      
                       <div class="dibs">
                      <div class="broodje">
                      
                        <img id="fotobroodje" src="foto/mosterdsoep.png"> 
                        <div class="titelorder">
                        <h5>Mosterdsoep</h5>
                        
                        
                        <p class="orderbeschrijving">
                        <br>
                        </p>
                        </div>
                        <hr>
                        
                        
                                                <form method="POST" ACTION="bedankt.php">
                          <?php
  echo $voorraad_eind[10]." Soepen beschikbaar <br>
  Hoeveelheid: <input type='number' name='10' min='1' max='3' value='1'><br>
  Prijs: ".$prijs_eind[10]." euro";
  
  
  ?>
  
  
  <div class="knopdibs">

<a id="myBtn" href="#popup8">Dibs</a>
<div id="popup8" class="overlay">
	<div class="popup">
		<h2>Mosterdsoep</h2>
		<a class="close" href="#">&times;</a>
		<div class="content">
			Weet u zeker dat u deze soep wil dibsen?<br>
			<div class="knopdibs">
			    			       <input type="submit" value="Ja ik wil dit Soepje!!!"  id="myBtn">
			  </div>
        
		</div>
	</div>
</div>

</div>
                      </div>
                       </form>
                      </div>
                     
                      <div class="dibs">
                      <div class="broodje">
                      
                        <img id="fotobroodje" src="foto/groentesoep.png"> 
                        <div class="titelorder">
                        <h5>Groentesoep</h5>
                        
                        
                        <p class="orderbeschrijving">
                        <br>
                        </p>
                        </div>
                        <hr>
                        
                        
                                                <form method="POST" ACTION="bedankt.php">
                          <?php
  echo $voorraad_eind[8]." Soepen beschikbaar <br>
  Hoeveelheid: <input type='number' name='8' min='1' max='3' value='1'><br>
  Prijs: ".$prijs_eind[8]." euro";
  
  
  ?>
  
  
  <div class="knopdibs">

<a id="myBtn" href="#popup9">Dibs</a>
<div id="popup9" class="overlay">
	<div class="popup">
		<h2>Groentesoep</h2>
		<a class="close" href="#">&times;</a>
		<div class="content">
			Weet u zeker dat u deze soep wil dibsen?<br>
			<div class="knopdibs">
			    			       <input type="submit" value="Ja ik wil dit Soepje!!!"  id="myBtn">
			  </div>
        
		</div>
	</div>
</div>

</div>
                      </div>
</form>
                      </div>

                                            <div class="dibs">
                      <div class="broodje">
                      
                        <img id="fotobroodje" src="foto/Champignonsoep.png"> 
                        <div class="titelorder">
                        <h5>Champignonsoep</h5>
                        
                        
                        <p class="orderbeschrijving">
                        <br>
                        </p>
                        </div>
                        <hr>
                        
                        
                        <form method="POST" ACTION="bedankt.php">
                          <?php
  echo $voorraad_eind[12]." Soepen beschikbaar <br>
  Hoeveelheid: <input type='number' name='12' min='1' max='3' value='1'><br>
  Prijs: ".$prijs_eind[12]." euro";
  
  
  ?>
  
  
  <div class="knopdibs">

<a id="myBtn" href="#popup10">Dibs</a>
<div id="popup10" class="overlay">
	<div class="popup">
		<h2>Groentesoep</h2>
		<a class="close" href="#">&times;</a>
		<div class="content">
			Weet u zeker dat u deze soep wil dibsen?<br>
			<div class="knopdibs">
			   			       <input type="submit" value="Ja ik wil dit Soepje!!!"  id="myBtn">
			  </div>
        
		</div>
	</div>
</div>

</div>
                      </div>
                      </form>
                      </div>
                      
                    </div>
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


  
  

