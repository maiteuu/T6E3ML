<?php
    session_start();
    $xml = new DOMDocument();
    $xml->load(filename:"xml/users.xml");

    #XPath erabiltzcko aldagai berri bat sortuko dugu
    $xpath = new DOMXPath($xml);
    #php: namespace erregistratu behar dugu
    $xpath->registerNamespace("php", "http://php.net/xpath");
    #PHP funtzioak ere erregistratu behar ditugu (no restrictions)
    $xpath->registerPHPFunctions();

    $user = $_POST["user"];
    $pass = $_POST["password"];

    #XPath kontsulta
    $consulta = "//erabiltzailea[izena='$user' and pasahitza='$pass']";

    #Xpath kontsulta betetzen duten nodoak bilatzen ditut
    $erabiltzaileak = $xpath->query($consulta);

    #Zenbat nodo bueltatu duen kontsultak aztertzen dugu
    $numNodos = $erabiltzaileak->length;
    if($numNodos > 0) {
        $_SESSION["nombreUsuario"] = $user;
        header("Location:index.php");
    } else {
        header("Location:login.php?error=1");
    }
?>