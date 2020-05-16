<?php

    function runScript($script) {
        $path = dirname(__FILE__)."/".$script;
        exec($path);
    }
    
    function protect() {
        runScript("protect_folder.sh");
    }
    
    function validateEnvironment() {
        $errors = [];
        if(!file_exists("/etc/apache2/sites-enabled/phpmyadmin.conf")) {
            $errors[] = "phpMyAdmin is nog niet geinstalleerd.";
        }
        
        $output = [];
        exec("mysql-ctl status 2>&1", $output);
        $status = implode(" ", $output);
        
        if(strpos($status, 'MySQL is running') === false) {
            $errors[] = "De database MySQL draait nog niet.";
        }
        
        if (count($errors)) {
?>            
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">        
    </head>
    <body>
        <div class="container">
            <br />
            <div class="row">
                <div class="col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Let op!
                        </div>
                        <div class="panel-body">
                            De omgeving is nog niet juist geinstalleerd. Los de volgende problemen op:<br /><br />
                            <ul>
                            <?php
                                foreach($errors as $error) {
                                    echo "<li>". $error."</li>";
                                }
                            ?>
                            </ul>
                            Deze problemen zijn over het algemeen op te lossen door het draaien van het programma <strong>start.sh</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </body>
</html>    

<?php
            die();
        }
        
    }


