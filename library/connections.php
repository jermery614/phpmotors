<?php
    // Proxy connection to the phpmotors database
    
    
    function phpmotorsConnect() {
        $server = 'localhost';
        $dbname= 'phpmotors';
        $username = 'iclient';
        $password = 'chV0W]iiMAxBrGvh'; 
        $dsn = "mysql:host=$server;dbname=$dbname";
        $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

        try {
            $link = new PDO($dsn, $username, $password, $options);
            // for testing purposes
            // if (is_object($link)){
            //     echo 'It works!';
            // }
            return $link;
        } catch(PDOException $e) {
            header('Location:/phpmotors/view/500.php');

            // echo 'Connection failed' . $e->getMessage();
            exit;
        }
    }

    // phpmotorsConnect()








?>





